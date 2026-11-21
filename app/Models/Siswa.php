<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 'nis', 'jenis_kelamin', 'kelas', 'kelas_id', 'nama_ortu', 'no_hp_ortu', 'alamat', 'is_active'
    ];

    public function kehadiran()
    {
        return $this->hasMany(KehadiranSiswa::class);
    }

    public function rombel()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function tagihans()
    {
        return $this->hasMany(TagihanSiswa::class);
    }

    public function penilaianHarians()
    {
        return $this->hasMany(PenilaianHarian::class);
    }
}
