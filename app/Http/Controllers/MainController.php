<?php

namespace App\Http\Controllers;

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

        return view('home');
    }
}
