<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Petugas extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_petugas';
    protected $fillable = [
        'username',
        'password',
        'nama_petugas',
        'id_level',
    ];

    public function level()
    {
        return $this->belongsTo(Level::class, 'id_level', 'id_level');
    }

    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class, 'id_petugas', 'id_petugas');
    }
}
