# AGENTS.md — Sistem Multi-Agent Proyek Profil Sekolah

**Proyek:** Aplikasi Laravel website profil sekolah + panel admin.  
**Sumber kepercayaan:** `opencode.json` mengkonfigurasi 6 sub-agent (raga, raka, bima, citra, dewi, eka, fajar).

---

## 1. Alur Kerja

```
Permintaan pengguna
        │
        ▼
   Orchestrator ──► (jika perlu) Architect: rancangan
        │
        ├──► Backend Agent ──► Frontend Agent ──► Content Agent
        │
        ▼
   QA Agent + Security Agent (pemeriksaan)
        │
        ▼
   Orchestrator: laporan akhir ke pengguna
```

*Frontend dan Content boleh dikerjakan paralel.*

### Format handoff antar agen

```
Dari: <agen> → Ke: <agen>
Selesai: <apa yang sudah dikerjakan>
File berubah: <daftar file>
Perlu dilanjutkan: <apa yang harus dikerjakan agen berikutnya>
Risiko/Catatan: <hal yang perlu diperhatikan>
```

---

## 2. Agen dan Tanggung Jawab

| Agen | Fokus | Output |
|---|---|---|
| **Orchestrator** | Mempecah tugas, menggabungkan hasil, laporan | Rencana kerja + laporan akhir |
| **Architect (raka)** | Struktur fitur, rute, model, relasi tabel | Rancangan singkat sebelum kode |
| **Backend (bima)** | Migration, model, controller, Form Request, policy, service/action | File berubah + 3-baris laporan |
| **Frontend (citra)** | Blade/Livewire + Tailwind, responsivitas, aksesibilitas | File berubah + 3-baris laporan |
| **Database (dewi)** | Desain skema, migration, seeder, optimasi query | File berubah + 3-baris laporan |
| **Tester (eka)** | Test Pest/PHPUnit, cover jalur sukses & gagal | Test lulus/gagal + penyebab 5 baris |
| **Reviewer (fajar)** | Keamanan, performa, kualitas kode (hanya baca) | Daftar temuan kritis, tidak edit file |

**Aturan per agen:** Lapor maksimal 3-5 baris. Jangan menulis kode besar sendiri.

---

## 3. Aturan Utama (wajib diikuti)

1. **Baca dulu, ubah kemudian.** Periksa kode yang ada dan ikuti gaya penulisannya.
2. **Jangan menebak data sekolah.** Jika data belum ada, gunakan placeholder: `[ISI: nama kepala sekolah]`.
3. **Data pribadi tidak boleh bocor.** Jangan tampilkan NIK, alamat, atau nomor telepon pribadi ke halaman publik.
4. **Validasi lewat Form Request.** Tidak ada validasi langsung di controller.
5. **Logika bisnis di Action/Service, bukan controller.**
6. **Gunakan Eloquent + eager loading (`with()`).** Hindari N+1 queries.
7. **Migration harus bisa di-rollback.** Jangan ubah migration lama yang sudah di produksi — buat migration baru.
8. **Bahasa Indonesia** untuk kode, variabel, dan komentar teknis (konvensi repo).
9. **Jangan melakukan tindakan destruktif** (`migrate:fresh`, `git reset --hard`, hapus file) tanpa konfirmasi pengguna.
10. **Jangan commit/push** tanpa diminta.
11. **Laporkan apa yang tidak bisa dipastikan**, termasuk test yang tidak bisa dijalankan.

---

## 4. Perintah yang Sering Dipakai (non-obvious)

```sh
php artisan serve              # jalankan server lokal
php artisan migrate            # jalankan migration (tidak paksa)
php artisan db:seed            # isi data contoh
php artisan test               # jalankan test (clear config terpisah)
vendor/bin/pint                # rapikan kode (atasan tanpa argumen)
npm run dev                    # asset frontend mode pengembangan
npm run build                  # build asset produksi
```

---

## 5. Definisi "Selesai"

- [ ] Fitur berjalan sesuai permintaan.
- [ ] Test terkait lulus (`php artisan test`).
- [ ] Kode rapi sesuai standar (`vendor/bin/pint`).
- [ ] Tidak ada data pribadi bocor ke halaman publik.
- [ ] Tampilan nyaman di ponsel dan desktop.
- [ ] Orchestrator sudah memberi ringkasan: apa yang diubah, file yang terdampak, langkah lanjutan.