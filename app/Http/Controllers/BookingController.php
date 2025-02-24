<?php

namespace App\Http\Controllers;

use App\Models\ViewModels\BookingPassengerView;
use App\Models\ViewModels\BookingView;
use App\Models\ViewModels\TransportationView;
use App\Models\ViewModels\TravelRouteView;
use App\Services\BookingService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    protected $service;

    public function __construct()
    {
        $this->service = new BookingService();
    }
    public function index(Request $request)
    {
        $cities = TravelRouteView::select('departure_city')
                    ->union(TravelRouteView::select('objective_city'))
                    ->distinct()
                    ->pluck('departure_city');

        $query = TravelRouteView::query();

        if ($request->has(['from', 'to', 'departure_date', 'flight_class'])) {
            $query->where('departure_city', $request->from)
                  ->where('objective_city', $request->to)
                  ->where('departure_date', $request->departure_date)
                  ->where('class_name', $request->flight_class);
        }

        $booking = $query->get();

        return view('pages.booking', [
            'booking' => $booking,
            'from' => $request->from,
            'to' => $request->to,
            'departure_date' => $request->departure_date,
            'flight_class' => $request->flight_class,
            'cities' => $cities
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

    public function checkTicket($id)
    {
        $booking = BookingView::find($id);
        $route = TravelRouteView::find($booking->route_id);
        $transport = TransportationView::find($route->id_transportasi);

        $booking_passenger = BookingPassengerView::where('booking_id', $booking->id)->get();

        return view('pages.booking-ticket', [
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
