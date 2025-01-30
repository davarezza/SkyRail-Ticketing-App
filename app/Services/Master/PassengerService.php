<?php

namespace App\Services\Master;

use App\Core\BaseResponse;
use App\Models\Penumpang;
use App\Models\User;
use App\Models\ViewModels\PassengerView;
use App\Repositories\Master\PassengerRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PassengerService
{
    protected $repository;
    protected $modelView;
    protected $user, $passenger;

    public function __construct()
    {
        $this->repository = new PassengerRepository();
        $this->modelView = new PassengerView();
        $this->user = new User();
        $this->passenger = new Penumpang();
    }

    public function table($request)
    {
        $opr = $this->repository->table($request);

        return BaseResponse::json($opr);
    }       

    public function detail($id) {
        $data = [];
        $data['detail'] = $this->modelView->find($id);

        return $data;
    }

    public function delete($request)
    {
        DB::beginTransaction();
        try {
            $dataPassenger = $this->passenger->find($request->id);
            if ($dataPassenger) {
                $this->repository->deleteUser($dataPassenger->user_id);
            }

            $this->repository->removeRole($dataPassenger->user_id);
            $opr = $this->repository->delete($request->id);
    
            DB::commit();
            return BaseResponse::deleted($opr);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }   
}