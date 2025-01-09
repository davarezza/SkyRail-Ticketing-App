<?php

namespace App\Services\Master;

use App\Repositories\Master\TransportTypeRepository;
use App\Core\BaseResponse;
use Illuminate\Support\Facades\DB;

class TransportTypeService
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new TransportTypeRepository();
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
            $dataTransportType = [
                'nama_type_transportasi' => $request->name,
                'keterangan' => $request->keterangan,
            ];

            $opr = $this->repository->create($dataTransportType);

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
            $dataTransportType = [
                'nama_type_transportasi' => $request->name,
                'keterangan' => $request->keterangan,
            ];

            $opr = $this->repository->update($dataTransportType, $request->id);

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
            return BaseResponse::errorTransaction($e);
        }
    }

    public function getData($request)
    {
        $opr = $this->repository->getData($request);

        return $opr;
    }
}