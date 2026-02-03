<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyType;
use App\Models\Category;
use App\Models\PropertyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class propertyController extends Controller
{
    public function create()
    {
        $types = PropertyType::select('id', 'name', 'name_ar')->get();
        $categories = Category::select('id', 'name', 'name_ar')->get();

        return view('properties.create', compact('types', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "title"=> "required|string|max:255",
            "description"=> "required|string",
            "price"=>"required|numeric|min:0",
            "type"=>["required","string", Rule::in(['sale','rent','invest'])],
            "property_type_id"=>["required","integer","exists:property_types,id"],
            "category_id" => ["nullable", "integer", "exists:categories,id"],
            "city"=>["required","string","max:255"],
            "address"=>["required","string","max:255"],
            "bedrooms"=>["required","integer","min:0"],
            "bathrooms" => ["required","integer","min:0"],
            "area"=> ["required","numeric","min:0"],
            "floor_plan" => ["nullable","image","mimes:jpeg,png,jpg,webp","max:4096"],
            "images" => ["nullable","array"],
            "images.*" => ["image","mimes:jpeg,png,jpg,webp","max:2048"],
        ]);

        $validated['user_id'] = Auth::id();

        if ($request->hasFile('floor_plan')) {
            $floorPlanPath = $request->file('floor_plan')->store('properties/floor_plans', 'public');
            $validated['floor_plan'] = $floorPlanPath;
        }

        $property = Property::create($validated);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('properties', 'public');
                PropertyImage::create([
                    'property_id' => $property->id,
                    'image' => $path
                ]);
            }
        }

        return redirect()->route('user.properties.create')->with('success', 'Your property has been submitted and is pending admin approval.');
    }

    public function leftSidebar(Request $request)
    {
        $query = Property::with(['type', 'broker', 'images'])
            ->whereNotIn('status', ['pending', 'off_market']);
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
        $popularProperties = Property::with(['type', 'broker', 'images'])
            ->whereNotIn('status', ['pending', 'off_market'])
            ->latest()
            ->take(6)
            ->get();

        // Property types for sidebar
        $propertyTypes = PropertyType::all();

        return view('properties.property-left-sidebar', compact('properties', 'popularProperties', 'propertyTypes'));
    }
}
