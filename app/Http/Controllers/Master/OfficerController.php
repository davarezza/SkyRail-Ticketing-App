<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Services\Management\RoleService;
use App\Services\Master\OfficerService;
use Illuminate\Http\Request;

class OfficerController extends Controller
{
    protected $service, $serviceRole; 
    
    public function __construct()
    {
        $this->service = new OfficerService();
        $this->serviceRole = new RoleService();
    }

    public function index()
    {
        return view('master.officer.index');
    }

    public function table(Request $request)
    {
        $opr = $this->service->table($request);

        return $opr;
    }

    public function store(Request $request)
    {
        $opr = $this->service->store($request);

        return $opr;
    }

    public function detail($id)
    {
        $opr = $this->service->detail($id);

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
        $opr = $this->service->delete($request);

        return $opr;
    }

    public function getDataSelect(Request $request)
    {
        $opr = [];
        $opr['role'] = $this->serviceRole->getData($request);

        return $opr;
    }
}
