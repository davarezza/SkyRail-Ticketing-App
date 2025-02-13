<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Services\Management\ManageBookingService;
use Illuminate\Http\Request;

class ManageBookingController extends Controller
{
    protected $service;

    public function __construct()
    {
        $this->service = new ManageBookingService();
    }

    public function index()
    {
        return view('management.manage-booking.index');
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
}
