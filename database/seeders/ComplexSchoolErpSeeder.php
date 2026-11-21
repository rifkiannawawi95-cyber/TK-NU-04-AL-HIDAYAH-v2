<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\AspekPerkembangan;
use App\Models\PenilaianHarian;
use App\Models\KategoriPembayaran;
use App\Models\TagihanSiswa;
use App\Models\TransaksiPembayaran;
use App\Models\PpdbPendaftaran;
use App\Models\InventarisBarang;
use App\Models\Pengumuman;
use App\Models\User;

class ComplexSchoolErpSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();
        $gurus = Guru::all();

        // 1. Data Kelas / Rombongan Belajar
        $waliA = $gurus->skip(1)->first()?->id ?? $gurus->first()?->id;
        $waliB = $gurus->skip(2)->first()?->id ?? $gurus->first()?->id;
        $waliKB = $gurus->first()?->id;

        $kelasKB = Kelas::updateOrCreate(['kode_kelas' => 'KB-01'], [
            'nama_kelas'    => 'Kelompok Bermain Bintang Sembilan',
            'tingkat'       => 'KB',
            'wali_kelas_id' => $waliKB,
            'ruangan'       => 'Ruang Melati',
            'kapasitas'     => 15,
            'tahun_ajaran'  => '2026/2027',
        ]);

        $kelasA = Kelas::updateOrCreate(['kode_kelas' => 'TKA-01'], [
            'nama_kelas'    => 'TK-A Umar bin Khattab',
            'tingkat'       => 'TK-A',
            'wali_kelas_id' => $waliA,
            'ruangan'       => 'Ruang Mawar',
            'kapasitas'     => 25,
            'tahun_ajaran'  => '2026/2027',
        ]);

        $kelasB = Kelas::updateOrCreate(['kode_kelas' => 'TKB-01'], [
            'nama_kelas'    => 'TK-B Ali bin Abi Thalib',
            'tingkat'       => 'TK-B',
            'wali_kelas_id' => $waliB,
            'ruangan'       => 'Ruang Anggrek',
            'kapasitas'     => 25,
            'tahun_ajaran'  => '2026/2027',
        ]);

        // Hubungkan siswa ke kelas masing-masing
        Siswa::where('kelas', 'A')->update(['kelas_id' => $kelasA->id]);
        Siswa::where('kelas', 'B')->update(['kelas_id' => $kelasB->id]);

        // 2. Data Aspek Perkembangan PAUD (Kurikulum Merdeka + Nilai Ke-NU-an)
        $aspeks = [
            [
                'kode_aspek'           => 'NAM-NU',
                'nama_aspek'           => 'Nilai Agama, Moral & Aswaja NU',
                'keterangan_indikator' => 'Hafalan doa harian, pengenalan surat pendek, wudhu, sholat dhuha, dan adab sopan santun.',
                'kurikulum'            => 'Kurikulum Aswaja LP Ma\'arif NU',
            ],
            [
                'kode_aspek'           => 'FM-KASAR',
                'nama_aspek'           => 'Fisik Motorik Kasar & Halus',
                'keterangan_indikator' => 'Keseimbangan tubuh, meronce, mewarnai pola rapi, melompat, dan senam santri ceria.',
                'kurikulum'            => 'Kurikulum Merdeka PAUD',
            ],
            [
                'kode_aspek'           => 'KOG-LOGIKA',
                'nama_aspek'           => 'Kognitif & Logika Awal',
                'keterangan_indikator' => 'Mengenal konsep bilangan, bentuk geometri, pemecahan masalah sederhana, dan sains anak.',
                'kurikulum'            => 'Kurikulum Merdeka PAUD',
            ],
            [
                'kode_aspek'           => 'BHS-LITERASI',
                'nama_aspek'           => 'Bahasa & Literasi Dini',
                'keterangan_indikator' => 'Mendengarkan cerita islami, mengungkapkan keinginan, pengenalan huruf hijaiyah dan latin.',
                'kurikulum'            => 'Kurikulum Merdeka PAUD',
            ],
            [
                'kode_aspek'           => 'SOSEM-MANDIRI',
                'nama_aspek'           => 'Sosial Emosional & Kemandirian',
                'keterangan_indikator' => 'Berbagi mainan, antri, mengendalikan emosi, merapikan perlengkapan sekolah sendiri.',
                'kurikulum'            => 'Kurikulum Merdeka PAUD',
            ],
            [
                'kode_aspek'           => 'SN-KREATIF',
                'nama_aspek'           => 'Seni, Musik & Kreativitas',
                'keterangan_indikator' => 'Bernyanyi lagu anak islami, tepuk santri, menabuh rebana kecil, melipat origami.',
                'kurikulum'            => 'Kurikulum Merdeka PAUD',
            ],
        ];

        foreach ($aspeks as $item) {
            AspekPerkembangan::updateOrCreate(['kode_aspek' => $item['kode_aspek']], $item);
        }

        // 3. Sample Penilaian Harian Anak
        $siswas = Siswa::take(5)->get();
        $aspekNAM = AspekPerkembangan::where('kode_aspek', 'NAM-NU')->first();
        $aspekFM  = AspekPerkembangan::where('kode_aspek', 'FM-KASAR')->first();
        $aspekBHS = AspekPerkembangan::where('kode_aspek', 'BHS-LITERASI')->first();

        if ($siswas->count() > 0 && $aspekNAM) {
            PenilaianHarian::updateOrCreate([
                'siswa_id' => $siswas[0]->id,
                'aspek_id' => $aspekNAM->id,
                'tanggal'  => date('Y-m-d', strtotime('-2 days')),
            ], [
                'guru_id'         => $waliA,
                'skala_penilaian' => 'BSB',
                'catatan_anekdot' => 'Ananda sudah mampu melafalkan doa sebelum makan dan doa untuk orang tua dengan tartil dan lancar.',
            ]);
        }

        if ($siswas->count() > 1 && $aspekFM) {
            PenilaianHarian::updateOrCreate([
                'siswa_id' => $siswas[1]->id,
                'aspek_id' => $aspekFM->id,
                'tanggal'  => date('Y-m-d', strtotime('-3 days')),
            ], [
                'guru_id'         => $waliA,
                'skala_penilaian' => 'BSH',
                'catatan_anekdot' => 'Ananda sangat antusias saat praktik senam santri dan mampu melompati rintangan dengan seimbang.',
            ]);
        }

        if ($siswas->count() > 2 && $aspekBHS) {
            PenilaianHarian::updateOrCreate([
                'siswa_id' => $siswas[2]->id,
                'aspek_id' => $aspekBHS->id,
                'tanggal'  => date('Y-m-d', strtotime('-1 days')),
            ], [
                'guru_id'         => $waliB,
                'skala_penilaian' => 'BSB',
                'catatan_anekdot' => 'Ananda mampu menceritakan kembali kisah Nabi Yunus di dalam perut ikan paus dengan percaya diri di depan kelas.',
            ]);
        }

        // 4. Kategori Pembayaran Sekolah (Keuangan)
        $kategoris = [
            [
                'kode_biaya'      => 'SPP-BULANAN',
                'nama_biaya'      => 'SPP Bulanan Santri',
                'tipe'            => 'Bulanan',
                'nominal_default' => 60000,
                'deskripsi'       => 'Iuran operasional bulanan pembelajaran dan presensi santri.',
            ],
            [
                'kode_biaya'      => 'INFAQ-GEDUNG',
                'nama_biaya'      => 'Infaq Pengembangan Sarana & Gedung',
                'tipe'            => 'Sekali Bayar',
                'nominal_default' => 250000,
                'deskripsi'       => 'Infaq pemeliharaan sarana bermain luar dan gedung sekolah.',
            ],
            [
                'kode_biaya'      => 'SERAGAM-MAARIF',
                'nama_biaya'      => 'Paket Seragam Batik Ma\'arif & Olahraga',
                'tipe'            => 'Sekali Bayar',
                'nominal_default' => 180000,
                'deskripsi'       => 'Seragam batik hijau LP Ma\'arif NU, seragam olahraga, dan atribut.',
            ],
            [
                'kode_biaya'      => 'BUKU-MODUL',
                'nama_biaya'      => 'Buku Paket Panduan Belajar & Majalah Ceria',
                'tipe'            => 'Semesteran',
                'nominal_default' => 85000,
                'deskripsi'       => 'Modul tematik anak usia dini dan buku kreasi mewarnai.',
            ],
        ];

        foreach ($kategoris as $kat) {
            KategoriPembayaran::updateOrCreate(['kode_biaya' => $kat['kode_biaya']], $kat);
        }

        // 5. Data Tagihan & Transaksi Pembayaran
        $katSPP = KategoriPembayaran::where('kode_biaya', 'SPP-BULANAN')->first();
        if ($siswas->count() > 0 && $katSPP) {
            // Tagihan Siswa 1 (Lunas)
            $tagihan1 = TagihanSiswa::updateOrCreate([
                'no_tagihan' => 'INV-202611-001'
            ], [
                'siswa_id'          => $siswas[0]->id,
                'kategori_id'       => $katSPP->id,
                'periode_bulan'     => 'November',
                'tahun'             => 2026,
                'jumlah_tagihan'    => 60000,
                'jumlah_terbayar'   => 60000,
                'sisa_tagihan'      => 0,
                'status_pembayaran' => 'Lunas',
                'jatuh_tempo'       => '2026-11-10',
            ]);

            TransaksiPembayaran::updateOrCreate([
                'no_transaksi' => 'TRX-202611-001'
            ], [
                'tagihan_id'        => $tagihan1->id,
                'siswa_id'          => $siswas[0]->id,
                'petugas_id'        => $admin?->id,
                'tanggal_bayar'     => date('Y-m-d H:i:s', strtotime('-2 days')),
                'nominal_bayar'     => 60000,
                'metode_bayar'      => 'Tunai',
                'nama_penyetor'     => 'Ibu Fatimah (Wali Murid)',
                'catatan'           => 'Pembayaran lunas SPP November 2026 via bendahara.',
                'status_verifikasi' => 'Terverifikasi',
            ]);

            // Tagihan Siswa 2 (Belum Lunas)
            if ($siswas->count() > 1) {
                TagihanSiswa::updateOrCreate([
                    'no_tagihan' => 'INV-202611-002'
                ], [
                    'siswa_id'          => $siswas[1]->id,
                    'kategori_id'       => $katSPP->id,
                    'periode_bulan'     => 'November',
                    'tahun'             => 2026,
                    'jumlah_tagihan'    => 60000,
                    'jumlah_terbayar'   => 0,
                    'sisa_tagihan'      => 60000,
                    'status_pembayaran' => 'Belum Lunas',
                    'jatuh_tempo'       => '2026-11-10',
                ]);
            }
        }

        // 6. Data PPDB (Penerimaan Peserta Didik Baru Online)
        $ppdbData = [
            [
                'no_registrasi'      => 'PPDB-2026-001',
                'tahun_ajaran'       => '2026/2027',
                'nama_lengkap'       => 'Muhammad Zainal Arifin',
                'nama_panggilan'     => 'Zain',
                'nik'                => '3512010101220001',
                'tempat_lahir'       => 'Situbondo',
                'tanggal_lahir'      => '2022-04-12',
                'jenis_kelamin'      => 'L',
                'nama_ayah'          => 'Ahmad Zaini',
                'nama_ibu'           => 'Siti Rohmah',
                'pekerjaan_orangtua' => 'Wiraswasta',
                'no_whatsapp'        => '085234567890',
                'alamat'             => 'Dusun Krajan, Olean Tengah, Situbondo',
                'jalur_pendaftaran'  => 'Reguler',
                'status_seleksi'     => 'Diterima',
                'catatan_panitia'    => 'Berkas lengkap, akta kelahiran dan KK terverifikasi.',
            ],
            [
                'no_registrasi'      => 'PPDB-2026-002',
                'tahun_ajaran'       => '2026/2027',
                'nama_lengkap'       => 'Nur Aisyah Humaira',
                'nama_panggilan'     => 'Humaira',
                'nik'                => '3512010508220002',
                'tempat_lahir'       => 'Situbondo',
                'tanggal_lahir'      => '2022-08-15',
                'jenis_kelamin'      => 'P',
                'nama_ayah'          => 'Kholilur Rahman',
                'nama_ibu'           => 'Halimatus Sakdiyah',
                'pekerjaan_orangtua' => 'Guru Madrasah',
                'no_whatsapp'        => '082345678901',
                'alamat'             => 'Jl. Raya Olean No. 42, Situbondo',
                'jalur_pendaftaran'  => 'Afiliasi NU',
                'status_seleksi'     => 'Diterima',
                'catatan_panitia'    => 'Wali santri aktif di GP Ansor & Muslimat NU.',
            ],
            [
                'no_registrasi'      => 'PPDB-2026-003',
                'tahun_ajaran'       => '2026/2027',
                'nama_lengkap'       => 'Rizky Pratama Wijaya',
                'nama_panggilan'     => 'Rizky',
                'nik'                => '3512011210220003',
                'tempat_lahir'       => 'Situbondo',
                'tanggal_lahir'      => '2022-10-10',
                'jenis_kelamin'      => 'L',
                'nama_ayah'          => 'Eko Prasetyo',
                'nama_ibu'           => 'Tri Wahyuni',
                'pekerjaan_orangtua' => 'Petani / Wiraswasta',
                'no_whatsapp'        => '087812345678',
                'alamat'             => 'Desa Talkandang, Situbondo',
                'jalur_pendaftaran'  => 'Reguler',
                'status_seleksi'     => 'Menunggu Verifikasi',
                'catatan_panitia'    => 'Menunggu konfirmasi kartu vaksin dan fotokopi KK.',
            ],
        ];

        foreach ($ppdbData as $p) {
            PpdbPendaftaran::updateOrCreate(['no_registrasi' => $p['no_registrasi']], $p);
        }

        // 7. Data Inventaris Sarpras & APE Sekolah
        $inventaris = [
            [
                'kode_barang'          => 'APE-OUT-001',
                'nama_barang'          => 'Ayunan Putar Lingkaran Anak',
                'kategori_barang'      => 'APE Luar',
                'jumlah_total'         => 1,
                'satuan'               => 'Unit',
                'kondisi_baik'         => 1,
                'kondisi_rusak_ringan' => 0,
                'kondisi_rusak_berat'  => 0,
                'lokasi_penyimpanan'   => 'Halaman Bermain Luar',
                'sumber_pengadaan'     => 'BOP PAUD',
                'tahun_pengadaan'      => '2024',
            ],
            [
                'kode_barang'          => 'APE-OUT-002',
                'nama_barang'          => 'Perosotan Pelangi & Rumah Bola',
                'kategori_barang'      => 'APE Luar',
                'jumlah_total'         => 1,
                'satuan'               => 'Set',
                'kondisi_baik'         => 1,
                'kondisi_rusak_ringan' => 0,
                'kondisi_rusak_berat'  => 0,
                'lokasi_penyimpanan'   => 'Halaman Bermain Luar',
                'sumber_pengadaan'     => 'Infaq Wali Murid',
                'tahun_pengadaan'      => '2025',
            ],
            [
                'kode_barang'          => 'APE-IN-001',
                'nama_barang'          => 'Balok Bangun Kayu Pinus Geometri (50 Pcs)',
                'kategori_barang'      => 'APE Dalam',
                'jumlah_total'         => 4,
                'satuan'               => 'Set',
                'kondisi_baik'         => 4,
                'kondisi_rusak_ringan' => 0,
                'kondisi_rusak_berat'  => 0,
                'lokasi_penyimpanan'   => 'Sentra Balok Ruang Mawar',
                'sumber_pengadaan'     => 'Yayasan LP Ma\'arif NU',
                'tahun_pengadaan'      => '2025',
            ],
            [
                'kode_barang'          => 'APE-IN-002',
                'nama_barang'          => 'Puzzle Hijaiyah Kayu Berwarna',
                'kategori_barang'      => 'APE Dalam',
                'jumlah_total'         => 6,
                'satuan'               => 'Buah',
                'kondisi_baik'         => 5,
                'kondisi_rusak_ringan' => 1,
                'kondisi_rusak_berat'  => 0,
                'lokasi_penyimpanan'   => 'Sentra Agama Ruang Melati',
                'sumber_pengadaan'     => 'BOP PAUD',
                'tahun_pengadaan'      => '2024',
            ],
            [
                'kode_barang'          => 'ELEK-001',
                'nama_barang'          => 'Smart TV Android 50 Inch untuk Media Pembelajaran',
                'kategori_barang'      => 'Elektronik',
                'jumlah_total'         => 2,
                'satuan'               => 'Unit',
                'kondisi_baik'         => 2,
                'kondisi_rusak_ringan' => 0,
                'kondisi_rusak_berat'  => 0,
                'lokasi_penyimpanan'   => 'Ruang Kelas A & Kelas B',
                'sumber_pengadaan'     => 'BOP PAUD',
                'tahun_pengadaan'      => '2025',
            ],
            [
                'kode_barang'          => 'MUS-001',
                'nama_barang'          => 'Set Rebana Hadrah Cilik Anak',
                'kategori_barang'      => 'Buku & Media',
                'jumlah_total'         => 1,
                'satuan'               => 'Set',
                'kondisi_baik'         => 1,
                'kondisi_rusak_ringan' => 0,
                'kondisi_rusak_berat'  => 0,
                'lokasi_penyimpanan'   => 'Lemari Ekstrakurikuler',
                'sumber_pengadaan'     => 'Yayasan LP Ma\'arif NU',
                'tahun_pengadaan'      => '2025',
            ],
        ];

        foreach ($inventaris as $inv) {
            InventarisBarang::updateOrCreate(['kode_barang' => $inv['kode_barang']], $inv);
        }

        // 8. Data Pengumuman Resmi Sekolah
        $pengumumans = [
            [
                'judul'          => 'Edaran Kegiatan Manasik Haji Santri Cilik 2026',
                'slug'           => 'edaran-manasik-haji-santri-cilik-2026',
                'kategori'       => 'Kegiatan',
                'target_audiens' => 'Wali Murid',
                'isi_pengumuman' => 'Diberitahukan kepada seluruh wali murid TK NU 04 Situbondo bahwa kegiatan praktik Manasik Haji Cilik akan dilaksanakan pada hari Sabtu, mengenakan pakaian ihram putih. Anak-anak dimohon tiba di sekolah pukul 07.00 WIB.',
                'is_published'   => true,
                'published_at'   => date('Y-m-d H:i:s', strtotime('-1 days')),
                'author_id'      => $admin?->id,
            ],
            [
                'judul'          => 'Jadwal Libur Nasional & Cuti Bersama Semester Genap',
                'slug'           => 'jadwal-libur-nasional-semester-genap-2026',
                'kategori'       => 'Hari Libur',
                'target_audiens' => 'Semua',
                'isi_pengumuman' => 'Menindaklanjuti kalender akademik dinas dan LP Ma\'arif NU, pembelajaran diliburkan pada hari yang telah dijadwalkan dan aktif kembali sesuai kalender sekolah.',
                'is_published'   => true,
                'published_at'   => date('Y-m-d H:i:s', strtotime('-5 days')),
                'author_id'      => $admin?->id,
            ],
            [
                'judul'          => 'Undangan Pertemuan Rutin Parenting & Paguyuban Wali Santri',
                'slug'           => 'undangan-parenting-paguyuban-wali-santri',
                'kategori'       => 'Parenting',
                'target_audiens' => 'Wali Murid',
                'isi_pengumuman' => 'Kami mengundang bapak/ibu wali murid untuk hadir dalam majelis parenting bertajuk "Mendidik Karakter Islami Anak di Era Digital", bertempat di aula TK NU 04.',
                'is_published'   => true,
                'published_at'   => date('Y-m-d H:i:s', strtotime('-10 days')),
                'author_id'      => $admin?->id,
            ],
        ];

        foreach ($pengumumans as $p) {
            Pengumuman::updateOrCreate(['slug' => $p['slug']], $p);
        }
    }
}

