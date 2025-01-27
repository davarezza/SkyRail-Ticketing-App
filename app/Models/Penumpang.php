<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penumpang extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_penumpang';
    protected $fillable = [
        'username',
        'password',
        'nama_penumpang',
        'alamat_penumpang',
        'tanggal_lahir',
        'jenis_kelamin',
        'telephone',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function rutes()
    {
        return $this->hasMany(Rute::class, 'id_penumpang', 'id_penumpang');
    }

    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class, 'id_penumpang', 'id_penumpang');
    }
}
