<?php

namespace App\Services\Management;

use App\Repositories\Management\RoleRepository;
use App\Core\BaseResponse;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;

class RoleService
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new RoleRepository();
    }

    public function getRoles(): JsonResponse
    {
        $roles = $this->repository->getRoles();

        return BaseResponse::json($roles);
    }

    public function getPermissionById(string $id): JsonResponse
    {
        $role = $this->repository->fetchById($id);

        $formattedPermissions = $this->repository->convertPermission($role);

        return BaseResponse::json($formattedPermissions);
    }

    public function getRoleById(string $id) : array {
        return (array) $this->repository->getById($id);
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $existingRole = $this->repository->findByName($request->name);
            if ($existingRole) {
                throw new \Exception("Role with the name '{$request->name}' already exists.");
            }
    
            $dataRole = [
                'name' => $request->name,
                'guard_name' => 'web',
            ];
    
            $createRole = $this->repository->create($dataRole);
    
            DB::commit();
            return BaseResponse::created($createRole);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }
    
    public function edit($request)
    {
        $opr = $this->repository->edit($request);

        return BaseResponse::json($opr);
    }

    public function update($request)
    {
        DB::beginTransaction();
        try {
            $existingRole = $this->repository->findByName($request->name);
            if ($existingRole && $existingRole->id !== $request->id) {
                throw new \Exception("Role with the name '{$request->name}' already exists.");
            }

            $dataRole = [
                'name' => $request->name,
                'guard_name' => 'web',
            ];

            $opr = $this->repository->update($dataRole, $request->id);

            DB::commit();
            return BaseResponse::updated($opr);
        } catch (\Exception $e) {
            DB::rollBack();
            return BaseResponse::errorTransaction($e);
        }
    }

    public function savePermission(Role $role, $permissions): void
    {
        $this->repository->savePermission($role, $permissions);
    }

    public function deleteRole($request)
    {
        DB::beginTransaction();

        try {
            $opr = $this->repository->delete($request->id);

            DB::commit();
            return BaseResponse::deleted($opr);
        } catch (\Exception $e) {
            DB::rollBack();

            return BaseResponse::errorTransaction($e);
        }
    }
}