<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Services\Master\PassengerService;
use Illuminate\Http\Request;

class PassengerController extends Controller
{
    protected $service; 
    
    public function __construct()
    {
        $this->service = new PassengerService();
    }

    public function index()
    {
        return view('master.passenger.index');
    }

    public function table(Request $request)
    {
        $opr = $this->service->table($request);

        return $opr;
    }

    public function detail($id)
    {
        $opr = $this->service->detail($id);

        return $opr;
    }

    public function delete(Request $request)
    {
        $opr = $this->service->delete($request);

        return $opr;
    }

    public function getDataLogin(Request $request)
    {
        $opr = $this->service->getDataLogin($request);

        return $opr;
    }

    public function saveDataProfile(Request $request)
    {
        $opr = $this->service->saveDataProfile($request);

        return $opr;
    }
}
