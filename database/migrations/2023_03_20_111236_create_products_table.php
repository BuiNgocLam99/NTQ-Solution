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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('code_product')->unique();
            $table->string('title');
            $table->string('thumnail');
            $table->string('images')->nullable();
            $table->enum('status', [0, 1])->comment('1 is active, 0 is block');
            $table->integer('total_orders')->default(0);
            $table->integer('view_counts')->default(0);
            $table->integer('total_stocks')->default(0);
            $table->float('avg_rating')->default(0);
            $table->string('reference_product')->nullable();
            // $table->string('tags')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('shop_id');
            $table->unsignedBigInteger('category_id');
            // $table->unsignedBigInteger('product_type_id');

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
