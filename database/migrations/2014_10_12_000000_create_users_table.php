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
            $table->string('role')->default('student');
            $table->string('contact')->nullable();
            $table->string('ssc_group')->nullable();
            $table->integer('ssc_passing_year')->nullable();
            $table->string('ssc_roll_no')->nullable();
            $table->string('ssc_result')->nullable();
            $table->string('hsc_group')->nullable();
            $table->integer('hsc_passing_year')->nullable();
            $table->string('hsc_roll_no')->nullable();
            $table->string('hsc_result')->nullable();
            $table->text('address')->nullable();
            $table->boolean('public_profile')->default(false);
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
