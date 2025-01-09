<?php

namespace App\Services\Master;

use App\Repositories\Master\TransportTypeRepository;

class TransportTypeService
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new TransportTypeRepository();
    }

    public function getData($request)
    {
        $opr = $this->repository->getData($request);

        return $opr;
    }
}