<?php

namespace App\Models;

use App\Core\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PemesananPenumpang extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'id_pemesanan',
        'nama',
        'tipe',
        'tanggal_lahir',
        'harga',
    ];

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'id_pemesanan', 'id_pemesanan');
    }
}
