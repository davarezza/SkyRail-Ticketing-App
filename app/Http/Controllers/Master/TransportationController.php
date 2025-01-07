<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Master\TransportationService;

class TransportationController extends Controller
{
    protected $service;

    public function __construct()
    {
        $this->service = new TransportationService();
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
}
