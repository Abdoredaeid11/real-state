<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    public function index()
    {
        $features = Feature::orderBy('id', 'desc')->paginate(10);
        return view('admin.features.index', compact('features'));
    }

    public function create()
    {
        return view('admin.features.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_en' => ['required', 'string', 'max:255'],
            'name_ar' => ['required', 'string', 'max:255'],
        ]);

        Feature::create($validated);

        return redirect()->route('admin.features.index', ['locale' => app()->getLocale()])->with('success', 'Feature created successfully.');
    }

    public function edit($locale, $id)
    {
        $feature = Feature::findOrFail($id);
        return view('admin.features.edit', compact('feature'));
    }

    public function update(Request $request, $locale, $id)
    {
        $feature = Feature::findOrFail($id);

        $validated = $request->validate([
            'name_en' => ['required', 'string', 'max:255'],
            'name_ar' => ['required', 'string', 'max:255'],
        ]);

        $feature->update($validated);

        return redirect()->route('admin.features.index', ['locale' => app()->getLocale()])->with('success', 'Feature updated successfully.');
    }

    public function destroy($locale, $id)
    {
        $feature = Feature::findOrFail($id);
        $feature->delete();

        return redirect()->route('admin.features.index', ['locale' => app()->getLocale()])->with('success', 'Feature deleted successfully.');
    }
}

