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
            $table->string('order_number')->unique();
            $table->enum('order_type', ['full', 'deposit']); // 'full' for Order Now, 'deposit' for Reserve Now
            $table->string('status')->default('pending'); // pending, processing, completed, cancelled
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            // Billing Address
            $table->string('billing_address_line1');
            $table->string('billing_address_unit')->nullable();
            $table->string('billing_city');
            $table->string('billing_state');
            $table->string('billing_zip');
            // Shipping Address
            $table->string('shipping_name')->nullable();
            $table->string('shipping_address_line1')->nullable();
            $table->string('shipping_address_unit')->nullable();
            $table->string('shipping_city')->nullable();
            $table->string('shipping_state')->nullable();
            $table->string('shipping_zip')->nullable();
            // Order Details
            $table->integer('quantity');
            $table->decimal('unit_price', 10, 2);
            $table->decimal('subtotal', 10, 2);
            $table->decimal('tax_rate', 5, 2);
            $table->decimal('tax_amount', 10, 2);
            $table->decimal('shipping_cost', 10, 2);
            $table->decimal('total_amount', 10, 2);
            $table->decimal('deposit_amount', 10, 2)->nullable(); // Only for deposit orders
            $table->text('comments')->nullable();
            // Payment
            $table->string('stripe_session_id')->nullable();
            $table->string('stripe_payment_intent_id')->nullable();
            $table->boolean('payment_completed')->default(false);
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
