<?php

namespace App\Repositories\Master;

use App\Models\TransportClass;
use Prettus\Repository\Eloquent\BaseRepository;

class TransportClassRepository extends BaseRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new TransportClass();
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
}