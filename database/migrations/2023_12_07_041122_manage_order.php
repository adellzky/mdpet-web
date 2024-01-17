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
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id_orders');
            $table->unsignedBigInteger('id_cust');
            $table->unsignedBigInteger('id_product');
            $table->integer('jumlah_pembelian');
            $table->enum('status_pesanan', ['ditolak', 'belum_bayar', 'lunas'])->default('belum_bayar');
            $table->timestamps();

            $table->foreign('id_cust')->references('id')->on('users');
            $table->foreign('id_product')->references('id')->on('product');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
