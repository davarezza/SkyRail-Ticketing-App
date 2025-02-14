<?php

namespace App\Services;

use App\Repositories\BookingRepository;
use App\Core\BaseResponse;
use App\Models\ViewModels\TravelRouteView;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class BookingService
{
    protected $repository, $modelView;

    public function __construct()
    {
        $this->repository = new BookingRepository();
        $this->modelView = new TravelRouteView();
    }

    public function firstBooking($request) {
        DB::beginTransaction();
        try {
            $departureAirport = strtoupper(implode('', array_map(fn($word) => substr($word, 0, 1), explode(' ', $request->departure_airport))));
            $objectiveAirport = strtoupper(implode('', array_map(fn($word) => substr($word, 0, 1), explode(' ', $request->objective_airport))));
            $departureCity = strtoupper(substr($request->departure_city, 0, 3));
            $objectiveCity = strtoupper(substr($request->objective_city, 0, 3));
            $bookingDateDay = now()->setTimezone('Asia/Jakarta')->format('md');
            $bookingDate = now()->setTimezone('Asia/Jakarta');
            $randomCode = strtoupper(Str::random(3));
            
            $bookingCode = "$departureAirport$objectiveAirport-$departureCity$objectiveCity-$bookingDateDay-$randomCode";
    
            $dataBooking = [
                'id_penumpang' => Auth::id(),
                'tujuan' => $request->objective_city,
                'kode_pemesanan' => $bookingCode,
                'tanggal_pemesanan' => $bookingDate,
                'tempat_pemesanan' => $request->booking_place,
                'id_rute' => $request->id_rute,
                'tanggal_berangkat' => $request->departure_date,
                'total_bayar' => $request->total_price_input,
                'status' => 'draft',
            ];
            dd($dataBooking);
    
            $opr = $this->repository->firstBooking($dataBooking);
    
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

    public function detailFacilities($id) {
        $data = [];
        $data['detail'] = $this->modelView->find($id);

        return $data;
    }
}