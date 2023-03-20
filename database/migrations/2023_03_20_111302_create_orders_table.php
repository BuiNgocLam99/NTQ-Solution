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
            $table->string('order_code')->unique();
            $table->unsignedBigInteger('shop_id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('customer_address_id');
            $table->unsignedBigInteger('customer_credit_id')->nullable();
            $table->unsignedBigInteger('discount_code_id')->nullable();
            $table->unsignedBigInteger('shipping_method_id');
            $table->unsignedBigInteger('payment_method_id');
            $table->enum('status', [0, 1, 2])->default(1)->comment('1 is pending, 2 is done, 0 is cancelled');
            $table->float('tax');
            $table->decimal('sub_total', 15, 2);
            $table->decimal('total', 15, 2);
            $table->date('delivery_date');
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('users');
            $table->foreign('customer_address_id')->references('id')->on('user_addresses');
            $table->foreign('customer_credit_id')->references('id')->on('user_credits');
            $table->foreign('discount_code_id')->references('id')->on('discount_codes');
            $table->foreign('shipping_method_id')->references('id')->on('shipping_methods');
            $table->foreign('payment_method_id')->references('id')->on('payment_methods');
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
