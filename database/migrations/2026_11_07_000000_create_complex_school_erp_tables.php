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
        // 1. Tabel Kelas / Rombongan Belajar
        if (!Schema::hasTable('kelas')) {
            Schema::create('kelas', function (Blueprint $table) {
                $table->id();
                $table->string('nama_kelas');
                $table->string('kode_kelas')->unique();
                $table->string('tingkat'); // KB, TK-A, TK-B
                $table->foreignId('wali_kelas_id')->nullable()->constrained('gurus')->nullOnDelete();
                $table->string('ruangan')->nullable();
                $table->integer('kapasitas')->default(25);
                $table->string('tahun_ajaran')->default('2026/2027');
                $table->timestamps();
            });
        }

        // Tambah kelas_id pada tabel siswas jika belum ada
        if (Schema::hasTable('siswas') && !Schema::hasColumn('siswas', 'kelas_id')) {
            Schema::table('siswas', function (Blueprint $table) {
                $table->foreignId('kelas_id')->nullable()->after('kelas')->constrained('kelas')->nullOnDelete();
            });
        }

        // 2. Tabel Aspek Perkembangan Anak Usia Dini (Kurikulum PAUD/Kemendikbud)
        if (!Schema::hasTable('aspek_perkembangans')) {
            Schema::create('aspek_perkembangans', function (Blueprint $table) {
                $table->id();
                $table->string('kode_aspek')->unique();
                $table->string('nama_aspek');
                $table->text('keterangan_indikator')->nullable();
                $table->string('kurikulum')->default('Kurikulum Merdeka PAUD');
                $table->timestamps();
            });
        }

        // 3. Tabel Penilaian Harian Anak
        if (!Schema::hasTable('penilaian_harians')) {
            Schema::create('penilaian_harians', function (Blueprint $table) {
                $table->id();
                $table->foreignId('siswa_id')->constrained('siswas')->cascadeOnDelete();
                $table->foreignId('aspek_id')->constrained('aspek_perkembangans')->cascadeOnDelete();
                $table->foreignId('guru_id')->nullable()->constrained('gurus')->nullOnDelete();
                $table->date('tanggal');
                $table->enum('skala_penilaian', ['BSB', 'BSH', 'MB', 'BB'])->default('BSH');
                $table->text('catatan_anekdot')->nullable();
                $table->string('foto_kegiatan')->nullable();
                $table->timestamps();
            });
        }

        // 4. Tabel Kategori Pembayaran (Keuangan Sekolah)
        if (!Schema::hasTable('kategori_pembayarans')) {
            Schema::create('kategori_pembayarans', function (Blueprint $table) {
                $table->id();
                $table->string('kode_biaya')->unique();
                $table->string('nama_biaya');
                $table->string('tipe')->default('Bulanan'); // Bulanan, Sekali Bayar, Insidental
                $table->decimal('nominal_default', 12, 2)->default(0);
                $table->text('deskripsi')->nullable();
                $table->timestamps();
            });
        }

        // 5. Tabel Tagihan Biaya Siswa
        if (!Schema::hasTable('tagihan_siswas')) {
            Schema::create('tagihan_siswas', function (Blueprint $table) {
                $table->id();
                $table->string('no_tagihan')->unique();
                $table->foreignId('siswa_id')->constrained('siswas')->cascadeOnDelete();
                $table->foreignId('kategori_id')->constrained('kategori_pembayarans')->cascadeOnDelete();
                $table->string('periode_bulan');
                $table->integer('tahun');
                $table->decimal('jumlah_tagihan', 12, 2);
                $table->decimal('jumlah_terbayar', 12, 2)->default(0);
                $table->decimal('sisa_tagihan', 12, 2)->default(0);
                $table->string('status_pembayaran')->default('Belum Lunas'); // Lunas, Belum Lunas, Cicilan
                $table->date('jatuh_tempo')->nullable();
                $table->timestamps();
            });
        }

        // 6. Tabel Transaksi Pembayaran / Kasir
        if (!Schema::hasTable('transaksi_pembayarans')) {
            Schema::create('transaksi_pembayarans', function (Blueprint $table) {
                $table->id();
                $table->string('no_transaksi')->unique();
                $table->foreignId('tagihan_id')->constrained('tagihan_siswas')->cascadeOnDelete();
                $table->foreignId('siswa_id')->constrained('siswas')->cascadeOnDelete();
                $table->foreignId('petugas_id')->nullable()->constrained('users')->nullOnDelete();
                $table->dateTime('tanggal_bayar');
                $table->decimal('nominal_bayar', 12, 2);
                $table->string('metode_bayar')->default('Tunai'); // Tunai, Transfer BSI, QRIS
                $table->string('nama_penyetor')->nullable();
                $table->text('catatan')->nullable();
                $table->string('status_verifikasi')->default('Terverifikasi');
                $table->timestamps();
            });
        }

        // 7. Tabel PPDB (Penerimaan Peserta Didik Baru Online)
        if (!Schema::hasTable('ppdb_pendaftarans')) {
            Schema::create('ppdb_pendaftarans', function (Blueprint $table) {
                $table->id();
                $table->string('no_registrasi')->unique();
                $table->string('tahun_ajaran')->default('2026/2027');
                $table->string('nama_lengkap');
                $table->string('nama_panggilan')->nullable();
                $table->string('nik', 20)->nullable();
                $table->string('tempat_lahir')->nullable();
                $table->date('tanggal_lahir')->nullable();
                $table->enum('jenis_kelamin', ['L', 'P'])->default('L');
                $table->string('nama_ayah')->nullable();
                $table->string('nama_ibu')->nullable();
                $table->string('pekerjaan_orangtua')->nullable();
                $table->string('no_whatsapp', 25)->nullable();
                $table->text('alamat')->nullable();
                $table->string('jalur_pendaftaran')->default('Reguler'); // Reguler, Afiliasi NU, Beasiswa Yatim
                $table->string('status_seleksi')->default('Menunggu Verifikasi'); // Menunggu Verifikasi, Diterima, Cadangan, Ditolak
                $table->text('catatan_panitia')->nullable();
                $table->timestamps();
            });
        }

        // 8. Tabel Inventaris Sarana & Prasarana / APE
        if (!Schema::hasTable('inventaris_barangs')) {
            Schema::create('inventaris_barangs', function (Blueprint $table) {
                $table->id();
                $table->string('kode_barang')->unique();
                $table->string('nama_barang');
                $table->string('kategori_barang'); // APE Luar, APE Dalam, Mebel, Elektronik, Buku & Media
                $table->integer('jumlah_total')->default(1);
                $table->string('satuan', 20)->default('Unit');
                $table->integer('kondisi_baik')->default(1);
                $table->integer('kondisi_rusak_ringan')->default(0);
                $table->integer('kondisi_rusak_berat')->default(0);
                $table->string('lokasi_penyimpanan')->nullable();
                $table->string('sumber_pengadaan')->nullable(); // BOP PAUD, Yayasan LP Ma'arif, Infaq Wali Murid
                $table->string('tahun_pengadaan', 10)->nullable();
                $table->timestamps();
            });
        }

        // 9. Tabel Pengumuman Sekolah
        if (!Schema::hasTable('pengumumans')) {
            Schema::create('pengumumans', function (Blueprint $table) {
                $table->id();
                $table->string('judul');
                $table->string('slug')->unique();
                $table->string('kategori'); // Akademik, Libur, Himbauan, Parenting
                $table->string('target_audiens')->default('Semua'); // Semua, Wali Murid, Dewan Guru
                $table->text('isi_pengumuman');
                $table->string('file_lampiran')->nullable();
                $table->boolean('is_published')->default(true);
                $table->dateTime('published_at')->nullable();
                $table->foreignId('author_id')->nullable()->constrained('users')->nullOnDelete();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengumumans');
        Schema::dropIfExists('inventaris_barangs');
        Schema::dropIfExists('ppdb_pendaftarans');
        Schema::dropIfExists('transaksi_pembayarans');
        Schema::dropIfExists('tagihan_siswas');
        Schema::dropIfExists('kategori_pembayarans');
        Schema::dropIfExists('penilaian_harians');
        Schema::dropIfExists('aspek_perkembangans');
        
        if (Schema::hasTable('siswas') && Schema::hasColumn('siswas', 'kelas_id')) {
            Schema::table('siswas', function (Blueprint $table) {
                $table->dropColumn('kelas_id');
            });
        }

        Schema::dropIfExists('kelas');
    }
};

