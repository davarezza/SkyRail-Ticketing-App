<?php

namespace App\Services\Master;

use App\Models\ViewModels\OfficerView;
use App\Repositories\Master\OfficerRepository;
use App\Core\BaseResponse;
use App\Models\Petugas;
use App\Models\User;
use App\Notifications\NewOfficerNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OfficerService
{
    protected $repository;
    protected $modelView;
    protected $user, $officer;

    public function __construct()
    {
        $this->repository = new OfficerRepository();
        $this->modelView = new OfficerView();
        $this->user = new User();
        $this->officer = new Petugas();
    }

    private function generateUsername($fullNameParts)
    {
        $usernameBase = Str::lower(implode('', array_slice($fullNameParts, 0, 2)));
        $username = $usernameBase;

        $isDuplicate = true;
        while ($isDuplicate) {
            if (!$this->user->where('username', $username)->exists()) {
                $isDuplicate = false;
            } else {
                if (count($fullNameParts) > 2) {
                    $username = $usernameBase . Str::lower(substr($fullNameParts[2], 0, 3));
                } else {
                    $username = $usernameBase . rand(10, 99);
                }

                if ($this->user->where('username', $username)->exists()) {
                    if (count($fullNameParts) > 2) {
                        $username = $username . rand(10, 99);
                    } else {
                        $username = $usernameBase . rand(10, 99);
                    }
                }
            }
        }

        return $username;
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
            $fullNameParts = explode(' ', $request->nama_petugas);
            $username = $this->generateUsername($fullNameParts);

            $password = Str::random(8);

            $dataUser = [
                'name' => $request->nama_petugas,
                'username' => $username,
                'email' => $request->email,
                'password' => bcrypt($password),
                'plain_password' => $password,
            ];
            $user = $this->user->create($dataUser);
            $userId = $user->id;

            $dataOfficer = [
                'nama_petugas' => $request->nama_petugas,
                'email' => $request->email,
                'username' => $username,
                'password' => $password,
                'role_id' => $request->role_id,
                'user_id' => $userId,
            ];

            $syncRole = [
                'id' => $userId,
                'role' => $request->role_id,
            ];

            $this->repository->syncRole($syncRole);
            $opr = $this->repository->create($dataOfficer);

            $user->notify(new NewOfficerNotification($request->nama_petugas, $username, $password));

            DB::commit();
            return BaseResponse::created($opr);
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage(), $e->getCode());
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
            $dataOfficer = [
                'nama_petugas' => $request->nama_petugas,
                'email' => $request->email,
                'role_id' => $request->role_id,
            ];

            $opr = $this->repository->update($request->id_petugas, $dataOfficer);

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
            $dataOfficer = $this->officer->find($request->id);
            if ($dataOfficer) {
                $this->repository->deleteUser($dataOfficer->user_id);
            }

            $this->repository->removeRole($dataOfficer->user_id);
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
