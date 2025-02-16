<?php

namespace App\Http\Controllers;

use App\Models\Penumpang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardUserController extends Controller
{
    protected $passengerModel;

    public function __construct()
    {
        $this->passengerModel = new Penumpang();
    }

    public function index()
    {
        $user = Auth::user();
        $data = $this->passengerModel->setView('v_penumpang')->where('user_id', $user->id)->first();
        return view('dashboard-user.index', [
            'user' => $data
        ]);
    }
}
