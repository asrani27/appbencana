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
        Schema::create('pemeriksaan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('korban_id')->constrained('korban')->onDelete('cascade');
            $table->string('tekanan_darah')->nullable();
            $table->string('nadi')->nullable();
            $table->string('respirasi')->nullable();
            $table->decimal('suhu', 4, 1)->nullable();
            $table->text('keluhan')->nullable();
            $table->text('diagnosa_awal')->nullable();
            $table->text('tindakan')->nullable();
            $table->foreignId('petugas_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaan');
    }
};
