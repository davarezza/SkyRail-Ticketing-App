<?php

namespace App\Services\Master;

use App\Models\ViewModels\TravelRouteView;
use App\Core\BaseResponse;
use App\Repositories\Master\DestinationRepository;
use Illuminate\Support\Facades\DB;

class DestinationService
{
    protected $repository;
    protected $modelView;

    public function __construct()
    {
        $this->repository = new DestinationRepository();
        $this->modelView = new TravelRouteView();
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
            $dataDestination = [
                'tujuan' => $request->objective,
                'rute_awal' => $request->first_route,
                'rute_akhir' => $request->first_route,
                'harga' => $request->price,
                'id_transportasi' => $request->id_transportasi,
            ];

            $opr = $this->repository->create($dataDestination);

            DB::commit();
            return BaseResponse::created($opr);
        } catch (\Exception $e) {
            DB::rollBack();
            return BaseResponse::errorTransaction($e);
        }
    }

    public function detail($id) {
        $data = [];
        $data['detail'] = $this->modelView->find($id);

        return $data;
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
            $dataDestination = [
                'tujuan' => $request->objective,
                'rute_awal' => $request->first_route,
                'rute_akhir' => $request->first_route,
                'harga' => $request->price,
                'id_transportasi' => $request->id_transportasi,
            ];

            $opr = $this->repository->update($request->id_rute, $dataDestination);

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