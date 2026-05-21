<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sermons', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('title_km')->nullable();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->text('description_km')->nullable();
            $table->longText('notes')->nullable();
            $table->string('scripture_reference')->nullable(); // e.g., "John 3:16"
            $table->string('series_name')->nullable();
            $table->string('speaker')->nullable();
            $table->foreignId('category_id')->nullable()->constrained('sermon_categories')->nullOnDelete();
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade');
            $table->string('video_type')->nullable(); // youtube, facebook, vimeo, upload
            $table->string('video_url')->nullable();
            $table->string('video_embed_id')->nullable();
            $table->string('audio_url')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('document_url')->nullable(); // downloadable PDF notes
            $table->integer('duration_seconds')->nullable();
            $table->unsignedBigInteger('views')->default(0);
            $table->unsignedBigInteger('downloads')->default(0);
            $table->string('language', 5)->default('en'); // en, km, both
            $table->string('status')->default('draft'); // draft, published, scheduled
            $table->boolean('is_featured')->default(false);
            $table->boolean('allow_download')->default(true);
            $table->json('tags')->nullable();
            $table->date('preached_date')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['status', 'is_featured']);
            $table->index(['category_id', 'status']);
            $table->fullText(['title', 'description', 'speaker', 'scripture_reference']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sermons');
    }
};
