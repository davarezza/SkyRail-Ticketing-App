<?php

namespace App\Services;

use App\Repositories\BookingRepository;
use App\Core\BaseResponse;
use App\Models\ViewModels\TravelRouteView;
use Illuminate\Support\Facades\DB;

class BookingService
{
    protected $repository, $modelView;

    public function __construct()
    {
        $this->repository = new BookingRepository();
        $this->modelView = new TravelRouteView();
    }

    public function detailFacilities($id) {
        $data = [];
        $data['detail'] = $this->modelView->find($id);

        return $data;
    }
}