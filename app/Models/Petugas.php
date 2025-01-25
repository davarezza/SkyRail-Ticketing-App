<?php

namespace App\Models;

use App\Core\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Petugas extends BaseModel
{
    use HasFactory;

    protected $primaryKey = 'id_petugas';
    protected $fillable = [
        'username',
        'password',
        'nama_petugas',
        'email',
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

    public function useView()
    {
        $this->setView('v_officer');
        return $this;
    }
}
