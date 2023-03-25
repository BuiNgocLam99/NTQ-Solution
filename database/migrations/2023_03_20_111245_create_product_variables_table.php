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
        Schema::create('product_variables', function (Blueprint $table) {
            $table->id();
            $table->string('product_code')->unique();
            $table->unsignedBigInteger('product_id');
            $table->decimal('import_price', 15, 2)->nullable();
            $table->decimal('regular_price', 15, 2);
            $table->decimal('sale_price', 15, 2)->nullable();
            $table->float('tax')->nullable();
            $table->integer('order_counts')->nullable();
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variables');
    }
};
