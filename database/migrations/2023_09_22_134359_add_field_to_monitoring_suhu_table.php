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
            $table->unsignedBigInteger('mesin_id')->after('operator_id')->nullable();
            $table->unsignedBigInteger('lokasi_id')->after('mesin_id')->nullable();
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
