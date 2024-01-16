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
        Schema::create('consul', function (Blueprint $table) {
            $table->bigIncrements('id_consul')->unsigned();
            $table->string('keluhan', 225);
            $table->string('solusi', 225);
            $table->string('medic_record', 225);
            $table->timestamps();

            $table->foreign('id_consul')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consul');
    }
};
