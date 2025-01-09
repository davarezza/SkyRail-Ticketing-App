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

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $dataTransport = [
                'nama' => $request->name,
                'kode' => $request->kode,
                'id_type_transportasi' => $request->id_type_transportasi,
                'jumlah_kursi' => $request->jumlah_kursi,
                'keterangan' => $request->keterangan,
            ];

            $opr = $this->repository->create($dataTransport);

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
            $dataTransport = [
                'nama' => $request->name,
                'kode' => $request->kode,
                'id_type_transportasi' => $request->id_type_transportasi,
                'jumlah_kursi' => $request->jumlah_kursi,
                'keterangan' => $request->keterangan,
            ];

            $opr = $this->repository->update($request->id_transportasi, $dataTransport);

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