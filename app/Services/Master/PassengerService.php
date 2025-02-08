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
    
    public function getDataLogin($request)
    {
        $opr = $this->repository->getDataLogin($request);

        return $opr;
    }

    public function saveDataProfile($request)
    {
        DB::beginTransaction();
        try {
            if ($request->hasFile('image')) {

                $file = $request->file('image');
                $newFileName = 'avatar_' . $file->getClientOriginalExtension();
                $uploadPath = public_path('assets/img/user');

                $oldFileName = $uploadPath . '/' . $newFileName;
                if (file_exists($oldFileName)) {
                    unlink($oldFileName);
                }
        
                $moved = $file->move($uploadPath, $newFileName);
        
                if ($moved) {
                    $this->user->where('id', $request->id)->update(['image' => $newFileName]);

                } else {
                    return BaseResponse::errorMessage('Failed to upload new image.');
                }
            }
            $dataUser = [
                'username' => $request->username,
            ];

            if ($request->password !== null && $request->cpassword !== null) {
                $dataUser['password'] = bcrypt($request->password);
                $dataUser['plain_password'] = null;
            }

            $opr = $this->user->where('id', $request->id)->update($dataUser);

            $dataPassenger = [
                'full_name' => $request->full_name,
            ];

            $employeeId = $this->passenger->where('user_id', $request->id)->first()->id;
            
            $opr = $this->passenger->where('id', $employeeId)->update($dataPassenger);

    
            DB::commit();
            return BaseResponse::updated($opr);
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return BaseResponse::errorTransaction($e);
        }
    }
}