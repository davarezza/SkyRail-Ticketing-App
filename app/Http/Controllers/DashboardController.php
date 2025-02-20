<?php

namespace App\Http\Controllers;

use App\Models\Rute;
use App\Models\ViewModels\BookingView;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {
        $currentMonth = Carbon::now()->format('Y-m');
        $lastMonth = Carbon::now()->subMonth()->format('Y-m');

        $completed_payments = BookingView::where('status', 'verified')
            ->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->count();

        $last_month_payments = BookingView::where('status', 'verified')
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->count();

        $monthly_revenue = BookingView::where('status', 'verified')
            ->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->sum('total_payment');

        $last_month_revenue = BookingView::where('status', 'verified')
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->sum('total_payment');

        $revenue_difference = $monthly_revenue - $last_month_revenue;
        $payment_difference = $completed_payments - $last_month_payments;

        $average_transaction_value = $completed_payments > 0
            ? $monthly_revenue / $completed_payments
            : 0;

        $last_month_average_transaction_value = $last_month_payments > 0
            ? $last_month_revenue / $last_month_payments
            : 0;

        $average_transaction_difference = $average_transaction_value - $last_month_average_transaction_value;

        return view('dashboard.index', [
            'completed_payments' => $completed_payments,
            'payment_difference' => $payment_difference,
            'monthly_revenue' => $monthly_revenue,
            'revenue_difference' => $revenue_difference,
            'average_transaction_value' => $average_transaction_value,
            'average_transaction_difference' => $average_transaction_difference
        ]);
    }

    public function getRevenueLast12Months()
    {
        $months = collect(range(0, 11))->map(function ($i) {
            return Carbon::now()->subMonths($i)->format('Y-m');
        })->reverse()->values();

        $revenues = BookingView::where('status', 'verified')
            ->whereBetween('created_at', [Carbon::now()->subYear(), Carbon::now()])
            ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') as month, SUM(total_payment) as revenue")
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->pluck('revenue', 'month');

        $revenueData = $months->map(function ($month) use ($revenues) {
            return isset($revenues[$month]) ? number_format($revenues[$month], 0, ',', '.') : "0";
        });

        return response()->json([
            'months' => $months->map(fn($m) => Carbon::createFromFormat('Y-m', $m)->format('M')),
            'revenues' => $revenueData,
        ]);
    }

    public function getTicketSalesPerRoute()
    {
        try {
            $ticketSales = BookingView::where('v_booking.status', 'verified')
                ->join('v_booking_passenger', 'v_booking.id', '=', 'v_booking_passenger.booking_id')
                ->selectRaw("CONCAT(v_booking.departure_city, ' - ', v_booking.objective_city) as route, COUNT(v_booking_passenger.id) as total_tickets")
                ->groupBy('route')
                ->orderByDesc('total_tickets')
                ->pluck('total_tickets', 'route');

            if ($ticketSales->isEmpty()) {
                Log::warning('No ticket sales data found.');
            }

            return response()->json([
                'routes' => $ticketSales->keys(),
                'tickets' => $ticketSales->values(),
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching ticket sales data: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function getTicketClassDistribution()
    {
        try {
            $ticketClasses = BookingView::where('v_booking.status', 'verified')
                ->join('v_booking_passenger', 'v_booking.id', '=', 'v_booking_passenger.booking_id')
                ->join('v_transportasis', 'v_booking.transport_id', '=', 'v_transportasis.id')
                ->selectRaw("v_transportasis.class_name, COUNT(v_booking_passenger.id) as total_tickets")
                ->groupBy('v_transportasis.class_name')
                ->pluck('total_tickets', 'class_name');

            return response()->json([
                'classes' => $ticketClasses->keys(),
                'tickets' => $ticketClasses->values(),
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching ticket class distribution: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function getPassengerAgeDistribution()
    {
        try {
            $passengerAges = BookingView::where('status', 'verified')
                ->join('v_booking_passenger', 'v_booking.id', '=', 'v_booking_passenger.booking_id')
                ->selectRaw("v_booking_passenger.type, COUNT(*) as total_passengers")
                ->groupBy('v_booking_passenger.type')
                ->pluck('total_passengers', 'type');

            return response()->json([
                'types' => $passengerAges->keys(),
                'counts' => $passengerAges->values(),
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching passenger age distribution: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
}
