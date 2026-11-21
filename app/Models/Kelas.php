<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $fillable = [
        'nama_kelas',
        'kode_kelas',
        'tingkat', // KB (Kelompok Bermain), TK-A, TK-B
        'wali_kelas_id',
        'ruangan',
        'kapasitas',
        'tahun_ajaran',
    ];

    public function waliKelas()
    {
        return $this->belongsTo(Guru::class, 'wali_kelas_id');
    }

    public function siswas()
    {
        return $this->hasMany(Siswa::class, 'kelas_id');
    }
}

