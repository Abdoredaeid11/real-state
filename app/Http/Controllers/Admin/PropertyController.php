<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\PropertyImage;
use App\Models\PropertyType;
use App\Models\Category;
use App\Models\User;
use App\Models\Feature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PropertyController extends Controller
{
    //
    public function index(Request $request){
        $properties = Property::with(['type','category','images','broker','user'])
            ->typeId($request->property_type_id)
            ->city($request->city)
            ->priceMin($request->price_min)
            ->priceMax($request->price_max)
            ->search($request->search)
            ->status($request->status)
            ->when($request->type, fn($q) => $q->where('type', $request->type))
            ->when($request->broker_id, fn($q) => $q->where('broker_id', $request->broker_id))
            ->when($request->user_id, fn($q) => $q->where('user_id', $request->user_id))
            ->when($request->feature_ids, function($q) use ($request) {
                $ids = is_array($request->feature_ids) ? $request->feature_ids : [$request->feature_ids];
                $q->whereHas('features', function($f) use ($ids) {
                    $f->whereIn('features.id', $ids);
                });
            })
            ->orderByRaw("CASE WHEN status = 'pending' THEN 0 ELSE 1 END")
            ->orderByDesc('created_at')
            ->paginate(10)
            ->appends($request->query());

        $types = PropertyType::select('id','name')->get();
        $brokers = User::where('role', User::ROLE_BROKER)->select('id','name')->get();
        $users = User::where('role', User::ROLE_USER)->select('id','name')->get();
        $features = Feature::select('id','name_en','name_ar')->get();

        return view("admin.properties.index",compact("properties","types","brokers","users","features"));
    }
    public function create(Request $request){
        $types = PropertyType::select('name','id')->get();
        $categories = Category::select('id', 'name', 'name_ar')->get();
        $brokers = User::where('role','broker')->get();
        $features = Feature::select('id','name_en','name_ar')->get();
        return view("admin.properties.create",compact("types","categories","brokers","features"));
    }
     public function store(Request $request)
    {
        $validated = $request->validate([
            "title"=> "required|string|max:255",
            "description"=> "required|string",
            "price"=>"required|numeric|min:0",
            "type"=>["required","string", Rule::in(['sale','rent','invest'])],
            "status"=>["required","string", Rule::in(['available','pending','sold','rented','off_market'])],
            "property_type_id"=>["required","integer","exists:property_types,id"],
            "category_id" => ["nullable", "integer", "exists:categories,id"],
            "city"=>["required","string","max:255"],
            "address"=>["required","string","max:255"],
            "latitude" => ["nullable", "numeric", "between:-90,90"],
            "longitude" => ["nullable", "numeric", "between:-180,180"],
            "map_url" => ["nullable", "url", "max:2048"],
            "bedrooms"=>["required","integer","min:0"],
            "bathrooms" => ["required","integer","min:0"],
            "area"=> ["required","numeric","min:0"],
            "broker_id"=> ["nullable","integer","exists:users,id"],
            "floor_plan" => ["nullable","image","mimes:jpeg,png,jpg,webp","max:4096"],
            "images" => ["nullable","array"],
            "images.*" => ["image","mimes:jpeg,png,jpg,webp","max:2048"],
            "feature_ids" => ["nullable","array"],
            "feature_ids.*" => ["integer","exists:features,id"],
        ]);

        if ($request->hasFile('floor_plan')) {
            $floorPlanPath = $request->file('floor_plan')->store('properties/floor_plans', 'public');
            $validated['floor_plan'] = $floorPlanPath;
        }

        $property = Property::create($validated);

        // Attach features
        $featureIds = $request->input('feature_ids', []);
        if (!empty($featureIds)) {
            $property->features()->sync($featureIds);
        }

        // Handle property images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('properties', 'public');
                PropertyImage::create([
                    'property_id' => $property->id,
                    'image' => $path
                ]);
            }
        }

        return redirect()->route("admin.properties.index", ['locale' => app()->getLocale()])->with("success","Property Created Successfully!");
    }
    public function edit($locale, $id)
    {
        $property = Property::with(['images','features'])->findOrFail($id);
        
        $types = PropertyType::select('name','id')->get();
        $categories = Category::select('id', 'name', 'name_ar')->get();
        $brokers = User::where('role','broker')->get();
        $features = Feature::select('id','name_en','name_ar')->get();

        return view('admin.properties.edit', compact('property', 'types', 'categories', 'brokers','features'));
    }

