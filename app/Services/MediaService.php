<?php

namespace App\Services;

use App\Models\Gallery;
use App\Models\MediaFile;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class MediaService
{
    private ImageManager $imageManager;

    public function __construct()
    {
        $this->imageManager = new ImageManager(new Driver());
    }

    public function uploadImage(
        UploadedFile $file,
        string $directory = 'uploads/images',
        bool $optimize = true,
        array $sizes = []
    ): array {
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $path = $directory . '/' . $filename;

        if ($optimize && in_array($file->getMimeType(), ['image/jpeg', 'image/png', 'image/webp'])) {
            $image = $this->imageManager->read($file->getPathname());

            // Resize if too large
            if ($image->width() > 2000 || $image->height() > 2000) {
                $image->scaleDown(width: 2000, height: 2000);
            }

            // Save optimized
            Storage::disk('public')->put($path, $image->toJpeg(85));
        } else {
            $file->storeAs($directory, $filename, 'public');
        }

        $result = ['original' => $path, 'path' => $path];

        // Generate thumbnails
        if (!empty($sizes)) {
            foreach ($sizes as $sizeName => [$width, $height]) {
                $thumbName = Str::beforeLast($filename, '.') . "_{$sizeName}.jpg";
                $thumbPath = $directory . '/thumbs/' . $thumbName;

                $thumb = $this->imageManager->read($file->getPathname());
                $thumb->cover($width, $height);
                Storage::disk('public')->put($thumbPath, $thumb->toJpeg(80));

                $result[$sizeName] = $thumbPath;
            }

            $result['thumbnail'] = $result['thumb'] ?? $path;
        }

        return $result;
    }

    public function uploadDocument(UploadedFile $file, string $directory = 'uploads/documents'): string
    {
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        return $file->storeAs($directory, $filename, 'public');
    }

    public function deleteFile(string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    public function getImageDimensions(string $path): array
    {
        $fullPath = Storage::disk('public')->path($path);
        if (file_exists($fullPath)) {
            [$width, $height] = getimagesize($fullPath);
            return ['width' => $width, 'height' => $height];
        }
        return ['width' => null, 'height' => null];
    }

    public function storeMediaFile(UploadedFile $file, array $extra = []): MediaFile
    {
        $paths = $this->uploadImage($file, 'uploads/media', true, [
            'thumb' => [150, 150],
            'medium' => [600, 400],
        ]);

        $dims = $this->getImageDimensions($paths['original']);

        return MediaFile::create(array_merge([
            'name' => $file->getClientOriginalName(),
            'file_name' => basename($paths['original']),
            'mime_type' => $file->getMimeType(),
            'path' => $paths['original'],
            'disk' => 'public',
            'size' => $file->getSize(),
            'extension' => $file->getClientOriginalExtension(),
            'width' => $dims['width'],
            'height' => $dims['height'],
            'conversions' => [
                'thumb' => $paths['thumb'] ?? null,
                'medium' => $paths['medium'] ?? null,
            ],
            'uploaded_by' => auth()->id(),
        ], $extra));
    }
}
