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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['Perempuan', 'Laki-laki']);
            $table->string('no_telp');
            $table->string('email')->nullable();
            $table->string('tujuan_poli');
            $table->enum('jaminan', ['Umum', 'BPJS']);
            $table->date('tanggal_kunjungan');
            $table->string('sesi');
            $table->text('pesan')->nullable();
            $table->enum('status', ['menunggu', 'dikonfirmasi', 'dibatalkan'])->default('menunggu');
            $table->text('catatan_admin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
