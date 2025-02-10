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
}
