<?php

namespace App\Http\Controllers\Broker;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $brokerId = Auth::id();

        $reservationIds = Reservation::where('broker_id', $brokerId)->pluck('id');

        $payments = Payment::with('reservation')
            ->whereIn('reservation_id', $reservationIds)
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->when($request->reservation_id, fn($q) => $q->where('reservation_id', $request->reservation_id))
            ->orderByDesc('payment_date')
            ->paginate(10)
            ->appends($request->query());

        $reservations = Reservation::whereIn('id', $reservationIds)
            ->select('id', 'customer_name')
            ->get();

        return view('broker.payments.index', compact('payments', 'reservations'));
    }
}

