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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->bigInteger('shift1_id')->nullable();
            $table->bigInteger('shift2_id')->nullable();
            $table->timestamps();

            $table->foreign('shift1_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('shift2_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
