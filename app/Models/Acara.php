<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Acara extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 'tanggal', 'deskripsi', 'foto', 'kategori', 'lokasi', 'waktu'
    ];

    protected $appends = [
        'foto_url',
    ];

    /**
     * Accessor untuk URL foto acara dengan validasi keberadaan file & fallback aman.
     */
    public function getFotoUrlAttribute(): string
    {
        return static::resolveFotoUrl($this->foto);
    }

    /**
     * Helper static resolusi URL foto acara
     */
    public static function resolveFotoUrl(?string $fotoPath): string
    {
        $defaultFallback = asset('images/default-acara.svg');

        if (empty($fotoPath)) {
            return $defaultFallback;
        }

        $trimmed = trim($fotoPath);

        // Jika URL eksternal (http/https)
        if (str_starts_with($trimmed, 'http://') || str_starts_with($trimmed, 'https://')) {
            return $trimmed;
        }

        $clean = ltrim($trimmed, '/\\');

        // Jika path diawali 'storage/'
        if (str_starts_with($clean, 'storage/')) {
            $sub = substr($clean, 8);
            if (file_exists(public_path('storage/' . $sub)) || Storage::disk('public')->exists($sub)) {
                return asset('storage/' . $sub);
            }
            if (file_exists(public_path($clean))) {
                return asset($clean);
            }
        }

        // Jika path diawali 'uploads/'
        if (str_starts_with($clean, 'uploads/')) {
            if (file_exists(public_path($clean))) {
                return asset($clean);
            }
            if (file_exists(public_path('storage/' . $clean))) {
                return asset('storage/' . $clean);
            }
            $filename = basename($clean);
            if (file_exists(public_path('storage/acara/' . $filename))) {
                return asset('storage/acara/' . $filename);
            }
        }

        // Path standar disk public ('acara/xxx.jpg')
        if (file_exists(public_path('storage/' . $clean))) {
            return asset('storage/' . $clean);
        }

        if (Storage::disk('public')->exists($clean)) {
            return asset('storage/' . $clean);
        }

        if (file_exists(public_path($clean))) {
            return asset($clean);
        }

        return $defaultFallback;
    }
}
