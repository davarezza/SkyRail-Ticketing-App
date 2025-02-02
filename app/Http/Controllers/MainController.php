<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function home()
    {
        // $image = null;
    
        // if (Auth::check()) {
        //     $user = Auth::user();
        //     $image = $user->image;
        // }
    
        // return view('home', [
        //     'image' => $image,
        // ]);
        $destination = Destination::take(4)->get();

        return view('home', [
            'active' => 'home',
            'destination' => $destination,
        ]);
    }
}
