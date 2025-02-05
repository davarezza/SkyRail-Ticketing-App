<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Master\TransportationService;
use App\Services\Master\TransportClassService;
use App\Services\Master\TransportTypeService;

class TransportationController extends Controller
{
    protected $service, $serviceTypeTransport, $serviceTransportClass;

    public function __construct()
    {
        $this->service = new TransportationService();
        $this->serviceTypeTransport = new TransportTypeService();
        $this->serviceTransportClass = new TransportClassService();
    }

    public function index()
    {
        return view('master.transportation.index');
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
        $opr['transport_type'] = $this->serviceTypeTransport->getData($request);
        $opr['transport_class'] = $this->serviceTransportClass->getData($request);

        return $opr;
    }
}
