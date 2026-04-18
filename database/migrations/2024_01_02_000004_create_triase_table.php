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
        Schema::create('triase', function (Blueprint $table) {
            $table->id();
            $table->foreignId('korban_id')->constrained('korban')->onDelete('cascade');
            $table->enum('kategori', ['merah', 'kuning', 'hijau', 'hitam']);
            $table->text('keterangan')->nullable();
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('triase');
    }
};
