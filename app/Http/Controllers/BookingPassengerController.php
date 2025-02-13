<?php

namespace App\Http\Controllers;

use App\Models\ViewModels\TravelRouteView;
use Illuminate\Http\Request;

class BookingPassengerController extends Controller
{
    public function detail($id)
    {
        $booking = TravelRouteView::find($id);
    
        return view('pages.booking-passenger', [
            'booking' => $booking,
        ]);
    }
}
