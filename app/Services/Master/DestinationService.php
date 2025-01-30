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
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('assets/img/destination'), $fileName);
            } else {
                $fileName = null;
            }

            $dataDestination = [
                'name' => $request->name,
                'location' => $request->location,
                'link' => $request->link,
                'popularity' => $request->popularity,
                'image' => $fileName,
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
            $destination = $this->repository->find($request->id);
            if (!$destination) {
                dd('Not Found');
            }
    
            if ($request->hasFile('image')) {
                if ($destination->image && file_exists(public_path('assets/img/destination/' . $destination->image))) {
                    unlink(public_path('assets/img/destination/' . $destination->image));
                }
    
                $file = $request->file('image');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('assets/img/destination'), $fileName);
            } else {
                $fileName = $destination->image;
            }
    
            $dataDestination = [
                'name' => $request->name,
                'location' => $request->location,
                'link' => $request->link,
                'popularity' => $request->popularity,
                'image' => $fileName,
            ];
    
            $opr = $this->repository->update($request->id, $dataDestination);
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
            $destination = $this->repository->findId($request->id);
    
            if ($destination->image && file_exists(public_path('assets/img/destination/' . $destination->image))) {
                unlink(public_path('assets/img/destination/' . $destination->image));
            }
    
            $opr = $this->repository->delete($request->id);
            DB::commit();
            return BaseResponse::deleted($opr);
        } catch (\Exception $e) {
            DB::rollBack();
            return BaseResponse::errorTransaction($e);
        }
    }    
}