<?php

namespace App\Repositories\Master;

use App\Models\Transportasi;
use Prettus\Repository\Eloquent\BaseRepository;

class TransportationRepository extends BaseRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new Transportasi();
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return $this->model;
    }

    public function findId($id)
    {
        return $this->model->find($id);
    }

    public function table($request){
        $opr = $this->model->setView('v_transportasis');

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
        $opr = $this->model->where('id_transportasi', $request)->delete();

        return $opr;
    }

    public function getData($request){
        $opr = $this->model->get();

        return $opr;
    }
}