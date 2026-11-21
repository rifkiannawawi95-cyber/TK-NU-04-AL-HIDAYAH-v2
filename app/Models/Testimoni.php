<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
    use HasFactory;

    protected $table = 'testimonis';

    protected $fillable = [
        'nama',
        'peran',
        'rating',
        'pesan',
        'is_approved',
        'approved_at',
    ];

    protected $casts = [
        'is_approved' => 'boolean',
        'rating' => 'integer',
        'approved_at' => 'datetime',
    ];

    public function scopeApproved($query)
    {
        return $query->where('is_approved', true)->orderBy('created_at', 'desc');
    }

    public function scopePending($query)
    {
        return $query->where('is_approved', false)->orderBy('created_at', 'desc');
    }

    public function getInitialsAttribute(): string
    {
        $words = preg_split('/\s+/', trim($this->nama));
        $initials = '';
        if (count($words) >= 2) {
            $initials = mb_substr($words[0], 0, 1) . mb_substr($words[1], 0, 1);
        } elseif (count($words) == 1 && mb_strlen($words[0]) > 0) {
            $initials = mb_substr($words[0], 0, 2);
        } else {
            $initials = 'WS';
        }
        return strtoupper($initials);
    }
}
