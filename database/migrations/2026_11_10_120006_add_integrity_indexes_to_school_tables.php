<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->unique('nis', 'siswas_nis_unique');
            $table->index('nama', 'siswas_nama_index');
        });

        Schema::table('gurus', function (Blueprint $table) {
            $table->unique('nip', 'gurus_nip_unique');
        });

        Schema::table('kehadiran_siswas', function (Blueprint $table) {
            $table->unique(['siswa_id', 'tanggal'], 'kehadiran_siswas_siswa_tanggal_unique');
            $table->index('tanggal', 'kehadiran_siswas_tanggal_index');
        });

        Schema::table('kehadiran_gurus', function (Blueprint $table) {
            $table->unique(['guru_id', 'tanggal'], 'kehadiran_gurus_guru_tanggal_unique');
            $table->index('tanggal', 'kehadiran_gurus_tanggal_index');
        });

        Schema::table('kalender_akademiks', function (Blueprint $table) {
            $table->index('tanggal_mulai', 'kalender_akademiks_tanggal_mulai_index');
        });
    }

    public function down(): void
    {
        Schema::table('kalender_akademiks', function (Blueprint $table) {
            $table->dropIndex('kalender_akademiks_tanggal_mulai_index');
        });

        Schema::table('kehadiran_gurus', function (Blueprint $table) {
            $table->dropUnique('kehadiran_gurus_guru_tanggal_unique');
            $table->dropIndex('kehadiran_gurus_tanggal_index');
        });

        Schema::table('kehadiran_siswas', function (Blueprint $table) {
            $table->dropUnique('kehadiran_siswas_siswa_tanggal_unique');
            $table->dropIndex('kehadiran_siswas_tanggal_index');
        });

        Schema::table('gurus', function (Blueprint $table) {
            $table->dropUnique('gurus_nip_unique');
        });

        Schema::table('siswas', function (Blueprint $table) {
            $table->dropUnique('siswas_nis_unique');
            $table->dropIndex('siswas_nama_index');
        });
    }
};
