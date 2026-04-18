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
        Schema::create('korban', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bencana_id')->constrained('bencana')->onDelete('cascade');
            $table->string('nama')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->integer('umur')->nullable();
            $table->enum('status_identitas', ['dikenal', 'tidak_dikenal'])->default('tidak_dikenal');
            $table->text('lokasi_ditemukan')->nullable();
            $table->date('tanggal_ditemukan')->nullable();
            $table->text('kondisi_awal')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('korban');
    }
};
