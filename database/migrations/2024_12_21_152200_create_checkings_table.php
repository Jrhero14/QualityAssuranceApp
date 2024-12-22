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
        Schema::create('checkings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('item_id'); // Foreign Key
            $table->bigInteger('schedule_id'); // Foreign Key

            $table->integer('OK')->default(0);
            $table->integer('NG')->default(0);
            $table->integer('total')->default(0);
            $table->string('part_no');
            $table->timestamps();

            $table->foreign('item_id')->references('id')->on('items');
            $table->foreign('schedule_id')->references('id')->on('schedules');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkings');
    }
};
