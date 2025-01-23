<?php

namespace App\Models;

use App\Traits\DrawTable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use DrawTable, HasFactory;

    protected $table = "roles";

    protected $fillable = [
        'name',
        'guard_name'
    ];

    protected $primaryKey = 'id';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function useView()
    {
        $this->setView('v_role');
        return $this;
    }

    public function user()
    {
        return $this->belongsToMany(User::class, 'model_has_roles', 'role_id', 'model_id')
            ->using(ModelHasRole::class);
    }

    public function permission()
    {
        return $this->belongsToMany(Permission::class, 'role_has_permissions', 'role_id', 'permission_id')
            ->using(RoleHasPermission::class);
    }
}