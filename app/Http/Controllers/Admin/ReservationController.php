<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $reservations = Reservation::with(['property', 'broker'])
            ->search($request->search)
            ->status($request->status)
            ->when($request->broker_id, fn($q) => $q->where('broker_id', $request->broker_id))
            ->when($request->property_id, fn($q) => $q->where('property_id', $request->property_id))
            ->orderByDesc('created_at')
            ->paginate(10)
            ->appends($request->query());

        $brokers = User::where('role', User::ROLE_BROKER)->select('id', 'name')->get();
        $properties = Property::select('id', 'title')->get();

        return view('admin.reservations.index', compact('reservations', 'brokers', 'properties'));
    }

    public function create()
    {
        $brokers = User::where('role', User::ROLE_BROKER)->select('id', 'name')->get();
        $properties = Property::select('id', 'title')->get();

        return view('admin.reservations.create', compact('brokers', 'properties'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_email' => ['nullable', 'email', 'max:255'],
            'customer_phone' => ['nullable', 'string', 'max:50'],
            'property_id' => ['nullable', 'integer', 'exists:properties,id'],
            'broker_id' => ['nullable', 'integer', 'exists:users,id'],
            'check_in' => ['nullable', 'date'],
            'check_out' => ['nullable', 'date', 'after_or_equal:check_in'],
            'status' => ['required', Rule::in(['pending', 'contacted', 'confirmed', 'cancelled'])],
            'expected_value' => ['nullable', 'numeric', 'min:0'],
            'notes' => ['nullable', 'string'],
            'notes_ar' => ['nullable', 'string'],
        ]);

        $validated['updated_by'] = Auth::id();
        Reservation::create($validated);

        return redirect()->route('admin.reservations.index', ['locale' => app()->getLocale()])->with('success', 'Reservation created successfully.');
    }

    public function edit($locale, $id)
    {
        $reservation = Reservation::findOrFail($id);
        $brokers = User::where('role', User::ROLE_BROKER)->select('id', 'name')->get();
        $properties = Property::select('id', 'title')->get();

        return view('admin.reservations.edit', compact('reservation', 'brokers', 'properties'));
    }

    public function update(Request $request, $locale, $id)
    {
        $reservation = Reservation::findOrFail($id);

        $validated = $request->validate([
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_email' => ['nullable', 'email', 'max:255'],
            'customer_phone' => ['nullable', 'string', 'max:50'],
            'property_id' => ['nullable', 'integer', 'exists:properties,id'],
            'broker_id' => ['nullable', 'integer', 'exists:users,id'],
            'check_in' => ['nullable', 'date'],
            'check_out' => ['nullable', 'date', 'after_or_equal:check_in'],
            'status' => ['required', Rule::in(['pending', 'contacted', 'confirmed', 'cancelled'])],
            'expected_value' => ['nullable', 'numeric', 'min:0'],
            'notes' => ['nullable', 'string'],
            'notes_ar' => ['nullable', 'string'],
        ]);

        $validated['updated_by'] = Auth::id();
        $reservation->update($validated);

        return redirect()->route('admin.reservations.index', ['locale' => app()->getLocale()])->with('success', 'Reservation updated successfully.');
    }

    public function changeStatus(Request $request, $locale, $id)
    {
        $reservation = Reservation::findOrFail($id);

        $validated = $request->validate([
            'status' => ['required', Rule::in(['pending', 'contacted', 'confirmed', 'cancelled'])],
        ]);

        $reservation->update([
            'status' => $validated['status'],
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('admin.reservations.index', ['locale' => app()->getLocale()])->with('success', 'Reservation updated successfully.');
    }

    public function destroy($locale, $id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return redirect()->route('admin.reservations.index', ['locale' => app()->getLocale()])->with('success', 'Reservation deleted successfully.');
    }
}
