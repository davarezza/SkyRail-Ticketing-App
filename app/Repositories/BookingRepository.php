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

    public function secondBooking($passengerData){
        foreach ($passengerData as $passenger) {
            $this->modelBookingPassenger
                ->where('id', $passenger['booking_passenger_id'])
                ->update([
                    'nama' => $passenger['name'],
                    'tanggal_lahir' => $passenger['birth_date'] ?? null,
                    'updated_at' => now()->setTimezone('Asia/Jakarta')
                ]);
        }

        return true;
    }

    public function thirdBooking($passengerData, $routeId, $transportId) {
        foreach ($passengerData as $passenger) {
            $this->modelBookingPassenger
                ->where('id', $passenger['booking_passenger_id'])
                ->update([
                    'kode_kursi' => $passenger['booking_passenger_seat_code'],
                    'id_rute' => $routeId,
                    'id_transportasi' => $transportId,
                    'updated_at' => now()->setTimezone('Asia/Jakarta')
                ]);
        }

        return true;
    }

    public function updateBookingStatus($bookingId, $status) {
        $this->model->where('id_pemesanan', $bookingId)->update([
            'status' => $status,
            'updated_at' => now()
        ]);
    }

    public function firstBookingPassenger($passengerData){
        return $this->modelBookingPassenger->insert($passengerData);
    }

    public function detailFacilities($request){
        $opr = $this->modelTravelRoute->find($request->id);

        return $opr;
    }
}
