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
        Schema::create('monitoring_suhu', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('suhu');
            $table->string('rh');
            $table->text('keterangan');
            $table->unsignedBigInteger('operator_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monitoring_suhu');
    }
};
