<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Penumpang;
use App\Models\Transportasi;
use App\Models\ViewModels\BookingPassengerView;
use App\Models\ViewModels\BookingView;
use App\Models\ViewModels\TravelRouteView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingHistoryController extends Controller
{
    protected $passengerModel, $bookingModel, $transportModel;

    public function __construct()
    {
        $this->passengerModel = new Penumpang();
        $this->bookingModel = new Pemesanan();
        $this->transportModel = new Transportasi();
    }

    public function index()
    {
        $user = Auth::user();
        $bookings = $this->passengerModel->setView('v_booking')->where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        $data = $this->passengerModel->setView('v_penumpang')->where('user_id', $user->id)->first();

        foreach ($bookings as $booking) {
            $booking->route = TravelRouteView::where('id', $booking->route_id)->first();

            $passengerCounts = BookingPassengerView::where('booking_id', $booking->id)
                ->selectRaw('type, COUNT(*) as count')
                ->groupBy('type')
                ->pluck('count', 'type')
                ->toArray();

            $booking->passenger_counts = $passengerCounts;

            $transport = $this->passengerModel->setView('v_transportasis')
                ->where('id', $booking->transport_id)
                ->first();

            $booking->transport_class = $transport ? $transport->class_name : 'Unknown';
        }

        return view('pages.booking-history', [
            'bookings' => $bookings,
            'user' => $data,
        ]);
    }
}
