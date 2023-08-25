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
            $table->dateTime('tanggal')->nullable()->change();
            $table->dateTime('finish')->nullable()->change();
            $table->string('lama_waktu')->nullable()->change();
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
