<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BrokerVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class BrokerVerificationController extends Controller
{
    //
    public function index()
    {
        $verifications = BrokerVerification::with('user')->latest()->paginate(10);
        return view('admin.broker_verifications.index', compact('verifications'));
    }
    public function approve($locale, $id)
    {
        $verification = BrokerVerification::findOrFail($id);
        $verification->update([
            'status' => 'approved',
            'rejection_reason' => null,
            'reviewed_by' => Auth::id(),
            'reviewed_at' => now(),
        ]);
        $verification->user->update(['role' => 'broker']);
        return redirect()->back()->with('success', 'Broker approved successfully!');
    }
        public function reject(Request $request, $locale, $id)
    {
        $request->validate([
            'rejection_reason' => ['nullable','string','max:1000'],
        ]);
        $verification = BrokerVerification::findOrFail($id);
        $verification->update([
            'status' => 'rejected',
            'rejection_reason' => $request->input('rejection_reason'),
            'reviewed_by' => Auth::id(),
            'reviewed_at' => now(),
        ]);
        return redirect()->back()->with('success', 'Broker verification rejected.');
    }
        public function destroy($locale,$id)
    {
        $verification = BrokerVerification::findOrFail($id);
        if (Storage::disk('public')->exists($verification->id_image)) {
            Storage::disk('public')->delete($verification->id_image);
        }
        if (Storage::disk('public')->exists($verification->selfie_image)) {
            Storage::disk('public')->delete($verification->selfie_image);
        }
        $verification->delete();
        return redirect()->back()->with('success', 'Broker verification deleted.');
    }


}
