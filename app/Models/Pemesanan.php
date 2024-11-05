<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pemesanan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_pemesanan';
    protected $fillable = [
        'kode_pemesanan',
        'tanggal_pemesanan',
        'tempat_pemesanan',
        'id_penumpang',
        'kode_kursi',
        'id_rute',
        'tujuan',
        'tanggal_berangkat',
        'jam_check_in',
        'jam_berangkat',
        'total_bayar',
        'id_petugas',
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
}
