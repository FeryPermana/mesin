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
        Schema::create('checklist_bulanan', function (Blueprint $table) {
            $table->id();
            $table->string('bulan');
            $table->unsignedBigInteger('jenis_kegiatan_id');
            $table->unsignedBigInteger('pengerjaan_bulanan_id');
            $table->string('is_check');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checklist_bulanan');
    }
};
