<?php

namespace App\Services\Master;

use App\Models\ViewModels\TravelRouteView;
use App\Repositories\Master\TravelRouteRepository;
use App\Core\BaseResponse;
use Illuminate\Support\Facades\DB;

class TravelRouteService
{
    protected $repository;
    protected $modelView;

    public function __construct()
    {
        $this->repository = new TravelRouteRepository();
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
            if (strtotime($request->arrival_time) < strtotime($request->departure_time)) {
                throw new \Exception("Arrival time cannot be earlier than departure time.");
            }
            $cleaned_price = str_replace(['Rp ', '.'], '', $request->price);

            $dataTravel = [
                'tujuan' => $request->objective,
                'rute_awal' => $request->first_route,
                'rute_akhir' => $request->first_route,
                'tanggal_berangkat' => $request->departure_date,
                'jam_berangkat' => $request->departure_time,
                'jam_tiba' => $request->arrival_time,
                'harga' => $cleaned_price,
                'id_transportasi' => $request->id_transportasi,
            ];

            $opr = $this->repository->create($dataTravel);

            DB::commit();
            return BaseResponse::created($opr);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
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
            if (strtotime($request->arrival_time) < strtotime($request->departure_time)) {
                throw new \Exception("Arrival time cannot be earlier than departure time.");
            }

            $cleaned_price = str_replace(['Rp ', '.'], '', $request->price);

            $dataTravel = [
                'tujuan' => $request->objective,
                'rute_awal' => $request->first_route,
                'rute_akhir' => $request->first_route,
                'tanggal_berangkat' => $request->departure_date,
                'jam_berangkat' => $request->departure_time,
                'jam_tiba' => $request->arrival_time,
                'harga' => $cleaned_price,
                'id_transportasi' => $request->id_transportasi,
            ];

            $opr = $this->repository->update($request->id_rute, $dataTravel);

            DB::commit();
            return BaseResponse::updated($opr);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
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