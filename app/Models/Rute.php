<?php

namespace App\Models;

use App\Core\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rute extends BaseModel
{
    use HasFactory;

    protected $primaryKey = 'id_rute';
    protected $fillable = [
        'tujuan',
        'rute_awal',
        'rute_akhir',
        'harga',
        'id_transportasi',
    ];

    public function transportasi()
    {
        return $this->belongsTo(Transportasi::class, 'id_transportasi', 'id_transportasi');
    }

    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class, 'id_rute', 'id_rute');
    }

    public function useView()
    {
        $this->setView('v_travel_route');
        return $this;
    }
}
