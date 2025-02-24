<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\ViewModels\TravelRouteView;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function home()
    {
        $destination = Destination::take(4)->get();

        $cities = TravelRouteView::select('departure_city')
                    ->union(TravelRouteView::select('objective_city'))
                    ->distinct()
                    ->pluck('departure_city');

        $flightClasses = TravelRouteView::select('class_name')->distinct()->pluck('class_name');

        return view('home', [
            'active' => 'home',
            'destination' => $destination,
            'cities' => $cities,
            'flightClasses' => $flightClasses,
        ]);
    }

    public function searchTravel(Request $request)
    {
        $request->validate([
            'from' => 'required|string',
            'to' => 'required|string',
            'departure_date' => 'required|date',
            'flight_class' => 'required|string'
        ]);

        $cities = TravelRouteView::select('departure_city')
                    ->union(TravelRouteView::select('objective_city'))
                    ->distinct()
                    ->pluck('departure_city');

        $booking = TravelRouteView::where('departure_city', $request->from)
                    ->where('objective_city', $request->to)
                    ->where('departure_date', $request->departure_date)
                    ->where('class_name', $request->flight_class)
                    ->get();

        return view('pages.booking', [
            'booking' => $booking,
            'from' => $request->from,
            'to' => $request->to,
            'departure_date' => $request->departure_date,
            'flight_class' => $request->flight_class,
            'cities' => $cities,
        ]);
    }

    public function about()
    {
        return view('about', [
            'active' => 'about',
        ]);
    }
}
