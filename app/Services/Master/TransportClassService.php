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

    public function table($request)
    {
        $opr = $this->repository->table($request);

        return BaseResponse::json($opr);
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $dataTransClass = [
                'name' => $request->name,
                'facilities' => $request->facilities,
            ];

            $opr = $this->repository->create($dataTransClass);

            DB::commit();
            return BaseResponse::created($opr);
        } catch (\Exception $e) {
            DB::rollBack();
            return BaseResponse::errorTransaction($e);
        }
    }

    public function edit($request)
    {
        $opr = $this->repository->edit($request);

        return BaseResponse::json($opr);
    }

    public function update($request)
    {
        DB::beginTransaction();
        try {
            $dataTransClass = [
                'name' => $request->name,
                'facilities' => $request->facilities,
            ];

            $opr = $this->repository->update($request->id, $dataTransClass);

            DB::commit();
            return BaseResponse::updated($opr);
        } catch (\Exception $e) {
            DB::rollBack();
            return BaseResponse::errorTransaction($e);
        }
    }

    public function delete($request)
    {
        DB::beginTransaction();
        try {
            $opr = $this->repository->delete($request->id);

            DB::commit();
            return BaseResponse::deleted($opr);
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return BaseResponse::errorTransaction($e);
        }
    }
}