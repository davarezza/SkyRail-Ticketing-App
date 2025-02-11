<?php

namespace App\Repositories;

use App\Models\Booking;
use App\Models\Pemesanan;
use App\Models\Rute;
use Prettus\Repository\Eloquent\BaseRepository;

class BookingRepository extends BaseRepository
{
    protected $model, $modelTravelRoute;

    public function __construct()
    {
        $this->model = new Pemesanan();
        $this->modelTravelRoute = new Rute();
    }

    /**
     * Specify the model class name.
     *
     * @return string
     */
    public function model()
    {
        return $this->model;
    }

    public function detailFacilities($request){
        $opr = $this->modelTravelRoute->find($request->id);

        return $opr;
    }
}