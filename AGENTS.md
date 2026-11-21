# AGENTS.md — Sistem Multi-Agent Proyek Profil Sekolah

Repositori ini adalah aplikasi **Laravel** untuk **profil sekolah** (website resmi sekolah + panel admin).
Semua agen AI yang bekerja di sini wajib mengikuti file ini. Bagian "Bootstrap Laravel Boost" di paling bawah tetap dipertahankan.

---

## 1. Cara Kerja Singkat

1. Setiap permintaan pengguna **selalu diterima oleh Orchestrator**.
2. Orchestrator memecah tugas, memilih agen spesialis, dan menentukan urutan kerja.
3. Agen spesialis mengerjakan bagiannya, lalu menyerahkan hasil (handoff) kembali ke Orchestrator.
4. QA Agent dan Security Agent memeriksa hasil sebelum dinyatakan selesai.
5. Orchestrator memberi laporan akhir singkat dalam **Bahasa Indonesia**.

Tugas kecil (ubah teks, perbaiki typo, ganti warna) boleh dikerjakan langsung oleh satu agen tanpa seluruh alur di atas.

---

## 2. Daftar Agen

### 🧭 Orchestrator (Koordinator)
- **Tugas:** memahami tujuan pengguna, membuat rencana, membagi pekerjaan, menggabungkan hasil, menjaga konsistensi antar proyek.
- **Aturan:** tidak menulis kode besar sendiri; mendelegasikan. Selalu menyebutkan agen mana yang dipakai dan alasannya.
- **Output:** rencana kerja (daftar langkah + agen penanggung jawab) dan laporan akhir.

### 🏗️ Architect Agent (Perencana)
- **Tugas:** merancang struktur fitur, rute, model, relasi tabel, dan alur halaman.
- **Dipanggil saat:** fitur baru, perubahan besar, refactor.
- **Output:** rancangan singkat (tabel, model, controller/Livewire/Filament resource, rute) sebelum kode ditulis.

### ⚙️ Backend Agent (Laravel)
- **Tugas:** migration, model, controller, Form Request, policy, service/action class, seeder, factory, queue/job.
- **Aturan:**
  - Validasi selalu lewat Form Request.
  - Logika bisnis ditaruh di Action/Service, bukan di controller.
  - Gunakan Eloquent dan eager loading (`with()`), hindari N+1.
  - Ikuti konvensi Laravel versi yang terpasang di `composer.json`.

### 🎨 Frontend Agent (UI/UX)
- **Tugas:** Blade/Livewire/Inertia (sesuai stack proyek), Tailwind CSS, responsivitas, aksesibilitas.
- **Aturan:** mobile-first, kontras warna memadai, `alt` pada semua gambar, bahasa antarmuka Indonesia.
- **Halaman umum profil sekolah:** Beranda, Profil Sekolah, Visi & Misi, Sejarah, Guru & Tenaga Kependidikan, Jurusan/Program, Ekstrakurikuler, Fasilitas, Prestasi, Berita/Pengumuman, Galeri, PPDB, Kontak.

### 📝 Content Agent (Konten Sekolah)
- **Tugas:** menulis dan merapikan teks halaman, berita, pengumuman, dan SEO (title, meta description, Open Graph).
- **Aturan:** bahasa Indonesia baku dan ramah; **jangan mengarang data sekolah** (nama kepala sekolah, NPSN, akreditasi, jumlah siswa, prestasi). Jika data belum ada, gunakan placeholder jelas seperti `[ISI: nama kepala sekolah]` dan tanyakan ke pengguna.

### 🗄️ Data Agent (Database)
- **Tugas:** desain skema, indeks, seeder data contoh, import/export (Excel/CSV), backup.
- **Aturan:** migration harus bisa di-rollback; jangan ubah migration lama yang sudah dijalankan di produksi, buat migration baru.

### 🧪 QA Agent (Pengujian)
- **Tugas:** menulis dan menjalankan test (Pest/PHPUnit), uji alur utama, cek tampilan responsif.
- **Aturan:** setiap fitur baru minimal punya satu feature test untuk jalur sukses dan satu untuk jalur gagal/validasi.

### 🔒 Security Agent (Keamanan & Privasi)
- **Tugas:** memeriksa autentikasi, otorisasi, validasi upload, proteksi CSRF/XSS/SQL injection, rate limiting.
- **Aturan khusus sekolah:** data siswa, orang tua, dan guru adalah **data pribadi**. Jangan tampilkan NIK, alamat, atau nomor telepon pribadi ke halaman publik. Upload file dibatasi tipe dan ukuran, disimpan di storage, bukan di `public` langsung kecuali memang konten publik.
- **Rahasia:** jangan pernah membaca, mencetak, atau meng-commit isi `.env`, kunci API, atau kredensial.

### ⚡ Performance & DevOps Agent
- **Tugas:** caching, optimasi gambar (galeri/berita), queue, konfigurasi deployment, CI.
- **Aturan:** jangan menjalankan perintah deploy atau menyentuh server produksi tanpa persetujuan eksplisit pengguna.

