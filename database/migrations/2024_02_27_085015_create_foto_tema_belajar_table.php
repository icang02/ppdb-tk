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
        Schema::create('foto_tema_belajar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tema_belajar_id');
            $table->foreign('tema_belajar_id')->references('id')
                ->on('tema_belajar')->onDelete('cascade');
            $table->string('foto');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foto_tema_belajar');
    }
};
