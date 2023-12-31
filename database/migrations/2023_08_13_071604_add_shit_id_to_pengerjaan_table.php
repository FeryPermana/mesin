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
        Schema::table('pengerjaan', function (Blueprint $table) {
            $table->unsignedBigInteger('shift_id')->nullable()->after('mesin_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengerjaan', function (Blueprint $table) {
            //
        });
    }
};
