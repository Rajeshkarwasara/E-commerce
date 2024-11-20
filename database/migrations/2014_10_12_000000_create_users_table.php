<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // public function up(): void
    // {
    //     Schema::create('users', function (Blueprint $table) {
    //      $table->id();
    //         $table->boolean('role_id');
    //         $table->string('fname');
    //         $table->string('lname');
    //         $table->string('email')->unique();
    //         $table->timestamp('email_verified_at')->nullable();
    //         $table->string('password');
    //         $table->string('contact');
    //         $table->string('gender');
    //         $table->text('address');
    //         $table->foreignId('country');
    //         $table->text('profile');
    //         $table->rememberToken();
    //         $table->timestamps();
    //     });
    // }
    public function up()
{
    if (!Schema::hasTable('users')) {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('role_id');
            $table->string('fname');
            $table->string('lname');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('contact');
            $table->string('gender');
            $table->text('address');
            $table->unsignedBigInteger('country');
            $table->text('profile');
            $table->rememberToken();
            $table->timestamps();
        });
    }
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
