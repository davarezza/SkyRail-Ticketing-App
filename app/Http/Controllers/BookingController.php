<?php

namespace App\Http\Controllers;

use App\Models\ViewModels\TravelRouteView;
use App\Services\BookingService;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    protected $service;
    
    public function __construct()
    {
        $this->service = new BookingService();
    }
    public function index()
    {
        $booking = TravelRouteView::all();

        return view('pages.booking', [
            'booking' => $booking,
        ]);
    }

    public function detail($id)
    {
        $booking = TravelRouteView::find($id);
    
        return view('pages.booking-detail', [
            'booking' => $booking,
        ]);
    }
    
    public function detailFacilities($id)
    {
        $opr = $this->service->detailFacilities($id);

        return $opr;
    }
}
