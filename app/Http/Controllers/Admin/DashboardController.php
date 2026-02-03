<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Property;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Feature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function index()
    {
        // 🔹 Basic counts
        $totalProperties = Property::count();
        $totalAdmins = User::where('role', 'admin')->count();
        $totalBrokers = User::where('role', 'broker')->count();
        $totalUsers = User::where('role', 'user')->count();
        //$totalSales = Property::where('status', 'sold')->sum('price'); // لو عندك status sold/rent

        // 📈 Properties added per month (line chart)
        $propertiesPerMonth = Property::select(
            DB::raw('COUNT(*) as count'),
            DB::raw('MONTH(created_at) as month')
        )
            ->groupBy('month')
            ->pluck('count', 'month');

        $months = range(1, 12);
        $propertyData = [];
        foreach ($months as $month) {
            $propertyData[] = $propertiesPerMonth[$month] ?? 0;
        }

        // Leads / reservations stats
        $totalReservations = Reservation::count();
        $openLeads = Reservation::whereIn('status', ['pending', 'contacted'])->count();
        $upcomingCheckins = Reservation::whereNotNull('check_in')
            ->whereDate('check_in', '>=', now()->toDateString())
            ->whereDate('check_in', '<=', now()->addDays(7)->toDateString())
            ->count();

        // Payments stats
        $totalPaidAmount = Payment::where('status', 'paid')->sum('amount');
        $paymentsPerMonth = Payment::where('status', 'paid')
            ->select(DB::raw('SUM(amount) as total'), DB::raw('MONTH(payment_date) as month'))
            ->whereNotNull('payment_date')
            ->groupBy('month')
            ->pluck('total', 'month');

        $paymentData = [];
        foreach ($months as $month) {
            $paymentData[] = (float) ($paymentsPerMonth[$month] ?? 0);
        }

        // 🏘 Distribution by property type
        $propertyTypes = DB::table('property_types')
            ->join('properties', 'property_types.id', '=', 'properties.property_type_id')
            ->select('property_types.name', DB::raw('COUNT(properties.id) as total'))
            ->groupBy('property_types.name')
            ->pluck('total', 'name');

        // 📊 Top brokers by number of properties
        $topBrokers = User::where('role', 'broker')
            ->select('users.name', DB::raw('COUNT(properties.id) as total_properties'))
            ->leftJoin('properties', 'users.id', '=', 'properties.broker_id')
            ->groupBy('users.name')
            ->orderByDesc('total_properties')
            ->take(5)
            ->get();
        return view('admin.dashboard', compact(
            'totalProperties',
            'totalBrokers',
            'totalUsers',
            'totalReservations',
            'openLeads',
            'upcomingCheckins',
            'totalPaidAmount',
            'propertyData',
            'paymentData',
            'propertyTypes',
            'topBrokers',
           
        ));
    }
}
