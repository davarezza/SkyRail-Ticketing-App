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

    public function table($request){
        $opr = $this->model->setView('v_transportasis');

        return $opr->draw();
    }
}