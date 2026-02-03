<?php

namespace App\Http\Controllers;

use App\Models\BrokerVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BrokerKycController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $verification = BrokerVerification::where('user_id', $user->id)->latest()->first();

        return view('broker.kyc', compact('verification'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_image' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:4096'],
            'selfie_image' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:4096'],
        ]);

        $user = Auth::user();

        $idPath = $request->file('id_image')->store('broker_verifications', 'public');
        $selfiePath = $request->file('selfie_image')->store('broker_verifications', 'public');

        BrokerVerification::create([
            'user_id' => $user->id,
            'id_image' => $idPath,
            'selfie_image' => $selfiePath,
            'status' => 'pending',
        ]);

        return redirect()->route('home.index')->with('success', __('Your verification was submitted. Please wait for approval.'));
    }
}
