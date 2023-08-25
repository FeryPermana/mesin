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
        Schema::table('perawatan', function (Blueprint $table) {
            $table->unsignedBigInteger('mesin_id')->nullable()->after('id');
            $table->unsignedBigInteger('lineproduksi_id')->nullable()->after('mesin_id');
            $table->unsignedBigInteger('lokasi_id')->nullable()->after('lineproduksi_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('perawatan', function (Blueprint $table) {
            //
        });
    }
};
