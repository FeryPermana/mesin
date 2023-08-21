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
        Schema::create('jeniskegiatanmesin', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jenis_kegiatan_id');
            $table->unsignedBigInteger('mesin_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jeniskegiatanmesin');
    }
};