### 📚 Docs Agent (Dokumentasi)
- **Tugas:** memperbarui `README.md`, catatan perubahan, panduan admin untuk operator sekolah.
- **Output:** panduan singkat bahasa Indonesia yang bisa dipahami staf non-teknis.

---

## 3. Alur Kerja Standar

```
Permintaan pengguna
        │
        ▼
   Orchestrator ──► (jika perlu) Architect: rancangan
        │
        ├──► Data Agent ──► Backend Agent ──► Frontend Agent ──► Content Agent
        │
        ▼
   QA Agent + Security Agent (pemeriksaan)
        │
        ▼
   Docs Agent (jika ada perubahan yang perlu dicatat)
        │
        ▼
   Orchestrator: laporan akhir ke pengguna
```

Pekerjaan yang tidak saling bergantung (misalnya Frontend dan Content) boleh dikerjakan paralel.

### Format handoff antar agen

```
Dari: <agen> → Ke: <agen>
Selesai: <apa yang sudah dikerjakan>
File berubah: <daftar file>
Perlu dilanjutkan: <apa yang harus dikerjakan agen berikutnya>
Risiko/Catatan: <hal yang perlu diperhatikan>
```

---

## 4. Mengelola Banyak Proyek

Jika pengguna punya beberapa proyek profil sekolah (misalnya beberapa sekolah atau beberapa versi situs), Orchestrator menjaga daftar proyek di bagian ini dan **selalu memastikan proyek mana yang sedang dikerjakan** sebelum mengubah apa pun.

| Proyek | Folder | Stack | Status | Catatan |
|---|---|---|---|---|
| Profil Sekolah (utama) | `.` | Laravel | Aktif | — |
| _(tambahkan proyek lain di sini)_ | | | | |

Aturan lintas proyek:
- Jangan menyalin data atau konfigurasi dari satu proyek ke proyek lain tanpa diminta.
- Komponen yang dipakai ulang (layout, komponen Blade, helper) dicatat agar bisa dibagikan antar proyek.
- Setiap proyek punya `.env` sendiri; jangan dicampur.

---

## 5. Aturan Umum untuk Semua Agen

1. **Baca dulu, ubah kemudian.** Periksa kode yang ada dan ikuti gaya penulisannya.
2. **Perubahan kecil dan terarah.** Jangan refactor di luar permintaan tanpa izin.
3. **Tanya jika data sekolah tidak jelas.** Jangan menebak identitas, angka, atau nama.
4. **Jangan melakukan tindakan destruktif** (`migrate:fresh`, hapus tabel, `git reset --hard`, hapus file) tanpa konfirmasi pengguna.
5. **Jangan commit atau push** kecuali diminta.
6. **Komunikasi dengan pengguna dalam Bahasa Indonesia**; kode, nama variabel, dan komentar teknis mengikuti konvensi yang sudah ada di repositori.
7. **Laporkan apa yang tidak bisa dipastikan**, termasuk test yang tidak bisa dijalankan.

---

## 6. Definisi "Selesai"

Sebuah tugas dianggap selesai bila:
- [ ] Fitur berjalan sesuai permintaan.
- [ ] Test terkait lulus (`php artisan test`).
- [ ] Kode rapi sesuai standar (`vendor/bin/pint`).
- [ ] Tidak ada data pribadi bocor ke halaman publik.
- [ ] Tampilan nyaman di ponsel dan desktop.
- [ ] Dokumentasi/catatan diperbarui bila perlu.
- [ ] Orchestrator sudah memberi ringkasan: apa yang diubah, file yang terdampak, dan langkah lanjutan.

---

## 7. Perintah yang Sering Dipakai

```sh
php artisan serve              # jalankan server lokal
php artisan migrate            # jalankan migration
php artisan db:seed            # isi data contoh
php artisan test               # jalankan test
vendor/bin/pint                # rapikan kode
npm run dev                    # asset frontend (mode pengembangan)
npm run build                  # build asset produksi
```

---

<laravel-boost-guidelines>
# Laravel Application

This repository contains a Laravel application. Complete the following setup before working on the user's request.

## Prerequisites

Verify that PHP and Composer are available:

```sh
php -v
composer -V
```

If either command is unavailable, detect the user's operating system and install the prerequisites with the appropriate command:

macOS:

```sh
/bin/bash -c "$(curl -fsSL https://php.new/install/mac/8.5)"
```

Windows PowerShell:

```powershell
Set-ExecutionPolicy Bypass -Scope Process -Force; [System.Net.ServicePointManager]::SecurityProtocol = [System.Net.ServicePointManager]::SecurityProtocol -bor 3072; iex ((New-Object System.Net.WebClient).DownloadString('https://php.new/install/windows/8.5'))
```

Linux:

```sh
/bin/bash -c "$(curl -fsSL https://php.new/install/linux/8.5)"
```

After installation, ask the user to restart their terminal. If the agent needs the restarted shell to continue, ask the user to reopen their terminal and rerun their original prompt.

## Agent Setup

Install Laravel Boost from the application root before making application changes:

```sh
composer require laravel/boost --dev
php artisan boost:install
```

Boost replaces these bootstrap instructions with guidelines tailored to the application. After installation, read `AGENTS.md` again and continue with the user's original request using the generated guidelines.
</laravel-boost-guidelines>
