<?php

namespace App\Repositories\Management;

use App\Models\Pemesanan;
use App\Models\PemesananPenumpang;
use Prettus\Repository\Eloquent\BaseRepository;

class ManageBookingRepository extends BaseRepository
{
    protected $model, $modelBookingPassenger;

    public function __construct()
    {
        $this->model = new Pemesanan();
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

    public function table($request){
        $opr = $this->model->setView('v_booking');

        return $opr->draw();
    }

    public function fetchAllData($request){
        $opr = $this->model->setView('v_booking');

        return $opr->get();
    }

    public function create($request){
        $opr = $this->model->create($request);

        return $opr;
    }

    public function delete($request){
        $this->modelBookingPassenger->where('id_pemesanan', $request->id)->delete();

        $opr = $this->model->where('id_pemesanan', $request->id)->delete();

        return $opr;
    }

    public function verify($request){
        $opr = $this->model->where('id_pemesanan', $request->id)->update([
            'status' => 'verified',
            'updated_at' => now()->setTimezone('Asia/Jakarta')
        ]);

        return $opr;
    }
}
