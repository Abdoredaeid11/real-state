<?php

namespace App\Http\Controllers\Broker;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $brokerId = Auth::id();

        $reservations = Reservation::with(['property', 'broker'])
            ->where('broker_id', $brokerId)
            ->search($request->search)
            ->status($request->status)
            ->when($request->property_id, fn($q) => $q->where('property_id', $request->property_id))
            ->orderByDesc('created_at')
            ->paginate(10)
            ->appends($request->query());

        $properties = Property::where('broker_id', $brokerId)
            ->select('id', 'title', 'title_ar')
            ->get();

        return view('broker.reservations.index', compact('reservations', 'properties'));
    }
}

