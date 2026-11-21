<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianHarian extends Model
{
    use HasFactory;

    protected $table = 'penilaian_harians';

    protected $fillable = [
        'siswa_id',
        'aspek_id',
        'guru_id',
        'tanggal',
        'skala_penilaian', // BSB (Berkembang Sangat Baik), BSH (Sesuai Harapan), MB (Mulai Berkembang), BB (Belum Berkembang)
        'catatan_anekdot',
        'foto_kegiatan',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function aspek()
    {
        return $this->belongsTo(AspekPerkembangan::class, 'aspek_id');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
}

