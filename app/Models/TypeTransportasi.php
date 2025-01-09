<?php

namespace App\Models;

use App\Core\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TypeTransportasi extends BaseModel
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
