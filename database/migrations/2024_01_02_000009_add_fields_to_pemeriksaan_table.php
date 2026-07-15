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
        Schema::table('pemeriksaan', function (Blueprint $table) {
            // Identitas Pasien
            $table->string('no_pasien')->nullable();
            $table->string('nama_pasien')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->integer('umur')->nullable();
            $table->text('alamat')->nullable();
            
            // Jenis Kejadian
            $table->string('jenis_bencana')->nullable();
            $table->string('jenis_bencana_lainnya')->nullable();
            $table->string('jenis_cedera')->nullable();
            $table->string('jenis_cedera_afiksia')->nullable();
            
            // Penemuan & Pelapor
            $table->date('tanggal_ditemukan')->nullable();
            $table->time('jam_ditemukan')->nullable();
            $table->string('lokasi_ditemukan')->nullable();
            $table->string('penemu_nama')->nullable();
            $table->integer('penemu_umur')->nullable();
            $table->string('penemu_jenis_kelamin')->nullable();
            $table->text('penemu_alamat')->nullable();
            $table->string('penemu_telp')->nullable();
            
            // Vital Sign Tambahan
            $table->decimal('bb', 5, 1)->nullable();
            $table->decimal('tb', 5, 1)->nullable();
            
            // Nyeri
            $table->string('nyeri')->nullable();
            $table->string('skala_nyeri')->nullable();
            $table->string('alergi')->nullable();
            
            // Pemeriksaan Psikiatri
            $table->text('pemeriksaan_psikiatri')->nullable();
            
            // Primary Survey - Pupil
            $table->string('pupil')->nullable();
            $table->string('reflek_cahaya')->nullable();
            
            // Primary Survey - Airway
            $table->json('airway')->nullable();
            
            // Primary Survey - Breathing
            $table->json('breathing')->nullable();
            
            // Primary Survey - Circulation
            $table->json('circulation')->nullable();
            
            // Primary Survey - Disability (GCS)
            $table->json('disability')->nullable();
            
            // Primary Survey - Exposure
            $table->json('eksposure')->nullable();
            
            // Primary Survey - Prehospital
            $table->json('prehospital')->nullable();
            
            // Kondisi (Triase)
            $table->string('kondisi')->nullable();
            
            // Anamnesis & Terapi
            $table->text('anamnesis')->nullable();
            $table->text('terapi')->nullable();
            
            // Tindakan Lanjutan
            $table->string('tindakan_lanjutan')->nullable();
            $table->json('dipulangkan_status')->nullable();
            $table->date('tanggal_meninggal')->nullable();
            $table->time('jam_meninggal')->nullable();
            $table->string('dirujuk_ke')->nullable();
            $table->string('nama_pengantar')->nullable();
            $table->string('transportasi')->nullable();
            
            // Petugas
            $table->string('petugas_nama')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pemeriksaan', function (Blueprint $table) {
            $table->dropColumn([
                'no_pasien',
                'nama_pasien',
                'jenis_kelamin',
                'tanggal_lahir',
                'umur',
                'alamat',
                'jenis_bencana',
                'jenis_bencana_lainnya',
                'jenis_cedera',
                'jenis_cedera_afiksia',
                'tanggal_ditemukan',
                'jam_ditemukan',
                'lokasi_ditemukan',
                'penemu_nama',
                'penemu_umur',
                'penemu_jenis_kelamin',
                'penemu_alamat',
                'penemu_telp',
                'bb',
                'tb',
                'nyeri',
                'skala_nyeri',
                'alergi',
                'pemeriksaan_psikiatri',
                'pupil',
                'reflek_cahaya',
                'airway',
                'breathing',
                'circulation',
                'disability',
                'eksposure',
                'prehospital',
                'kondisi',
                'anamnesis',
                'terapi',
                'tindakan_lanjutan',
                'dipulangkan_status',
                'tanggal_meninggal',
                'jam_meninggal',
                'dirujuk_ke',
                'nama_pengantar',
                'transportasi',
                'petugas_nama',
            ]);
        });
    }
};
