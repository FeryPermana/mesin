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
        Schema::table('jeniskegiatanmesin', function (Blueprint $table) {
            $table->string('bulan')->nullable()->after('mesin_id');
            $table->string('tahun')->nullable()->after('bulan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jeniskegiatanmesin', function (Blueprint $table) {
            //
        });
    }
};
