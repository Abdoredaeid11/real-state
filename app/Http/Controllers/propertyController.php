<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyType;
use Illuminate\Http\Request;

class propertyController extends Controller
{
    public function leftSidebar(Request $request)
    {
        $query = Property::with(['type', 'broker', 'images']);
        // Apply filters
        $query->typeId($request->property_type);
        $query->city($request->city);
        $query->priceMin($request->min_price);
        $query->priceMax($request->max_price);
        $query->status($request->status);
        $query->search($request->search);

        // Additional filters
        if ($request->bedrooms) {
            $query->where('bedrooms', $request->bedrooms);
        }
        if ($request->bathrooms) {
            $query->where('bathrooms', $request->bathrooms);
        }
        if ($request->garages) {
            // Assuming garages is a field, or from features
            // For now, skip or add logic
        }
        if ($request->min_area) {
            $query->where('area', '>=', $request->min_area);
        }
        if ($request->max_area) {
            $query->where('area', '<=', $request->max_area);
        }

        // Sorting
        $sort = $request->sort ?? 'recommend';
        switch ($sort) {
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'latest':
                $query->orderBy('updated_at', 'desc');
                break;
            case 'popularity':
                // Assuming no popularity field, order by views or something, for now by id
                $query->orderBy('id', 'desc');
                break;
            default:
                $query->orderBy('id', 'desc');
        }

        $properties = $query->paginate(8);

        // Popular properties
        $popularProperties = Property::with(['type', 'broker', 'images'])->latest()->take(6)->get();

        // Property types for sidebar
        $propertyTypes = PropertyType::all();

        return view('properties.property-left-sidebar', compact('properties', 'popularProperties', 'propertyTypes'));
    }
}
