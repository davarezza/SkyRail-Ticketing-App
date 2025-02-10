<?php

namespace App\Services\Master;
use App\Core\BaseResponse;
use App\Models\ViewModels\TransportationView;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Repositories\Master\TransportationRepository;

class TransportationService
{
    protected $repository;
    protected $modelView;

    public function __construct()
    {
        $this->repository = new TransportationRepository();
        $this->modelView = new TransportationView();
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
            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('assets/img/transport_logo'), $fileName);
            } else {
                $fileName = null;
            }

            $dataTransport = [
                'nama' => $request->name,
                'kode' => $request->kode,
                'id_type_transportasi' => $request->id_type_transportasi,
                'class_id' => $request->class_id,
                'jumlah_kursi' => $request->jumlah_kursi,
                'keterangan' => $request->keterangan,
                'logo' => $fileName,
            ];

            $opr = $this->repository->create($dataTransport);

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
            $transport = $this->repository->findId($request->id_transportasi);
            if (!$transport) {
                dd('Not Found');
            }
    
            if ($request->hasFile('logo')) {
                if ($transport->logo && file_exists(public_path('assets/img/transport_logo/' . $transport->logo))) {
                    unlink(public_path('assets/img/transport_logo/' . $transport->logo));
                }
    
                $file = $request->file('logo');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('assets/img/transport_logo'), $fileName);
            } else {
                $fileName = $transport->logo;
            }

            $dataTransport = [
                'nama' => $request->name,
                'kode' => $request->kode,
                'id_type_transportasi' => $request->id_type_transportasi,
                'class_id' => $request->class_id,
                'jumlah_kursi' => $request->jumlah_kursi,
                'keterangan' => $request->keterangan,
                'logo' => $fileName,
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

    public function getData($request)
    {
        $opr = $this->repository->getData($request);

        return $opr;
    }
}