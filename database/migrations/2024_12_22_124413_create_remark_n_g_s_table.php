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
        Schema::create('remark_n_g_s', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('checking_id'); // Foreign Key

            $table->integer('SLVR')->default(0);
            $table->integer('BRY')->default(0);
            $table->integer('GLS')->default(0);
            $table->integer('FWBK')->default(0);
            $table->integer('BNG_RNR')->default(0);
            $table->integer('SNMRK')->default(0);
            $table->integer('STRATCH')->default(0);
            $table->integer('SHOT_MOLD')->default(0);
            $table->timestamps();

            $table->foreign('checking_id')->references('id')->on('checkings');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('remark_n_g_s');
    }
};