public function update(Request $request, $locale, $id)
{
    $validated = $request->validate([
        "title"=> "required|string|max:255",
        "title_ar"=> "nullable|string|max:255",
        "description"=> "required|string",
        "description_ar"=> "nullable|string",
        "price"=>"required|numeric|min:0",
        "type"=>["required","string", Rule::in(['sale','rent','invest'])],
        "status"=>["required","string", Rule::in(['available','pending','sold','rented','off_market'])],
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
        "broker_id"=> ["nullable","integer","exists:users,id"],
        "floor_plan" => ["nullable","image","mimes:jpeg,png,jpg,webp","max:4096"],
        "images" => ["nullable","array"],
        "images.*" => ["image","mimes:jpeg,png,jpg,webp","max:2048"],
        "remove_images" => ["nullable","array"],
        "remove_images.*" => ["integer","exists:property_images,id"],
        "feature_ids" => ["nullable","array"],
        "feature_ids.*" => ["integer","exists:features,id"],
    ]);

    $property = Property::findOrFail($id);
    $broker_id = $property->broker_id;

    if ($request->hasFile('floor_plan')) {
        if ($property->floor_plan && Storage::disk('public')->exists($property->floor_plan)) {
            Storage::disk('public')->delete($property->floor_plan);
        }
        $floorPlanPath = $request->file('floor_plan')->store('properties/floor_plans', 'public');
        $validated['floor_plan'] = $floorPlanPath;
    }

    // >>> keep old broker if form sends empty broker_id
    if (!array_key_exists('broker_id', $validated) || $validated['broker_id'] === null) {
        $validated['broker_id'] = $broker_id;
    }

    $property->update($validated);

    // Sync features
    $featureIds = $request->input('feature_ids', []);
    $property->features()->sync($featureIds);

    // Remove selected images
    $removeImages = $request->input('remove_images', []);
    if (!empty($removeImages)) {
        $imagesToDelete = $property->images()->whereIn('id', $removeImages)->get();
        foreach ($imagesToDelete as $image) {
            if (Storage::disk('public')->exists($image->image)) {
                Storage::disk('public')->delete($image->image);
            }
            $image->delete();
        }
    }

    // Handle property images
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $path = $image->store('properties', 'public');
            PropertyImage::create([
                'property_id' => $property->id,
                'image' => $path
            ]);
        }
    }

    return redirect()->route("admin.properties.index", ['locale' => app()->getLocale()])
        ->with("success","Property Updated Successfully!");
}

    public function destroy($locale, $id)
    {
        $property = Property::findOrFail($id);

        // Delete related images from storage
        foreach ($property->images as $image) {
            if (Storage::disk('public')->exists($image->image)) {
                Storage::disk('public')->delete($image->image);
            }
        }

        $property->delete();

        return redirect()->route("admin.properties.index", ['locale' => app()->getLocale()])->with("success","Property Deleted Successfully!");
    }

    public function approve($locale, $id)
    {
        $property = Property::findOrFail($id);
        $property->update(['status' => 'available']);

        return redirect()->back()->with('success', 'Property approved successfully.');
    }

    public function reject($locale, $id)
    {
        $property = Property::findOrFail($id);
        $property->update(['status' => 'off_market']);

        return redirect()->back()->with('success', 'Property rejected successfully.');
    }

}
