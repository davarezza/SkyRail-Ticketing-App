<?php

namespace App\Repositories;

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
     * Specify the model class name.
     *
     * @return string
     */
    public function model()
    {
        return get_class($this->model);
    }

    /**
     * Boot up the repository, pushing criteria.
     *
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function boot()
    {
        // Add your boot logic here
    }
}