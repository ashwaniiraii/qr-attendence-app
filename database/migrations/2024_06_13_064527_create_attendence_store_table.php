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
        Schema::create('attendence_store', function (Blueprint $table) {
            $table->id();
            $table->string('weekhours');
            $table->string('monthhours');
            $table->string('workingdays');
            $table->string('leave');
            $table->timestamps();
            $table->foreign('attendence_id')->references('id')->on('attendence')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendence_store');
    }
};
