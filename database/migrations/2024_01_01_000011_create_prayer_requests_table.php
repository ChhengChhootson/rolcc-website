<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prayer_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name')->nullable(); // null if anonymous
            $table->string('email')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('subject')->nullable();
            $table->longText('request');
            $table->string('category')->default('personal'); // personal, family, healing, financial, ministry, thanksgiving
            $table->boolean('is_anonymous')->default(false);
            $table->boolean('is_public')->default(false);
            $table->boolean('is_urgent')->default(false);
            $table->string('status')->default('pending'); // pending, praying, answered, archived
            $table->text('admin_notes')->nullable();
            $table->text('response')->nullable();
            $table->foreignId('assigned_to')->nullable()->constrained('users')->nullOnDelete();
            $table->unsignedInteger('prayer_count')->default(0);
            $table->timestamp('answered_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['status', 'is_urgent']);
            $table->index('category');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prayer_requests');
    }
};
