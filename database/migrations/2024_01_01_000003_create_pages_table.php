<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('content')->nullable();
            $table->longText('content_km')->nullable(); // Khmer content
            $table->string('template')->default('default'); // default, home, about, contact, custom
            $table->string('status')->default('draft'); // draft, published, scheduled
            $table->string('featured_image')->nullable();
            $table->json('sections')->nullable(); // dynamic page sections
            $table->json('meta')->nullable(); // page-specific meta
            $table->boolean('is_system_page')->default(false);
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade');
            $table->timestamp('published_at')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['slug', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
