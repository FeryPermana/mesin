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
        Schema::create('pengerjaan_bulanan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mesin_id');
            $table->unsignedBigInteger('shift_id');
            $table->string('nik');
            $table->date('tanggal');
            $table->string('gambar');
            $table->unsignedBigInteger('lineproduksi_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengerjaan_bulanan');
    }
};
