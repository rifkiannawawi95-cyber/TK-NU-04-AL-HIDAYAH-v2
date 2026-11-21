# Panduan Deployment: TK NU 04 AL-HIDAYAH

Repositori ini disiapkan untuk deployment modern dengan arsitektur:
* **Source Control**: GitHub
* **Application Server**: Vercel (Container Runtime + Docker + FrankenPHP & Caddy)
* **Database**: Aiven Managed MySQL (dengan enkripsi SSL/TLS CA Certificate)

---

## 1. Arsitektur & Alur Kerja

```
GitHub Repository (Push)
        │
        ▼
Vercel Container Runtime (Fluid Compute)
  - Docker multi-stage build (Node.js Vite assets + Composer dependencies)
  - FrankenPHP (PHP 8.4 + Caddy Web Server terintegrasi)
  - Port otomatis mengikuti $PORT dari Vercel
        │
        ├──► Terhubung via SSL/TLS (certs/aiven-ca.pem)
        ▼
Aiven Cloud MySQL Database
```

---

## 2. File Konfigurasi Utama

| File | Fungsi |
|---|---|
| `Dockerfile` | Multi-stage container build (Vite asset build, composer production install, FrankenPHP runner) |
| `Caddyfile` | Konfigurasi FrankenPHP & Caddy server, routing `/index.php`, kompresi Zstandard/Gzip, dan binding port `:{$PORT:-80}` |
| `vercel.json` | Penanda framework container untuk Vercel (`{"framework": "container"}`) |
| `.dockerignore` | Mencegah file lokal, `.env`, SQLite, dan node_modules masuk ke image Docker |
| `docker-entrypoint.sh` | Inisialisasi symlink storage dan caching config/route/view di production |
| `certs/aiven-ca.pem` | Sertifikat SSL publik dari Aiven untuk mengamankan koneksi PDO MySQL |
| `aiven-data-import.sql` | Dump data awal sekolah untuk diimpor ke Aiven (di-ignore dari git agar aman) |

---

## 3. Langkah 1: Persiapan Database di Aiven Console

1. Buka console Aiven di browser: **https://console.aiven.io/**
2. Buat service baru:
   - Service Type: **MySQL**
   - Cloud Provider & Region: Pilih yang terdekat (misal: *AWS Singapore / ap-southeast-1*)
   - Plan: Pilih plan yang tersedia (misal Free Tier atau Startup)
   - Service Name: `tk-nu-04-db`
3. Setelah status service menjadi **Running**:
   - Catat detail koneksi:
     - **Host**: `mysql-xxxx.aivencloud.com`
     - **Port**: `xxxxx` (misal 12345)
     - **User**: `avnadmin`
     - **Password**: *(klik ikon mata untuk menyalin)*
     - **Database**: `defaultdb`
4. **Unduh CA Certificate**:
   - Di tab *Overview* service Aiven, cari bagian **CA Certificate**.
   - Unduh atau simpan file tersebut sebagai:  
     `certs/aiven-ca.pem` di root folder proyek ini.

---

## 4. Langkah 2: Migrasi & Impor Data ke Aiven MySQL

Jalankan perintah ini di terminal lokal Anda (PowerShell).  
*Catatan: Ganti nilai variabel di bawah dengan kredensial dari Aiven Anda saat eksekusi. Jangan simpan ke file yang di-commit.*

```powershell
# Set environment sementara di sesi PowerShell ini saja
$env:DB_CONNECTION = "mysql"
$env:DB_HOST = "mysql-xxxx.aivencloud.com"
$env:DB_PORT = "xxxxx"
$env:DB_DATABASE = "defaultdb"
$env:DB_USERNAME = "avnadmin"
$env:DB_PASSWORD = "PASSWORD_AIVEN_ANDA"
$env:MYSQL_ATTR_SSL_CA = "certs/aiven-ca.pem"

# 1. Jalankan struktur tabel via migration
php artisan migrate --force

# 2. Impor data sekolah, guru, pengaturan, dan testimoni
mysql -h $env:DB_HOST -P $env:DB_PORT -u $env:DB_USERNAME -p$env:DB_PASSWORD --ssl-ca=certs/aiven-ca.pem $env:DB_DATABASE < aiven-data-import.sql
```

