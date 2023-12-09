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
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('image_path')->nullable();
            $table->string('password');
            $table->string('role');
            $table->string('contact');
            $table->string('ssc_group');
            $table->integer('ssc_passing_year');
            $table->string('ssc_roll_no');
            $table->string('hsc_group');
            $table->integer('hsc_passing_year');
            $table->string('hsc_roll_no');
            $table->text('address');
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
