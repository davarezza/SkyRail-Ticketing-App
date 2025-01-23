<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoleHasPermission extends Pivot
{
    use HasFactory;

    protected $table = "role_has_permissions";

    protected $fillable = [
        'role_id',
        'permission_id'
    ];

    public function permission()
    {
        return $this->belongsTo(Permission::class, 'permission_id', 'id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }
}