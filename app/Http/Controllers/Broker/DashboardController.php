<?php

namespace App\Http\Controllers\Broker;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Reservation;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $broker = Auth::user();

        $totalProperties = Property::where('broker_id', $broker->id)->count();

        $reservationQuery = Reservation::where('broker_id', $broker->id);

        $totalReservations = (clone $reservationQuery)->count();

        $openLeads = (clone $reservationQuery)
            ->whereIn('status', ['pending', 'contacted'])
            ->count();

        $upcomingCheckins = (clone $reservationQuery)
            ->whereNotNull('check_in')
            ->whereDate('check_in', '>=', now()->toDateString())
            ->whereDate('check_in', '<=', now()->addDays(7)->toDateString())
            ->count();

        $reservationIds = (clone $reservationQuery)->pluck('id');

        $totalPaidAmount = Payment::whereIn('reservation_id', $reservationIds)
            ->where('status', 'paid')
            ->sum('amount');

        $propertiesPerMonth = Property::where('broker_id', $broker->id)
            ->select(DB::raw('COUNT(*) as count'), DB::raw('MONTH(created_at) as month'))
            ->groupBy('month')
            ->pluck('count', 'month');

        $months = range(1, 12);
        $propertyData = [];
        foreach ($months as $month) {
            $propertyData[] = $propertiesPerMonth[$month] ?? 0;
        }

        $paymentsPerMonth = Payment::whereIn('reservation_id', $reservationIds)
            ->where('status', 'paid')
            ->select(DB::raw('SUM(amount) as total'), DB::raw('MONTH(payment_date) as month'))
            ->whereNotNull('payment_date')
            ->groupBy('month')
            ->pluck('total', 'month');

        $paymentData = [];
        foreach ($months as $month) {
            $paymentData[] = (float) ($paymentsPerMonth[$month] ?? 0);
        }

        $propertyTypes = DB::table('property_types')
            ->join('properties', 'property_types.id', '=', 'properties.property_type_id')
            ->where('properties.broker_id', $broker->id)
            ->select('property_types.name', DB::raw('COUNT(properties.id) as total'))
            ->groupBy('property_types.name')
            ->pluck('total', 'name');

        return view('broker.dashboard', compact(
            'broker',
            'totalProperties',
            'totalReservations',
            'openLeads',
            'upcomingCheckins',
            'totalPaidAmount',
            'propertyData',
            'paymentData',
            'propertyTypes',
        ));
    }
}
