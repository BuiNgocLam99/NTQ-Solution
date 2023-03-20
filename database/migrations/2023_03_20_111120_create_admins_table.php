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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('fullname');
            $table->enum('position', ['Super Admin', 'Content Manager', 'Order Manager', 'Customer Service Manager', 'Marketing Manager', 'Technical Manager']);
            $table->string('email')->unique();
            $table->string('phone_number')->unique();
            $table->string('avatar')->nullable();
            $table->string('password');
            $table->enum('status', [1, 2])->comment('1 is active, 0 is block')->default(1);
            $table->date('dob');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
