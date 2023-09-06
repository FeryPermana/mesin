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
        Schema::create('perbaikan', function (Blueprint $table) {
            $table->id();
            $table->string('id_perbaikan')->nullable();
            $table->date('tanggal_request');
            $table->date('tanggal_update');
            $table->string('lama_waktu');
            $table->unsignedBigInteger('operator_id')->nullable();
            $table->unsignedBigInteger('teknisi_id')->nullable();
            $table->unsignedBigInteger('mesin_id')->nullable();
            $table->unsignedBigInteger('shift_id')->nullable();
            $table->unsignedBigInteger('lineproduksi_id')->nullable();
            $table->text('action')->nullable();
            $table->string('pergantian_spare')->nullable();
            $table->string('status')->nullable();
            $table->string('gambar')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perbaikan');
    }
};
