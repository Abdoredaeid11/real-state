<?php

namespace App\Http\Controllers\Broker;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\PropertyImage;
use App\Models\PropertyType;
use App\Models\Category;
use App\Models\Feature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $brokerId = Auth::id();
        $properties = Property::with(['type', 'category', 'images', 'broker'])
            ->where('broker_id', $brokerId)
            ->typeId($request->property_type_id)
            ->city($request->city)
            ->priceMin($request->price_min)
            ->priceMax($request->price_max)
            ->search($request->search)
            ->status($request->status)
            ->when($request->type, fn($q) => $q->where('type', $request->type))
            ->orderByDesc('created_at')
            ->paginate(10)
            ->appends($request->query());

        $types = PropertyType::select('id', 'name', 'name_ar')->get();

        return view('broker.properties.index', compact('properties', 'types'));
    }

    public function create()
    {       

        $types = PropertyType::select('id', 'name', 'name_ar')->get();
        $categories = Category::select('id', 'name', 'name_ar')->get();
        $features = Feature::select('id', 'name_en', 'name_ar')->get();

        return view('broker.properties.create', compact('types', 'categories', 'features'));
    }

    public function store(Request $request)
    {
        $brokerId = Auth::id();
        $validated = $request->validate([
            "title"=> "required|string|max:255",
            "title_ar"=> "nullable|string|max:255",
            "description"=> "required|string",
            "description_ar"=> "nullable|string",
            "price"=>"required|numeric|min:0",
            "type"=>["required","string", Rule::in(['sale','rent','invest'])],
            "property_type_id"=>["required","integer","exists:property_types,id"],
            "category_id" => ["nullable", "integer", "exists:categories,id"],
            "city"=>["required","string","max:255"],
            "city_ar"=> "nullable|string|max:255",
            "address"=>["required","string","max:255"],
            "address_ar"=> "nullable|string|max:255",
            "latitude" => ["nullable", "numeric", "between:-90,90"],
            "longitude" => ["nullable", "numeric", "between:-180,180"],
            "map_url" => ["nullable", "url", "max:2048"],
            "bedrooms"=>["required","integer","min:0"],
            "bathrooms" => ["required","integer","min:0"],
            "area"=> ["required","numeric","min:0"],
            "floor_plan" => ["nullable","image","mimes:jpeg,png,jpg,webp","max:4096"],
            "images" => ["nullable","array"],
            "images.*" => ["image","mimes:jpeg,png,jpg,webp","max:2048"],
            "feature_ids" => ["nullable","array"],
            "feature_ids.*" => ["integer","exists:features,id"],
        ]);

        $validated['broker_id'] = $brokerId;

        if ($request->hasFile('floor_plan')) {
            $floorPlanPath = $request->file('floor_plan')->store('properties/floor_plans', 'public');
            $validated['floor_plan'] = $floorPlanPath;
        }

        $property = Property::create($validated);

        $featureIds = $request->input('feature_ids', []);
        if (!empty($featureIds)) {
            $property->features()->sync($featureIds);
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('properties', 'public');
                PropertyImage::create([
                    'property_id' => $property->id,
                    'image' => $path
                ]);
            }
        }

        return redirect()->route('broker.properties.index', app()->getLocale())->with('success', 'Property submitted and pending approval.');
    }

    public function edit($locale, $id)
    {
        $brokerId = Auth::id();

        $property = Property::with(['images', 'features'])
            ->where('broker_id', $brokerId)
            ->findOrFail($id);

        $types = PropertyType::select('id', 'name', 'name_ar')->get();
        $categories = Category::select('id', 'name', 'name_ar')->get();
        $features = Feature::select('id', 'name_en', 'name_ar')->get();

        return view('broker.properties.edit', compact('property', 'types', 'categories', 'features'));
    }

    public function update(Request $request, $locale, $id)
    {
        $brokerId = Auth::id();

        $property = Property::with(['images'])
            ->where('broker_id', $brokerId)
            ->findOrFail($id);

        $validated = $request->validate([
            "title"=> "required|string|max:255",
            "title_ar"=> "nullable|string|max:255",
            "description"=> "required|string",
            "description_ar"=> "nullable|string",
            "price"=>"required|numeric|min:0",
            "type"=>["required","string", Rule::in(['sale','rent','invest'])],
            "property_type_id"=>["required","integer","exists:property_types,id"],
            "category_id" => ["nullable", "integer", "exists:categories,id"],
            "city"=>["required","string","max:255"],
            "city_ar"=> "nullable|string|max:255",
            "address"=>["required","string","max:255"],
            "address_ar"=> "nullable|string|max:255",
            "latitude" => ["nullable", "numeric", "between:-90,90"],
            "longitude" => ["nullable", "numeric", "between:-180,180"],
            "map_url" => ["nullable", "url", "max:2048"],
            "bedrooms"=>["required","integer","min:0"],
            "bathrooms" => ["required","integer","min:0"],
            "area"=> ["required","numeric","min:0"],
            "floor_plan" => ["nullable","image","mimes:jpeg,png,jpg,webp","max:4096"],
            "images" => ["nullable","array"],
            "images.*" => ["image","mimes:jpeg,png,jpg,webp","max:2048"],
            "feature_ids" => ["nullable","array"],
            "feature_ids.*" => ["integer","exists:features,id"],
        ]);

        if ($request->hasFile('floor_plan')) {
            if ($property->floor_plan && Storage::disk('public')->exists($property->floor_plan)) {
                Storage::disk('public')->delete($property->floor_plan);
            }
            $floorPlanPath = $request->file('floor_plan')->store('properties/floor_plans', 'public');
            $validated['floor_plan'] = $floorPlanPath;
        }

        $property->update($validated);

        $featureIds = $request->input('feature_ids', []);
        $property->features()->sync($featureIds);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('properties', 'public');
                PropertyImage::create([
                    'property_id' => $property->id,
                    'image' => $path
                ]);
            }
        }

        return redirect()->route('broker.properties.index', $locale)->with('success', 'Property updated and pending approval.');
    }
}
