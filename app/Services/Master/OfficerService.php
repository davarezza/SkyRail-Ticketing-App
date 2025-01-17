<?php

namespace App\Services\Master;

use App\Models\ViewModels\OfficerView;
use App\Repositories\Master\OfficerRepository;

class OfficerService
{
    protected $repository;
    protected $modelView;

    public function __construct()
    {
        $this->repository = new OfficerRepository();
        $this->modelView = new OfficerView();
    }
}