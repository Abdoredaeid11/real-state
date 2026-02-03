<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Store a newly created reservation (public) from property details form.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'property_id' => 'required|exists:properties,id',
            'broker_id' => 'nullable|exists:users,id',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:50',
            'notes' => 'nullable|string',
        ]);

        $data['status'] = 'pending';
        $data['expected_value'] = null;

        $reservation = Reservation::create([
            'property_id' => $data['property_id'],
            'broker_id' => $data['broker_id'] ?? null,
            'customer_name' => $data['customer_name'],
            'customer_email' => $data['customer_email'],
            'customer_phone' => $data['customer_phone'],
            'notes' => $data['notes'] ?? null,
            'status' => $data['status'],
        ]);

        return redirect()->back()->with('success', 'Reservation request submitted successfully.');
    }
}
