<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Guru extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 'nip', 'jabatan', 'no_hp', 'is_active', 'foto'
    ];

    protected $appends = [
        'foto_url',
    ];

    public function kehadiran()
    {
        return $this->hasMany(KehadiranGuru::class);
    }

    public function rombels()
    {
        return $this->hasMany(Kelas::class, 'wali_kelas_id');
    }

    public function penilaianHarians()
    {
        return $this->hasMany(PenilaianHarian::class);
    }

    /**
     * Accessor URL foto guru dengan fallback aman
     */
    public function getFotoUrlAttribute(): string
    {
        if (empty($this->foto)) {
            return asset('images/default-avatar.svg');
        }

        $clean = ltrim(trim($this->foto), '/\\');

        if (str_starts_with($clean, 'http://') || str_starts_with($clean, 'https://')) {
            return $clean;
        }

        if (str_starts_with($clean, 'storage/')) {
            $sub = substr($clean, 8);
            if (file_exists(public_path('storage/' . $sub)) || Storage::disk('public')->exists($sub)) {
                return asset('storage/' . $sub);
            }
        }

        if (file_exists(public_path('storage/' . $clean)) || Storage::disk('public')->exists($clean)) {
            return asset('storage/' . $clean);
        }

        if (file_exists(public_path($clean))) {
            return asset($clean);
        }

        return asset('images/default-avatar.svg');
    }
}
