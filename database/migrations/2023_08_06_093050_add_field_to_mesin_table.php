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
        Schema::table('mesin', function (Blueprint $table) {
            $table->unsignedBigInteger('lokasi_id')->nullable()->after('name');
            $table->string('tahun_pembuatan')->nullable()->after('kapasitas');
            $table->string('periode_pakai')->nullable()->after('tahun_pembuatan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mesin', function (Blueprint $table) {
            //
        });
    }
};
