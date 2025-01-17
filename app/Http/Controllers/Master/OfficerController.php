<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Services\Master\OfficerService;
use Illuminate\Http\Request;

class OfficerController extends Controller
{
    protected $service; 

    public function __construct()
    {
        $this->service = new OfficerService();
    }
}
