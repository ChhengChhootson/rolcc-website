<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('livestreams', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('platform')->default('youtube'); // youtube, facebook, custom
            $table->string('stream_id')->nullable(); // YouTube video ID, Facebook video ID
            $table->string('stream_url')->nullable();
            $table->string('embed_code')->nullable();
            $table->string('thumbnail')->nullable();
            $table->boolean('is_live')->default(false);
            $table->boolean('is_scheduled')->default(false);
            $table->dateTime('scheduled_at')->nullable();
            $table->dateTime('started_at')->nullable();
            $table->dateTime('ended_at')->nullable();
            $table->unsignedInteger('viewer_count')->default(0);
            $table->unsignedInteger('peak_viewers')->default(0);
            $table->string('status')->default('offline'); // offline, scheduled, live, ended
            $table->boolean('archive_after')->default(true);
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();

            $table->index(['status', 'is_live']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('livestreams');
    }
};
