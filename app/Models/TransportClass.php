<?php

namespace App\Models;

use App\Core\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransportClass extends BaseModel
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'facilities',
    ];

    public function transportasis()
    {
        return $this->hasMany(Transportasi::class, 'class_id', 'id');
    }
}