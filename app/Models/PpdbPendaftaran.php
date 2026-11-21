<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PpdbPendaftaran extends Model
{
    use HasFactory;

    protected $table = 'ppdb_pendaftarans';

    protected $fillable = [
        'no_registrasi',
        'tahun_ajaran',
        'nama_lengkap',
        'nama_panggilan',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin', // L, P
        'nama_ayah',
        'nama_ibu',
        'pekerjaan_orangtua',
        'no_whatsapp',
        'alamat',
        'jalur_pendaftaran', // Reguler, Beasiswa Yatim, Afiliasi Warga NU
        'status_seleksi', // Menunggu Verifikasi, Diterima, Cadangan, Ditolak
        'catatan_panitia',
    ];
}

