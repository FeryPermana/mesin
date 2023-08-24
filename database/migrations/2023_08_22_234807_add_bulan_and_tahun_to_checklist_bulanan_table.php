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
        Schema::table('checklist_bulanan', function (Blueprint $table) {
            $table->string('bulanan')->nullable()->after('is_check');
            $table->string('tahun')->nullable()->after('bulan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('checklist_bulanan', function (Blueprint $table) {
            //
        });
    }
};
