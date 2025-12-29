<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeaturePropertyController extends Controller
{
    public function index()
    {
        // Get all pivot records with related data
        $featureProperties = DB::table('feature_property')
            ->join('properties', 'feature_property.property_id', '=', 'properties.id')
            ->join('features', 'feature_property.feature_id', '=', 'features.id')
            ->select(
                'feature_property.id as pivot_id',
                'properties.title as property_title',
                'properties.id as property_id',
                'features.name_en',
                'features.name_ar',
                'features.id as feature_id',
                'feature_property.created_at'
            )
            ->orderByDesc('feature_property.created_at')
            ->paginate(10);

        return view('admin.feature_property.index', compact('featureProperties'));
    }

    public function create()
    {
        $properties = Property::select('id', 'title')->get();
        $features = Feature::select('id', 'name_en', 'name_ar')->get();
        return view('admin.feature_property.create', compact('properties', 'features'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'property_id' => ['required', 'exists:properties,id'],
            'feature_ids' => ['required', 'array'],
            'feature_ids.*' => ['exists:features,id'],
        ]);

        $property = Property::findOrFail($validated['property_id']);
        
        // Attach features (syncWithoutDetaching prevents duplicates but keeps existing ones)
        // Or just syncWithoutDetaching? 
        // If user selects features A, B. Property already has B, C.
        // syncWithoutDetaching([A, B]) -> Result: A, B, C.
        // attach([A, B]) -> Error if B exists (Unique constraint).
        
        $property->features()->syncWithoutDetaching($validated['feature_ids']);

        return redirect()->route('admin.feature-properties.index', ['locale' => app()->getLocale()])
            ->with('success', 'Features assigned to property successfully.');
    }

    public function edit($locale, $property_id)
    {
        $property = Property::with('features')->findOrFail($property_id);
        $features = Feature::select('id', 'name_en', 'name_ar')->get();
        
        return view('admin.feature_property.edit', compact('property', 'features'));
    }

    public function update(Request $request, $locale, $property_id)
    {
        $validated = $request->validate([
            'feature_ids' => ['nullable', 'array'],
            'feature_ids.*' => ['exists:features,id'],
        ]);

        $property = Property::findOrFail($property_id);
        
        // Sync features (replaces all existing features with selected ones)
        $property->features()->sync($validated['feature_ids'] ?? []);

        return redirect()->route('admin.feature-properties.index', ['locale' => app()->getLocale()])
            ->with('success', 'Property features updated successfully.');
    }

    public function destroy($locale, $property_id, $feature_id)
    {
        $property = Property::findOrFail($property_id);
        $property->features()->detach($feature_id);

        return redirect()->route('admin.feature-properties.index', ['locale' => app()->getLocale()])
            ->with('success', 'Feature removed from property successfully.');
    }
}
