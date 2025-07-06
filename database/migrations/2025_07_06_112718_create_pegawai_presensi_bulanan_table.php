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
        Schema::create('pegawai_presensi_bulanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id')->constrained('pegawai')->cascadeOnDelete();
            $table->foreignId('presensi_bulanan_id')->constrained('presensi_bulanan')->cascadeOnDelete();
            $table->unsignedInteger('total_hadir')->default(0);
            $table->unsignedInteger('total_terlambat')->default(0);
            $table->unsignedInteger('total_alpha')->default(0);
            $table->unsignedInteger('total_cuti')->default(0);
            $table->timestamps();
            $table->unique(['pegawai_id','presensi_bulanan_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai_presensi_bulanan');
    }
};
