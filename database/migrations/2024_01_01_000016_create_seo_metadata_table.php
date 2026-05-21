<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seo_metadata', function (Blueprint $table) {
            $table->id();
            $table->string('model_type')->nullable(); // App\Models\Page, App\Models\Sermon, etc.
            $table->unsignedBigInteger('model_id')->nullable();
            $table->string('page_key')->nullable(); // for static pages: home, about, etc.
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('keywords')->nullable();
            $table->string('og_title')->nullable();
            $table->text('og_description')->nullable();
            $table->string('og_image')->nullable();
            $table->string('og_type')->default('website');
            $table->string('twitter_card')->default('summary_large_image');
            $table->string('twitter_title')->nullable();
            $table->text('twitter_description')->nullable();
            $table->string('twitter_image')->nullable();
            $table->string('canonical_url')->nullable();
            $table->string('robots')->default('index,follow');
            $table->json('schema_markup')->nullable(); // JSON-LD
            $table->timestamps();

            $table->index(['model_type', 'model_id']);
            $table->index('page_key');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seo_metadata');
    }
};
