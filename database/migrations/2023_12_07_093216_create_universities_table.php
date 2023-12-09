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
        Schema::create('universities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->string('short_address');
            $table->string('image_path');
            $table->text('map_url');
            $table->string('tentative_tution_cost');
            $table->string('contact');
            $table->text('campus_facilities');
            $table->string('admission_stat');
            $table->text('grading_system');
            $table->integer('total_students');
            $table->string('next_addmission_intake');
            $table->date('next_addmission_deadline');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('universities');
    }
};
