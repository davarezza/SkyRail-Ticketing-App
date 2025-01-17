<?php

namespace App\Repositories\Master;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Models\Petugas;

class OfficerRepository extends BaseRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new Petugas();
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