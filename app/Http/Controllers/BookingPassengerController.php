<?php

namespace App\Http\Controllers;

use App\Models\ViewModels\BookingPassengerView;
use App\Models\ViewModels\BookingView;
use App\Models\ViewModels\TravelRouteView;
use Illuminate\Http\Request;

class BookingPassengerController extends Controller
{
    public function detail($id)
    {
        $booking = BookingView::find($id);
        $route = TravelRouteView::find($booking->route_id);

        $booking_passenger = BookingPassengerView::where('booking_id', $booking->id)->get();
    
        return view('pages.booking-passenger', [
            'route' => $route,
            'booking' => $booking,
            'booking_passenger' => $booking_passenger
        ]);
    }

    public function bookingSeat($id)
    {
        $booking = BookingView::find($id);
        $booking_passenger = BookingPassengerView::where('booking_id', $booking->id)->get();

        return view('pages.booking-seat', [
            'booking_passenger' => $booking_passenger
        ]);
    }
}
