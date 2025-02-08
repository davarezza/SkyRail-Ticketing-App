<?php

namespace App\Repositories\Master;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Models\Penumpang;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PassengerRepository extends BaseRepository
{
    protected $model, $userModel;

    public function __construct()
    {
        $this->model = new Penumpang();
        $this->userModel = new User();
    }

    /**
     * Specify the model class name.
     *
     * @return string
     */
    public function model()
    {
        return $this->model;
    }

    public function table($request){
        $opr = $this->model->setView('v_penumpang');

        return $opr->draw();
    }

    public function delete($request){
        $opr = $this->model->where('id_penumpang', $request)->delete();

        return $opr;
    }

    public function deleteUser($request){
        $opr = $this->userModel->where('id', $request)->delete();

        return $opr;
    }

    public function removeRole($id)
    {
        return DB::table('model_has_roles')->where('model_id', $id)->delete();
    }

    public function getDataLogin($request){
        $dataUser = Auth::user();
        $opr = $this->model->setView('v_penumpang')->where('user_id', $dataUser->id)->first();

        return $opr;
    }
}