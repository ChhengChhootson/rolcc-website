<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SermonRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->is_admin;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'title_km' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'notes' => 'nullable|string',
            'scripture_reference' => 'nullable|string|max:255',
            'series_name' => 'nullable|string|max:255',
            'speaker' => 'nullable|string|max:100',
            'category_id' => 'nullable|exists:sermon_categories,id',
            'video_type' => 'nullable|in:youtube,facebook,vimeo,upload',
            'video_url' => 'nullable|url|max:500',
            'audio_url' => 'nullable|url|max:500',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'document' => 'nullable|file|mimes:pdf|max:20480',
            'duration_seconds' => 'nullable|integer|min:0',
            'language' => 'required|in:en,km,both',
            'status' => 'required|in:draft,published,scheduled',
            'is_featured' => 'boolean',
            'allow_download' => 'boolean',
            'tags' => 'nullable|array',
            'preached_date' => 'nullable|date',
            'published_at' => 'nullable|date',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_featured' => $this->boolean('is_featured'),
            'allow_download' => $this->boolean('allow_download'),
        ]);
    }
}
