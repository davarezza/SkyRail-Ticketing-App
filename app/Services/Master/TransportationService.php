<?php

namespace App\Services\Master;
use App\Core\BaseResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Repositories\Master\TransportationRepository;

class TransportationService
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new TransportationRepository();
    }

    public function table($request)
    {
        $opr = $this->repository->table($request);

        return BaseResponse::json($opr);
    }
}