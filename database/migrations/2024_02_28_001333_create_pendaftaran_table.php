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
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->string('no_pendaftaran');
            $table->string('nama');
            $table->string('nik');
            $table->string('nohp');
            $table->string('kk');
            $table->string('ktp');
            $table->string('formulir');
            $table->string('foto');
            $table->string('surat_domisili')->nullable();
            $table->enum('status_kelulusan', ['lulus', 'tidak lulus', 'belum verifikasi'])->default('belum verifikasi');
            $table->text('keterangan')->nullable();
            $table->string('slip_pembayaran')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran');
    }
};
