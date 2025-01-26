<?php

namespace App\Repositories\Management;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Models\Role;
use App\Models\ViewModels\RoleView;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class RoleRepository extends BaseRepository
{
    protected $model;

    protected $table = 'roles';

    public function __construct()
    {
        $this->model = new Role;
    }

    public function model()
    {
        return $this->model;
    }

    public function getRoles()
    {
        return $this->model->draw('permissions');
    }

    public function fetchById($id)
    {
        return $this->model->find($id);
    }

    public function getById(string $id)
    {
        return DB::table($this->table)
            ->select('id', 'name')
            ->where('id', $id)
            ->first();
    }

    public function findByName($name)
    {
        return $this->model->where('name', $name)->first();
    }

    public function create($request){
        $opr = $this->model->create($request);

        return $opr;
    }

    public function edit($request){
        $opr = RoleView::find($request->id);

        return $opr;
    }

    public function update($data, $id){
        $opr = $this->model->find($id)->update($data);

        return $opr;
    }

    public function delete($request)
    {
        $role = $this->model->find($request);
    
        if ($role) {
            $role->permissions()->detach();
            $opr = $role->delete();
            return $opr;
        }
    
        return false;
    }

    public function savePermission($role, $permissions)
    {
        return $role->syncPermissions($permissions);
    }

    public function convertPermission($role)
    {
        # define default variable
        $role_guard_name = $role->guard_name;

        # fetch permission
        $permissions = Permission::all()->where('guard_name', 'REGEXP', $role_guard_name)->groupBy('menu_title');

        return $permissions->map(function ($group) use ($role) {
            return [
                'text' => $group->first()->menu_title,
                'children' => $group->groupBy('group')->map(function ($subGroup) use ($role) {
                    return [
                        'text' => $subGroup->first()->group,
                        'children' => $subGroup->map(function ($permission) use ($role) {
                            return [
                                'text' => $permission->name,
                                'state' => [
                                    'selected' => $role->hasPermissionTo($permission->name),
                                ],
                            ];
                        }),
                    ];
                })->values(),
            ];
        })->values()->toArray();
    }

    public function getData($request){
        $opr = $this->model->get();

        return $opr;
    }
}