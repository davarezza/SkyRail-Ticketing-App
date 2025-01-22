<?php

namespace App\Models;

use App\Core\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Destination extends BaseModel
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'location',
        'image',
        'link',
        'popularity',
    ];
}
