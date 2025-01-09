<?php

namespace App\Repositories\Master;

use App\Models\TypeTransportasi;
use Prettus\Repository\Eloquent\BaseRepository;

class TransportTypeRepository extends BaseRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new TypeTransportasi();
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

    public function getData($request){
        $opr = $this->model->get();

        return $opr;
    }
}