---

## 5. Langkah 3: Siapkan Git & Push ke GitHub

1. Pastikan file rahasia tidak ikut ter-commit:
   - File `.env`, `vendor/`, `database/*.sqlite`, dan `aiven-data-import.sql` sudah terdaftar di `.gitignore`.
2. Inisialisasi dan commit:
   ```bash
   git init
   git add .
   git commit -m "feat: ready for vercel container deployment with frankenphp and aiven mysql"
   ```
3. Hubungkan ke repositori GitHub baru dan push:
   ```bash
   git branch -M main
   git remote add origin https://github.com/USERNAME/NAMA-REPO.git
   git push -u origin main
   ```

---

## 6. Langkah 4: Deploy di Vercel

1. Buka dashboard Vercel: **https://vercel.com/new**
2. Hubungkan akun GitHub Anda dan pilih repositori yang baru saja dibuat.
3. Pada halaman **Configure Project**:
   - Project Name: `tk-nu-04-al-hidayah`
   - Framework Preset: Pilih **Other** (Vercel otomatis mendeteksi `Dockerfile` dan `vercel.json` dengan preset container).
4. Masukkan **Environment Variables**:
   
   | Nama Variable | Contoh Nilai | Keterangan |
   |---|---|---|
   | `APP_NAME` | `TK NU 04 Situbondo` | Nama aplikasi |
   | `APP_ENV` | `production` | Mode production |
   | `APP_DEBUG` | `false` | Matikan debug di production |
   | `APP_URL` | `https://tk-nu-04-al-hidayah.vercel.app` | URL Vercel Anda |
   | `APP_KEY` | `base64:...` | Ambil dari file `.env` lokal |
   | `DB_CONNECTION` | `mysql` | Driver MySQL |
   | `DB_HOST` | `mysql-xxxx.aivencloud.com` | Host database Aiven |
   | `DB_PORT` | `xxxxx` | Port database Aiven |
   | `DB_DATABASE` | `defaultdb` | Nama database di Aiven |
   | `DB_USERNAME` | `avnadmin` | Username database |
   | `DB_PASSWORD` | `********` | Password database |
   | `MYSQL_ATTR_SSL_CA` | `certs/aiven-ca.pem` | Path relatif sertifikat CA |
   | `SESSION_DRIVER` | `cookie` atau `database` | Driver session |
   | `CACHE_STORE` | `database` | Driver cache |

5. Klik tombol **Deploy** dan tunggu proses container build selesai.

---

## 7. Langkah 5: Pengujian & Troubleshooting

Setelah deployment selesai di Vercel:
1. **Tes Halaman Publik**:
   - Beranda (`/`)
   - Profil Sekolah (`/profil`)
   - Acara & Agenda (`/acara`)
   - Galeri Kegiatan (`/galeri`)
   - Prestasi (`/prestasi`)
   - Kontak & Alamat (`/kontak`)
   - Testimoni Wali Santri (`/#testimoni`)
2. **Tes Autentikasi & Dashboard Admin**:
   - Buka `/login`
   - Masuk dengan akun administrator
   - Buka `/admin/dashboard` dan periksa menu-menu di sidebar.
3. **Troubleshooting Error 500 / 502**:
   - Buka menu **Deployments** di Vercel -> Pilih deployment aktif -> Buka tab **Runtime Logs**.
   - Jika error `SQLSTATE[HY000] [2002] Connection refused / SSL error`: periksa kembali `DB_HOST`, `DB_PORT`, dan `MYSQL_ATTR_SSL_CA`.
   - Jika error `No application encryption key has been specified`: pastikan variable `APP_KEY` sudah terisi di Vercel Environment Variables.
