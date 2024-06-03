<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->uuid('order_number')->unique();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('store_id')->nullable()->constrained()->cascadeOnDelete();
            $table->enum('status', ['pending', 'processing', 'completed', 'decline'])->default('pending');
            $table->enum('payment_method', [
                'cash_on_delivery', 'paypal', 'paystack',
                'payu', 'paytm', 'stripe', 'razorpay',
                'flutterwave', 'voguepay', 'mollie', 'payfast', 'payhere', 'paynow', 'instamojo'
            ])
                ->default('cash_on_delivery');
            $table->enum('payment_status', ['unpaid', 'paid', 'failed', 'pending'])->default('unpaid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
