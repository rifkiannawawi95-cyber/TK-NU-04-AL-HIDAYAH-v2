<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Acara;
use App\Models\Prestasi;
use App\Models\KalenderAkademik;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SchoolSeeder extends Seeder
{
    public function run(): void
    {
        $isProduction = app()->environment('production');

        // 1. Create Users (demo). Passwords must come from env; if missing, generate random and display once.
        $adminEmail = (string) env('SEED_ADMIN_EMAIL', 'admin@tknu04.com');
        $guruEmail = (string) env('SEED_GURU_EMAIL', 'guru@tknu04.com');
        $adminPassword = env('SEED_ADMIN_PASSWORD');
        $guruPassword = env('SEED_GURU_PASSWORD');

        if (blank($adminPassword)) {
            $adminPassword = Str::random(20);
            $this->command?->warn("SEED_ADMIN_PASSWORD not set. Generated random admin password: {$adminPassword}");
        }
        if (blank($guruPassword)) {
            $guruPassword = Str::random(20);
            $this->command?->warn("SEED_GURU_PASSWORD not set. Generated random guru password: {$guruPassword}");
        }

        User::updateOrCreate(
            ['email' => $adminEmail],
            [
                'name' => (string) env('SEED_ADMIN_NAME', 'Administrator'),
                'password' => Hash::make($adminPassword),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => $guruEmail],
            [
                'name' => (string) env('SEED_GURU_NAME', 'Guru A'),
                'password' => Hash::make($guruPassword),
                'role' => 'user',
            ]
        );

        // 2. Create Gurus
        $gurus = [
            ['nama' => 'Siti Aminah, S.Pd.AUD', 'nip' => '198001012005012001', 'jabatan' => 'Kepala Sekolah', 'no_hp' => '081234567890'],
            ['nama' => 'Nurul Hidayah, S.Pd', 'nip' => '198502022010012002', 'jabatan' => 'Guru Kelas A', 'no_hp' => '082345678901'],
            ['nama' => 'Aisyah Putri, S.Pd', 'nip' => '-', 'jabatan' => 'Guru Kelas B', 'no_hp' => '083456789012'],
        ];
        foreach ($gurus as $guru) {
            Guru::create($guru);
        }

        // 3. Create Siswas
        $siswas = [
            ['nama' => 'Ahmad', 'nis' => '1001', 'jenis_kelamin' => 'L', 'kelas' => 'A'],
            ['nama' => 'Budi', 'nis' => '1002', 'jenis_kelamin' => 'L', 'kelas' => 'A'],
            ['nama' => 'Citra', 'nis' => '1003', 'jenis_kelamin' => 'P', 'kelas' => 'A'],
            ['nama' => 'Dewi', 'nis' => '1004', 'jenis_kelamin' => 'P', 'kelas' => 'B'],
            ['nama' => 'Eko', 'nis' => '1005', 'jenis_kelamin' => 'L', 'kelas' => 'B'],
        ];
        foreach ($siswas as $siswa) {
            Siswa::create($siswa);
        }

        // 4. Create Acara
        Acara::create([
            'nama' => 'Lomba Mewarnai Tingkat Kabupaten',
            'tanggal' => date('Y-m-d', strtotime('+7 days')),
            'deskripsi' => 'Anak-anak akan mengikuti lomba mewarnai untuk mengasah kreativitas dan motorik halus.',
            'kategori' => 'Kreativitas'
        ]);
        Acara::create([
            'nama' => 'Manasik Haji Anak',
            'tanggal' => date('Y-m-d', strtotime('+14 days')),
            'deskripsi' => 'Kegiatan pengenalan tata cara ibadah haji untuk menanamkan nilai-nilai keagamaan sejak dini.',
            'kategori' => 'Keagamaan'
        ]);

        // 5. Create Prestasi
        Prestasi::create([
            'nama_siswa' => 'Ahmad',
            'kelas' => 'A',
            'nama_lomba' => 'Lomba Hafalan Doa Sehari-hari',
            'tingkat' => 'Kecamatan',
            'juara' => 'Juara 1',
            'tanggal' => date('Y-m-d', strtotime('-5 days')),
        ]);

        // 6. Create Kalender Akademik 2026
        KalenderAkademik::create([
            'nama_kegiatan' => 'Hari Pertama Masuk Sekolah',
            'tanggal_mulai' => '2026-07-13',
            'jenis' => 'Kegiatan'
        ]);
        KalenderAkademik::create([
            'nama_kegiatan' => 'Libur Nasional (Kemerdekaan RI)',
            'tanggal_mulai' => '2026-08-17',
            'jenis' => 'Libur'
        ]);
    }
}
