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
        Schema::table('perbaikan', function (Blueprint $table) {
            $table->dateTime('tanggal_request')->nullable()->change();
            $table->dateTime('tanggal_update')->nullable()->change();
            $table->string('operator_gambar')->nullable()->after('gambar');
            $table->string('downtime')->nullable()->after('operator_gambar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('perbaikan', function (Blueprint $table) {
            //
        });
    }
};
