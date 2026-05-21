<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leadership', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title');
            $table->string('title_km')->nullable();
            $table->string('photo')->nullable();
            $table->text('bio')->nullable();
            $table->text('bio_km')->nullable();
            $table->string('email')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('category')->default('senior'); // senior, associate, elder, deacon, staff
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->integer('order')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leadership');
    }
};
