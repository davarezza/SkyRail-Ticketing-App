<?php

namespace App\Http\Controllers;

use App\Models\ViewModels\TravelRouteView;
use Illuminate\Http\Request;

class BookingController extends Controller
{
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
}
