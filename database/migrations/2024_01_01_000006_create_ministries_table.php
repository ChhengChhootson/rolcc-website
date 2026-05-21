<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ministries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_km')->nullable();
            $table->string('slug')->unique();
            $table->text('short_description')->nullable();
            $table->text('short_description_km')->nullable();
            $table->longText('description')->nullable();
            $table->longText('description_km')->nullable();
            $table->string('icon')->nullable();
            $table->string('color', 7)->default('#145DA0');
            $table->string('featured_image')->nullable();
            $table->string('banner_image')->nullable();
            $table->json('schedule')->nullable(); // meeting times
            $table->string('meeting_location')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_phone', 20)->nullable();
            $table->string('age_group')->nullable(); // All Ages, Youth, Kids, Adults
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->integer('order')->default(0);
            $table->string('status')->default('active');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('ministry_leaders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ministry_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('title')->nullable(); // Lead Pastor, Director, Coordinator
            $table->string('photo')->nullable();
            $table->text('bio')->nullable();
            $table->string('email')->nullable();
            $table->string('phone', 20)->nullable();
            $table->boolean('is_primary')->default(false);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ministry_leaders');
        Schema::dropIfExists('ministries');
    }
};
