<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = SiteSetting::first() ?? new SiteSetting();
        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $settings = SiteSetting::first() ?? new SiteSetting();
        $settings->fill($request->except('_token'));
        $settings->save();
        return redirect()->back()->with('success', __('admin.settings.settings_updated'));
    }
}
