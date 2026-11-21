<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Galeri extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'foto',
        'kategori',
    ];

    /**
     * Atribut tambahan yang otomatis disertakan dalam serialization.
     */
    protected $appends = [
        'foto_url',
    ];

    /**
     * Accessor untuk URL foto galeri yang aman dan konsisten.
     * Mengembalikan URL aset publik yang valid dengan fallback placeholder jika file tidak ditemukan.
     */
    public function getFotoUrlAttribute(): string
    {
        return static::resolveFotoUrl($this->foto);
    }

    /**
     * Helper static untuk menyelesaikan URL foto dengan berbagai format path dan fallback aman.
     */
    public static function resolveFotoUrl(?string $fotoPath): string
    {
        $defaultFallback = asset('images/default-galeri.svg');

        if (empty($fotoPath)) {
            return $defaultFallback;
        }

        $trimmed = trim($fotoPath);

        // 1. Jika sudah berupa URL eksternal (http:// atau https://)
        if (str_starts_with($trimmed, 'http://') || str_starts_with($trimmed, 'https://')) {
            return $trimmed;
        }

        // Hilangkan slash di awal path
        $clean = ltrim($trimmed, '/\\');

        // 2. Jika path diawali 'storage/'
        if (str_starts_with($clean, 'storage/')) {
            $sub = substr($clean, 8); // hapus prefix 'storage/'
            if (file_exists(public_path('storage/' . $sub)) || Storage::disk('public')->exists($sub)) {
                return asset('storage/' . $sub);
            }
            if (file_exists(public_path($clean))) {
                return asset($clean);
            }
        }

        // 3. Jika path diawali 'uploads/' (format lama)
        if (str_starts_with($clean, 'uploads/')) {
            if (file_exists(public_path($clean))) {
                return asset($clean);
            }
            // Cek jika sudah disinkronkan ke storage/uploads/...
            if (file_exists(public_path('storage/' . $clean))) {
                return asset('storage/' . $clean);
            }
            // Cek jika dipindahkan ke storage/galeri/...
            $filename = basename($clean);
            if (file_exists(public_path('storage/galeri/' . $filename))) {
                return asset('storage/galeri/' . $filename);
            }
        }

        // 4. Path standar Laravel disk public (misal: 'galeri/xyz.jpg')
        if (file_exists(public_path('storage/' . $clean))) {
            return asset('storage/' . $clean);
        }

        if (Storage::disk('public')->exists($clean)) {
            return asset('storage/' . $clean);
        }

        // 5. Cek langsung di root folder public (misal 'galeri/xyz.jpg' jika ada di public/galeri)
        if (file_exists(public_path($clean))) {
            return asset($clean);
        }

        // Fallback default jika file fisik tidak ada
        return $defaultFallback;
    }

    /**
     * Helper untuk mengecek apakah file fisik foto benar-benar ada di storage/public.
     */
    public function hasPhysicalFile(): bool
    {
        if (empty($this->foto)) {
            return false;
        }

        $clean = ltrim(trim($this->foto), '/\\');

        if (str_starts_with($clean, 'http://') || str_starts_with($clean, 'https://')) {
            return true;
        }

        if (str_starts_with($clean, 'storage/')) {
            $sub = substr($clean, 8);
            return file_exists(public_path('storage/' . $sub)) || Storage::disk('public')->exists($sub);
        }

        if (str_starts_with($clean, 'uploads/')) {
            return file_exists(public_path($clean)) || file_exists(public_path('storage/' . $clean));
        }

        return file_exists(public_path('storage/' . $clean)) || Storage::disk('public')->exists($clean) || file_exists(public_path($clean));
    }
}
