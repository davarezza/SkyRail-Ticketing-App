<?php

namespace App\Services\Management;

use App\Core\BaseResponse;
use App\Repositories\Management\ManageBookingRepository;
use Illuminate\Support\Facades\DB;

class ManageBookingService
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new ManageBookingRepository();
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
            $cleaned_price = str_replace(['IDR ', '.'], '', $request->price);

            $dataTravel = [
                'tujuan' => $request->objective,
                'tujuan_bandara' => $request->objective_airport,
                'rute_awal' => $request->departure_city,
                'rute_awal_bandara' => $request->departure_airport,
                'rute_akhir' => $request->objective,
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
        // $data['detail'] = $this->modelView->find($id);

        return $data;
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

    public function verify($request)
    {
        DB::beginTransaction();
        try {
            $opr = $this->repository->verify($request->id);

            DB::commit();
            return BaseResponse::updated($opr);
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return BaseResponse::errorTransaction($e);
        }
    }
}
