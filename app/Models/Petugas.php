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
        'user_id',
        'role_id',
        'nama_petugas',
        'email',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
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
