<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Prestasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_siswa', 'kelas', 'nama_lomba', 'tingkat', 'juara', 'tanggal', 'keterangan', 'foto'
    ];

    protected $appends = [
        'foto_url',
    ];

    /**
     * Accessor untuk URL foto prestasi dengan fallback ke avatar/trofi aman.
     * Desain: selalu generate URL yang valid; penglihatan file dilakukan melalui
     * nama file saja (tanpa bergantung `file_exists` pada symlink Laragon).
     */
    public function getFotoUrlAttribute(): string
    {
        return static::resolveFotoUrl($this->foto);
    }

    /**
     * Helper static resolusi URL foto prestasi.
     * Strategi: (1) external URL -> kembalikan sebilangnya, (2) path sudah lengkap 
     * `storage/prestasi/filename` -> pastikan ada di public/storage/prestasi/ 
     * melalui asset(), (3) fallback ke SVG default.
     */
    public static function resolveFotoUrl(?string $fotoPath): string
    {
        $defaultFallback = asset('images/default-prestasi.svg');

        if (empty($fotoPath)) {
            return $defaultFallback;
        }

        $trimmed = trim($fotoPath);

        // 1. Jika sudah URL eksternal (http/https) -> kembalikan langsung
        if (str_starts_with($trimmed, 'http://') || str_starts_with($trimmed, 'https://')) {
            return $trimmed;
        }

        // 2. Bersihkan path (hapus slash depan)
        $clean = ltrim($trimmed, '/\\');

        // 3. Jika path diawali 'storage/' (format baru setelah migrasi DB)
        if (str_starts_with($clean, 'storage/')) {
            // Ambil sisa path setelah storage/ (bisa 'prestasi/filename' atau 'filename')
            $remaining = substr($clean, 8); // hapus prefix 'storage/'
            // Jika sisanya dimulai dengan 'prestasi/', ambil filename di belakangnya
            if (str_starts_with($remaining, 'prestasi/')) {
                $filename = basename($remaining); // hanya nama file
                return asset('storage/prestasi/' . $filename);
            }
            // Jika tidak ada subdir, anggap nama filenya langsung
            return asset('storage/' . $remaining);
        }

        // 4. Jika path diawali 'uploads/' (format lama)
        if (str_starts_with($clean, 'uploads/')) {
            $filename = basename($clean);
            return asset('uploads/' . $filename);
        }

        // 5. Path standar tanpa prefix (hanya nama file) - gabungkan dengan storage/
        //    Ini menangani kasus foto disimpan hanya sebagai 'prestasi/filename.jpg'
        //    atau 'filename.jpg' di database.
        if (preg_match('/^prestasi\//i', $clean)) {
            $filename = basename($clean);
            return asset('storage/' . $filename);
        }

        // 6. Fallback umum: coba asset dengan nama file jika cocok pattern
        if (preg_match('/\.[a-z0-9]+$/i', $clean)) {
            $filename = basename($clean);
            return asset('storage/' . $filename);
        }

        // 7. Fallback ke default
        return $defaultFallback;
    }
}
