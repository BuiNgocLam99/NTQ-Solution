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
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('email')->unique();
            $table->string('phone_number')->unique();
            $table->string('avatar');
            $table->string('description');
            $table->string('password');
            $table->enum('status', [0, 1])->comment('1 is active, 0 is block');
            $table->integer('view_counts')->default(0);
            $table->integer('product_counts')->default(0);
            $table->integer('sold_counts')->default(0);
            $table->integer('order_counts')->default(0);
            $table->string('zipcode');
            $table->string('city');
            $table->string('country');
            $table->decimal('earning', '15', '02')->default(0);
            $table->decimal('profit', '15', '02')->default(0);
            $table->integer('refund')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shops');
    }
};
