<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KehadiranGuru extends Model
{
    use HasFactory;

    protected $fillable = [
        'guru_id', 'tanggal', 'status', 'keterangan'
    ];

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
}
