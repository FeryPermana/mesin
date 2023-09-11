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
        Schema::table('monitoring_suhu', function (Blueprint $table) {
            $table->unsignedBigInteger('lineproduksi_id')->after('tanggal')->nullable();
            $table->unsignedBigInteger('shift_id')->after('lineproduksi_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('monitoring_suhu', function (Blueprint $table) {
            //
        });
    }
};
