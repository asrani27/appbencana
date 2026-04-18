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
        Schema::create('bencana', function (Blueprint $table) {
            $table->id();
            $table->string('nama_bencana');
            $table->enum('jenis_bencana', ['gempa', 'banjir', 'tsunami', 'kebakaran', 'longsor', 'puting_beliung', 'kekeringan', 'lainnya']);
            $table->text('lokasi');
            $table->date('tanggal_kejadian');
            $table->enum('status', ['aktif', 'selesai'])->default('aktif');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bencana');
    }
};
