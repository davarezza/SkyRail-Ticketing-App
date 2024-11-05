<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TypeTransportasi extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_type_transportasi';
    protected $fillable = [
        'nama_type_transportasi',
        'keterangan',
    ];

    public function transportasis()
    {
        return $this->hasMany(Transportasi::class, 'id_type_transportasi', 'id_type_transportasi');
    }
}
