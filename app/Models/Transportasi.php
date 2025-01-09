<?php

namespace App\Models;

use App\Core\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transportasi extends BaseModel
{
    use HasFactory;

    protected $primaryKey = 'id_transportasi';
    protected $fillable = [
        'kode',
        'nama',
        'jumlah_kursi',
        'keterangan',
        'id_type_transportasi',
    ];

    public function typeTransportasi()
    {
        return $this->belongsTo(TypeTransportasi::class, 'id_type_transportasi', 'id_type_transportasi');
    }

    public function rutes()
    {
        return $this->hasMany(Rute::class, 'id_transportasi', 'id_transportasi');
    }

    public function useView()
    {
        $this->setView('v_transportasis');
        return $this;
    }
}
