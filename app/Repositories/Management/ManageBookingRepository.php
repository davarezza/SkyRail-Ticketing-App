<?php

namespace App\Repositories\Management;

use App\Models\Pemesanan;
use Prettus\Repository\Eloquent\BaseRepository;

class ManageBookingRepository extends BaseRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new Pemesanan();
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

    public function create($request){
        $opr = $this->model->create($request);

        return $opr;
    }

    public function edit($request){
        $opr = $this->model->find($request->id);

        return $opr;
    }

    public function update($id, $data){
        $opr = $this->model->find($id)->update($data);

        return $opr;
    }

    public function delete($request){
        $opr = $this->model->where('id_rute', $request)->delete();

        return $opr;
    }
}