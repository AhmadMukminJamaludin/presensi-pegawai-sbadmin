<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('presensi_harian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id')->constrained('pegawai');
            $table->date('tanggal');
            $table->dateTime('waktu_checkin');
            $table->dateTime('waktu_checkout')->nullable();
            $table->enum('status', ['hadir','terlambat','alpha','cuti']);
            $table->timestamps();
            $table->unique(['pegawai_id','tanggal']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presensi_harian');
    }
};
