<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gurus', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nip')->nullable();
            $table->string('jabatan');
            $table->string('no_hp')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nis')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->enum('kelas', ['A', 'B']);
            $table->string('nama_ortu')->nullable();
            $table->string('no_hp_ortu')->nullable();
            $table->text('alamat')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('kehadiran_gurus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guru_id')->constrained('gurus')->cascadeOnDelete();
            $table->date('tanggal');
            $table->enum('status', ['Hadir', 'Izin', 'Sakit', 'Alpa']);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });

        Schema::create('kehadiran_siswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswas')->cascadeOnDelete();
            $table->date('tanggal');
            $table->enum('status', ['Hadir', 'Izin', 'Sakit', 'Alpa']);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });

        Schema::create('acaras', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->date('tanggal');
            $table->text('deskripsi');
            $table->string('foto')->nullable();
            $table->string('kategori')->nullable();
            $table->timestamps();
        });

        Schema::create('prestasis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_siswa');
            $table->enum('kelas', ['A', 'B']);
            $table->string('nama_lomba');
            $table->string('tingkat')->nullable();
            $table->string('juara');
            $table->date('tanggal');
            $table->text('keterangan')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });

        Schema::create('galeris', function (Blueprint $table) {
            $table->id();
            $table->string('judul')->nullable();
            $table->string('foto');
            $table->string('kategori')->nullable();
            $table->timestamps();
        });

        Schema::create('kalender_akademiks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kegiatan');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai')->nullable();
            $table->string('jenis')->nullable(); // libur, kegiatan, ujian
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kalender_akademiks');
        Schema::dropIfExists('galeris');
        Schema::dropIfExists('prestasis');
        Schema::dropIfExists('acaras');
        Schema::dropIfExists('kehadiran_siswas');
        Schema::dropIfExists('kehadiran_gurus');
        Schema::dropIfExists('siswas');
        Schema::dropIfExists('gurus');
    }
};
