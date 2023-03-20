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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('first_name', 100)->nullable();
            $table->string('last_name', 100)->nullable();
            $table->string('user_name', 100)->unique();
            $table->string('email')->unique();
            $table->string('phone_number')->unique()->nullable();
            $table->string('avatar')->nullable();
            $table->string('password');
            $table->enum('status', [1, 0])->default(1)->comment('1 is active, 0 is block');
            $table->enum('rank', [0, 1, 2, 3])->default(0)->comment('0 is normal, 1 is silver, 2 is gold, 3 is diamond');
            $table->decimal('total_spent', 10, 2)->default(0);
            $table->date('dob')->nullable();
            $table->string('address')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->enum('gender', [0, 1, 2])->nullable()->comment('0 is other, 1 is male, 2 is female');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
