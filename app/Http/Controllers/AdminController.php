<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $messages = Message::latest()->paginate(10);
        return view('admin.dashboard', compact('messages'));
    }

    public function settings()
    {
        $settings = SiteSetting::first() ?? new SiteSetting();
        return view('admin.settings', compact('settings'));
    }

    public function updateSettings(Request $request)
    {
        $settings = SiteSetting::first() ?? new SiteSetting();
        $settings->fill($request->all());
        $settings->save();
        return redirect()->back()->with('success', 'Settings updated successfully.');
    }

    public function messages()
    {
        $messages = Message::latest()->paginate(10);
        return view('admin.messages', compact('messages'));
    }
}
