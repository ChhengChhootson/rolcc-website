<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title')->nullable(); // e.g. "Church Member", "Youth Leader"
            $table->string('photo')->nullable();
            $table->text('content');
            $table->text('content_km')->nullable();
            $table->string('video_url')->nullable();
            $table->string('category')->default('general'); // general, healing, salvation, provision
            $table->unsignedTinyInteger('rating')->default(5);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_approved')->default(false);
            $table->string('status')->default('pending'); // pending, approved, rejected
            $table->integer('order')->default(0);
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['status', 'is_featured']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
