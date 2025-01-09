<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Master\TransportationService;
use App\Services\Master\TransportTypeService;

class TransportationController extends Controller
{
    protected $service; 
    protected $serviceTypeTransport;

    public function __construct()
    {
        $this->service = new TransportationService();
        $this->serviceTypeTransport = new TransportTypeService();
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

    public function getDataSelect(Request $request)
    {
        $opr = [];
        $opr['transport_type'] = $this->serviceTypeTransport->getData($request);

        return $opr;
    }
}
