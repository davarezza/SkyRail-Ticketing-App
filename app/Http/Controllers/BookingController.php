<?php

namespace App\Http\Controllers;

use App\Models\ViewModels\BookingPassengerView;
use App\Models\ViewModels\BookingView;
use App\Models\ViewModels\TransportationView;
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

    public function firstBooking(Request $request)
    {
        $opr = $this->service->firstBooking($request);

        return $opr;
    }

    public function secondBooking(Request $request)
    {
        return $this->service->secondBooking($request);
    }

    public function thirdBooking(Request $request)
    {
        return $this->service->thirdBooking($request);
    }

    public function fourthBooking(Request $request)
    {
        return $this->service->fourthBooking($request);
    }

    public function detail($id)
    {
        $booking = TravelRouteView::find($id);

        return view('pages.booking-detail', [
            'booking' => $booking,
        ]);
    }

    public function payment($id)
    {
        $booking = BookingView::find($id);
        $route = TravelRouteView::find($booking->route_id);
        $transport = TransportationView::find($route->id_transportasi);

        $booking_passenger = BookingPassengerView::where('booking_id', $booking->id)->get();

        return view('pages.booking-payment', [
            'route' => $route,
            'booking' => $booking,
            'transport' => $transport,
            'booking_passenger' => $booking_passenger,
        ]);
    }

    public function successPayment($id)
    {
        $booking = BookingView::find($id);
        $route = TravelRouteView::find($booking->route_id);
        $transport = TransportationView::find($route->id_transportasi);

        $booking_passenger = BookingPassengerView::where('booking_id', $booking->id)->get();

        return view('pages.booking-success-payment', [
            'route' => $route,
            'booking' => $booking,
            'transport' => $transport,
            'booking_passenger' => $booking_passenger,
        ]);
    }

    public function detailFacilities($id)
    {
        $opr = $this->service->detailFacilities($id);

        return $opr;
    }
}
