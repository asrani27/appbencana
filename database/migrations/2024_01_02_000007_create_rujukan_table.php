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
        Schema::create('rujukan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('korban_id')->constrained('korban')->onDelete('cascade');
            $table->foreignId('rumah_sakit_id')->constrained('rumah_sakit')->onDelete('cascade');
            $table->enum('status', ['dirujuk', 'diterima', 'selesai'])->default('dirujuk');
            $table->timestamp('waktu_rujuk')->nullable();
            $table->text('catatan')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rujukan');
    }
};
