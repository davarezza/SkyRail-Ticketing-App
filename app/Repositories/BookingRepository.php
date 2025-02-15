<?php

namespace App\Repositories;

use App\Models\Booking;
use App\Models\Pemesanan;
use App\Models\PemesananPenumpang;
use App\Models\Rute;
use Prettus\Repository\Eloquent\BaseRepository;

class BookingRepository extends BaseRepository
{
    protected $model, $modelTravelRoute, $modelBookingPassenger;

    public function __construct()
    {
        $this->model = new Pemesanan();
        $this->modelTravelRoute = new Rute();
        $this->modelBookingPassenger = new PemesananPenumpang();
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

    public function firstBooking($request){
        $opr = $this->model->create($request);

        return $opr;
    }

    public function firstBookingPassenger($passengerData){
        // foreach ($passengerData as $data) {
        //     $this->modelBookingPassenger->create($data);
        // }
        // return true;
        return $this->modelBookingPassenger->insert($passengerData);
    }

    public function detailFacilities($request){
        $opr = $this->modelTravelRoute->find($request->id);

        return $opr;
    }
}