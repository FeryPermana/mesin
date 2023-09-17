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
        Schema::table('sparepart', function (Blueprint $table) {
            $table->date('tanggal_masuk')->after('tanggal_update')->nullable();
            $table->string('kode_barang')->after('item')->nullable();
            $table->integer('stock')->after('tanggal_masuk')->nullable();
            $table->date('tanggal_keluar')->after('stock')->nullable();
            $table->unsignedBigInteger('lineproduksi_id')->nullable();
            $table->unsignedBigInteger('shift_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sparepart', function (Blueprint $table) {
            //
        });
    }
};
