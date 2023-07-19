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
        Schema::create('doctor_sections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Doctor');
            $table->unsignedBigInteger('Section');
            $table->foreign('Doctor')->references('id')->on('Doctors')->onDelete('cascade');
            $table->foreign('Section')->references('id')->on('Sections')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor_sections');
    }
};
