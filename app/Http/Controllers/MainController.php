<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function home()
    {
        $destination = Destination::take(4)->get();

        return view('home', [
            'active' => 'home',
            'destination' => $destination,
        ]);
    }
}
