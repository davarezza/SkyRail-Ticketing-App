<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $table = "permissions";

    protected $primaryKey = 'id';

    protected $fillable = [
        'role_id',
        'model_id',
        'model_type'
    ];

    public function role()
    {
        return $this->belongsToMany(Role::class, 'role_has_permissions', 'permission_id', 'role_id')
            ->using(RoleHasPermission::class);
    }

    public function permission()
    {
        return $this->belongsToMany(Permission::class, 'role_has_permissions', 'role_id', 'permission_id')
            ->using(RoleHasPermission::class);
    }
}
