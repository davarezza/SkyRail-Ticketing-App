<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ModelHasRole extends Pivot
{
    use HasFactory;

    protected $table = "model_has_roles";

    protected $fillable = [
        'role_id',
        'model_id',
        'model_type'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'model_id', 'id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }
}
