<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AspekPerkembangan extends Model
{
    use HasFactory;

    protected $table = 'aspek_perkembangans';

    protected $fillable = [
        'kode_aspek',
        'nama_aspek',
        'keterangan_indikator',
        'kurikulum',
    ];

    public function penilaianHarians()
    {
        return $this->hasMany(PenilaianHarian::class, 'aspek_id');
    }
}

