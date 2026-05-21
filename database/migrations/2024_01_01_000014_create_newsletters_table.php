<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('newsletters', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('name')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('preferred_language', 5)->default('en');
            $table->boolean('is_subscribed')->default(true);
            $table->string('token')->nullable()->unique(); // for unsubscribe
            $table->string('source')->default('website'); // website, social, referral
            $table->timestamp('subscribed_at')->nullable();
            $table->timestamp('unsubscribed_at')->nullable();
            $table->string('unsubscribe_reason')->nullable();
            $table->json('preferences')->nullable(); // what to receive: sermons, events, news
            $table->timestamps();

            $table->index(['is_subscribed', 'preferred_language']);
        });

        Schema::create('newsletter_campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->string('subject_km')->nullable();
            $table->longText('content');
            $table->longText('content_km')->nullable();
            $table->string('status')->default('draft'); // draft, scheduled, sending, sent
            $table->unsignedInteger('sent_count')->default(0);
            $table->unsignedInteger('open_count')->default(0);
            $table->unsignedInteger('click_count')->default(0);
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade');
            $table->timestamp('scheduled_at')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('newsletter_campaigns');
        Schema::dropIfExists('newsletters');
    }
};
