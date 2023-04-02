<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tanggal_presensi',
        'check_in_time',
        'check_out_time',
        'keterangan_masuk',
        'keterangan_pulang',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
