<?php

namespace App\Services\Master;

use App\Core\BaseResponse;
use App\Repositories\Master\TransportClassRepository;
use Illuminate\Support\Facades\DB;

class TransportClassService
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new TransportClassRepository();
    }
}