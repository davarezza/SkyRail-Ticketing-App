<?php

namespace App\Repositories\Master;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Models\Petugas;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class OfficerRepository extends BaseRepository
{
    protected $model, $userModel;

    public function __construct()
    {
        $this->model = new Petugas();
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
        $opr = $this->model->setView('v_officer');

        return $opr->draw();
    }

    public function create($request){
        $opr = $this->model->create($request);

        return $opr;
    }

    public function edit($request){
        $opr = $this->model->find($request->id);

        return $opr;
    }

    public function update($id, $data){
        $opr = $this->model->find($id)->update($data);

        return $opr;
    }

    public function delete($request){
        $opr = $this->model->where('id_petugas', $request)->delete();

        return $opr;
    }

    public function deleteUser($request){
        $opr = $this->userModel->where('id', $request)->delete();

        return $opr;
    }

    public function syncRole(array $data)
    {
        $user = User::find($data['id']);
        $roles = $data['role'];
        $user->roles()->sync($roles);
    }

    public function removeRole(string $id)
    {
        return DB::table('model_has_roles')->where('model_id', $id)->delete();
    }
}