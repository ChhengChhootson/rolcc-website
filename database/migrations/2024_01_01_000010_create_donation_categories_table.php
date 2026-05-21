<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donation_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_km')->nullable();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('icon')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('category_id')->nullable()->constrained('donation_categories')->nullOnDelete();
            $table->string('donor_name')->nullable();
            $table->string('donor_email')->nullable();
            $table->string('donor_phone', 20)->nullable();
            $table->decimal('amount', 10, 2);
            $table->string('currency', 3)->default('USD');
            $table->string('payment_method')->nullable(); // aba, wing, cash, bank_transfer, stripe
            $table->string('transaction_id')->nullable();
            $table->string('reference_number')->nullable()->unique();
            $table->text('message')->nullable();
            $table->string('status')->default('pending'); // pending, completed, failed, refunded
            $table->boolean('is_anonymous')->default(false);
            $table->boolean('is_recurring')->default(false);
            $table->string('recurrence_interval')->nullable(); // monthly, yearly
            $table->string('receipt_path')->nullable();
            $table->timestamp('donated_at')->nullable();
            $table->json('meta')->nullable(); // payment gateway response
            $table->timestamps();
            $table->softDeletes();

            $table->index(['status', 'donated_at']);
            $table->index('donor_email');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donations');
        Schema::dropIfExists('donation_categories');
    }
};
