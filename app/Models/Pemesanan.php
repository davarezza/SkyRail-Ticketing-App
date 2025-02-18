<?php

namespace App\Models;

use App\Core\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pemesanan extends BaseModel
{
    use HasFactory;

    protected $primaryKey = 'id_pemesanan';
    protected $fillable = [
        'kode_pemesanan',
        'tanggal_pemesanan',
        'tempat_pemesanan',
        'id_penumpang',
        'id_rute',
        'tujuan',
        'tanggal_berangkat',
        'jam_check_in',
        'total_bayar',
        'id_petugas',
        'status',
    ];

    public function penumpang()
    {
        return $this->belongsTo(Penumpang::class, 'id_penumpang', 'id_penumpang');
    }

    public function rute()
    {
        return $this->belongsTo(Rute::class, 'id_rute', 'id_rute');
    }

    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'id_petugas', 'id_petugas');
    }

    public function pemesananPenumpangs()
    {
        return $this->hasMany(PemesananPenumpang::class, 'id_pemesanan', 'id_pemesanan');
    }
}
