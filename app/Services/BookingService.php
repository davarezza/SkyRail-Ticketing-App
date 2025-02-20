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
                'id_penumpang' => Auth::user()->penumpang->id_penumpang ?? null,
                'tujuan' => $request->objective_city,
                'kode_pemesanan' => $bookingCode,
                'tanggal_pemesanan' => $bookingDate,
                'tempat_pemesanan' => $request->booking_place,
                'id_rute' => $request->id_rute,
                'tanggal_berangkat' => $request->departure_date,
                'total_bayar' => $request->total_price_input,
                'status' => 'draft',
            ];

            $opr = $this->repository->firstBooking($dataBooking);
            $booking_id = $opr->id_pemesanan;

            $basePrice = $request->real_price;
            $taxRate = 0.11;

            $passengerPricing = [
                'adult' => $basePrice,
                'child' => $basePrice * 0.75,
                'infant' => $basePrice * 0.10,
            ];
            $passengerTypes = [
                'adult' => $request->adult_count,
                'child' => $request->child_count,
                'infant' => $request->infant_count,
            ];

            $passengerData = [];
            foreach ($passengerTypes as $type => $count) {
                for ($i = 0; $i < $count; $i++) {
                    $priceWithTax = (int) round($passengerPricing[$type] + ($passengerPricing[$type] * $taxRate));
                    $passengerData[] = [
                        'id_pemesanan' => $booking_id,
                        'tipe' => $type,
                        'harga' => $priceWithTax,
                        'created_at' => now()->setTimezone('Asia/Jakarta'),
                        'updated_at' => now()->setTimezone('Asia/Jakarta'),
                    ];
                }
            }

            $opr = $this->repository->firstBookingPassenger($passengerData);

            DB::commit();
            session()->flash('success', 'Booking has been submitted, please fill in passenger data');
            return redirect(route('booking-passenger.detail', ['id' => $booking_id]));
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function secondBooking($request) {
        DB::beginTransaction();
        try {
            $passengerData = $request->input('passengers', []);
            $bookingId = $request->input('booking_id');

            $this->repository->secondBooking($passengerData);
            $this->repository->updateBookingStatus($bookingId, 'select_seat');

            DB::commit();
            session()->flash('success', 'Passenger data has been updated successfully.');

            return redirect(route('booking-passenger.booking-seat', ['id' => $bookingId]));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function thirdBooking($request) {
        DB::beginTransaction();
        try {
            $passengerData = $request->input('passengers', []);
            $bookingId = $request->input('booking_id');
            $routeId = $request->input('route_id');
            $transportId = $request->input('transport_id');

            $this->repository->thirdBooking($passengerData, $routeId, $transportId);
            $this->repository->updateBookingStatus($bookingId, 'waiting_payment');

            DB::commit();
            session()->flash('success', 'Passenger seat has been selected successfully.');

            return redirect(route('booking.payment', ['id' => $bookingId]));
        } catch (\Exception $e) {
            DB::rollBack();
            return dd($e->getMessage());
        }
    }

    public function fourthBooking($request) {
        DB::beginTransaction();
        try {
            $bookingId = $request->input('id');

            $this->repository->updateBookingStatus($bookingId, 'paid');

            DB::commit();
            session()->flash('success', 'Successfully paid. Check your email for the ticket.');

            return redirect(route('booking.success-payment', ['id' => $bookingId]));
        } catch (\Exception $e) {
            DB::rollBack();
            return dd($e->getMessage());
        }
    }

    public function detailFacilities($id) {
        $data = [];
        $data['detail'] = $this->modelView->find($id);

        return $data;
    }
}
