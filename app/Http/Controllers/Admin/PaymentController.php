<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $payments = Payment::with('reservation')
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->when($request->reservation_id, fn($q) => $q->where('reservation_id', $request->reservation_id))
            ->orderByDesc('payment_date')
            ->paginate(10)
            ->appends($request->query());

        $reservations = Reservation::select('id', 'customer_name')->get();

        return view('admin.payment.index', compact('payments', 'reservations'));
    }

    public function create()
    {
        $reservations = Reservation::select('id', 'customer_name')->get();
        return view('admin.payment.create', compact('reservations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'reservation_id' => ['nullable', 'integer', 'exists:reservations,id'],
            'amount' => ['required', 'numeric', 'min:0'],
            'payment_method' => ['required', 'string', 'max:100'],
            'payment_method_ar' => ['nullable', 'string', 'max:100'],
            'payment_date' => ['nullable', 'date'],
            'status' => ['required', Rule::in(['paid', 'pending', 'failed'])],
            'reference' => ['nullable', 'string', 'max:255'],
        ]);

        $validated['updated_by'] = Auth::id();
        Payment::create($validated);

        return redirect()->route('admin.payments.index', ['locale' => app()->getLocale()])->with('success', 'Payment recorded successfully.');
    }

    public function edit($locale, $id)
    {
        $payment = Payment::findOrFail($id);
        $reservations = Reservation::select('id', 'customer_name')->get();

        return view('admin.payment.edit', compact('payment', 'reservations'));
    }

    public function update(Request $request, $locale, $id)
    {
        $payment = Payment::findOrFail($id);

        $validated = $request->validate([
            'reservation_id' => ['nullable', 'integer', 'exists:reservations,id'],
            'amount' => ['required', 'numeric', 'min:0'],
            'payment_method' => ['required', 'string', 'max:100'],
            'payment_method_ar' => ['nullable', 'string', 'max:100'],
            'payment_date' => ['nullable', 'date'],
            'status' => ['required', Rule::in(['paid', 'pending', 'failed'])],
            'reference' => ['nullable', 'string', 'max:255'],
        ]);

        $validated['updated_by'] = Auth::id();
        $payment->update($validated);

        return redirect()->route('admin.payments.index', ['locale' => app()->getLocale()])->with('success', 'Payment updated successfully.');
    }

    public function destroy($locale, $id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();

        return redirect()->route('admin.payments.index', ['locale' => app()->getLocale()])->with('success', 'Payment deleted successfully.');
    }
}
