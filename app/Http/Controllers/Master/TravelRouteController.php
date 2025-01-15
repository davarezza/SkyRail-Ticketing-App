<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Services\Master\TransportationService;
use App\Services\Master\TravelRouteService;
use Illuminate\Http\Request;

class TravelRouteController extends Controller
{
    protected $service;
    protected $serviceTransport;
    
    public function __construct()
    {
        $this->service = new TravelRouteService();
        $this->serviceTransport = new TransportationService();
    }

    public function index()
    {
        return view('master.travel-route.index');
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
        $opr['transport'] = $this->serviceTransport->getData($request);

        return $opr;
    }
}
