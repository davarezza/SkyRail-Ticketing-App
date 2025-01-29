<?php

namespace App\Models;

use App\Core\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penumpang extends BaseModel
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
        'user_id',
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

    public function useView()
    {
        $this->setView('v_penumpang');
        return $this;
    }
}
