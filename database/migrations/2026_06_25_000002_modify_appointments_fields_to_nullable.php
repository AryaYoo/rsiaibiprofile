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
        Schema::table('appointments', function (Blueprint $table) {
            $table->date('tanggal_lahir')->nullable()->change();
            $table->string('jenis_kelamin')->nullable()->change();
            $table->enum('jaminan', ['Umum', 'BPJS'])->nullable()->change();
            $table->date('tanggal_kunjungan')->nullable()->change();
            $table->string('sesi')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->date('tanggal_lahir')->change();
            $table->enum('jenis_kelamin', ['Perempuan', 'Laki-laki'])->change();
            $table->enum('jaminan', ['Umum', 'BPJS'])->change();
            $table->date('tanggal_kunjungan')->change();
            $table->string('sesi')->change();
        });
    }
};
