<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Services\Management\RoleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class RoleController extends Controller
{
    protected $service;

    public function __construct(RoleService $service)
    {
        $this->service = $service;
    }

    public function index(): View
    {
        return view('management.role.index');
    }

    public function table()
    {
        $roles = $this->service->getRoles();

        return $roles;
    }

    public function store(Request $request)
    {
        $opr = $this->service->store($request);

        return $opr;
    }

    public function edit(Request $request)
    {
        $opr = $this->service->edit($request);

        return $opr;
    }

    public function update(Request $request)
    {
        $opr = $this->service->update($request);

        return $opr;
    }

    public function delete(Request $request)
    {
        $opr = $this->service->deleteRole($request);
    
        return $opr;
    }

    public function storePermission(Request $request, Role $role)
    {
        $this->service->savePermission($role, $request->selectedTexts);
        return response()->json([
            'success' => true,
            'message' => 'Success save permission'
        ]);
    }

    public function getPermission($id)
    {
        $persmissions = $this->service->getPermissionById($id);

        return $persmissions;
    }
}
