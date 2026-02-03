<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Property;
use App\Models\PropertyImage;
use App\Models\PropertyStatus;
use App\Models\PropertyType;
use Illuminate\Http\Request;




class HomeController extends Controller
{
    //
    public function index()
    {
        $tabs = ['sell' => 'Sell', 'rent' => 'Rent'];

        $propertyTypes = PropertyType::all();
        $locations = [
            ['id' => 1, 'name_en' => 'Cairo', 'name_ar' => 'القاهرة'],
            ['id' => 2, 'name_en' => 'Giza', 'name_ar' => 'الجيزة'],
            // باقي المحافظات
        ];
        $statuses = [
            'available' => ['en' => 'Available', 'ar' => 'متاح'],
            'pending' => ['en' => 'Pending', 'ar' => 'قيد الانتظار'],
            'sold' => ['en' => 'Sold', 'ar' => 'تم البيع'],
            'rented' => ['en' => 'Rented', 'ar' => 'مستأجر'],
            'off_market' => ['en' => 'Off Market', 'ar' => 'خارج السوق'],
        ];

        $categories = Category::withCount('properties')->get();
        $latestProperties = Property::with(['category', 'type', 'images', 'broker'])
            ->whereNotIn('status', ['pending', 'off_market', 'sold'])
            ->latest()
            ->take(6)
            ->get();

        $sales = Property::with(['category', 'type', 'images', 'broker'])
            ->withCount('images')
            ->where('type', 'sale')
            ->whereNotIn('status', ['pending', 'off_market', 'sold'])
            ->latest()
            ->take(6)
            ->get();


        $agents = Agent::where('status', 'active')
            ->orderBy('name')
            ->paginate(12);

        $blogs = Blog::where('status', 'published')->get();

        $banners = PropertyImage::inRandomOrder()->take(3)->get();

        return view('index', compact('tabs', 'propertyTypes', 'locations', 'statuses', 'categories', 'agents', 'latestProperties', 'sales', 'banners', 'blogs'));
    }

     public function filterProperties(Request $request)
    {
        $tab = $request->input('tab');
        $allowedStatuses = ['available', 'pending', 'sold', 'rented', 'off_market'];

        $query = Property::query();

        $status = $request->input('status');
        if (is_string($status) && in_array($status, $allowedStatuses, true) && ! in_array($status, ['pending', 'off_market'], true)) {
            $query->where('status', $status);
        } else {
            $query->whereNotIn('status', ['pending', 'off_market']);
        }

        $tabToType = ['sell' => 'sale', 'rent' => 'rent', 'invest' => 'invest'];
        if (is_string($tab) && array_key_exists($tab, $tabToType)) {
            $query->where('type', $tabToType[$tab]);
        }

        $propertyType = $request->input('property_type');
        if (is_numeric($propertyType)) {
            $query->where('property_type_id', (int) $propertyType);
        }

        $location = $request->input('location');
        if (is_string($location) && $location !== '' && ! in_array($location, ['All cities'], true)) {
            $query->where('city', $location);
        }

        $minPrice = $request->input('price_min');
        $maxPrice = $request->input('price_max');
        if (is_numeric($minPrice) && is_numeric($maxPrice)) {
            $query->whereBetween('price', [(float) $minPrice, (float) $maxPrice]);
        } elseif (is_numeric($minPrice)) {
            $query->where('price', '>=', (float) $minPrice);
        } elseif (is_numeric($maxPrice)) {
            $query->where('price', '<=', (float) $maxPrice);
        }

        $properties = $query->with(['category', 'type', 'images', 'broker'])
            ->paginate(9)
            ->appends($request->except('_token'));

        return view('properties.index', compact('properties'));
    }

    public function propertiesByCategory($id)
    {
        $properties = Property::with(['category', 'type', 'images', 'broker'])
            ->where('category_id', $id)
            ->whereNotIn('status', ['pending', 'off_market'])
            ->latest()
            ->paginate(9); // لو عايز pagination

        return view('properties.index', compact('properties'));
    }

    /**
     * Show single property details page.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function propertyDetails($id)
    {
        $property = Property::with(['images', 'broker', 'category', 'type'])
            ->whereNotIn('status', ['pending', 'off_market'])
            ->findOrFail($id);

        $related = Property::with('images')
            ->where('category_id', $property->category_id)
            ->where('id', '!=', $property->id)
            ->whereNotIn('status', ['pending', 'off_market'])
            ->latest()
            ->take(4)
            ->get();
        return view('properties.property-details', compact('property', 'related'));
    }

    /**
     * Show blog details page.
     * Accepts either slug or id.
     */
    public function blogDetails($slugOrId)
    {
        $post = Blog::with(['author'])->where('slug', $slugOrId)->orWhere('id', $slugOrId)->first();

        if (! $post) {
            abort(404);
        }

        $relatedPosts = Blog::where('author_id', $post->author_id)
            ->where('id', '!=', $post->id)
            ->latest()
            ->take(4)
            ->get();

        return view('blogs.blog-details', compact('post', 'relatedPosts'));
    }
    public function contactUs()
    {
        return view('contacts.index');
    }
    public function sendContactMessage(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Store the message in the database
        \App\Models\Message::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }   
        public function blogs(){
        $blogs = Blog::where('status', 'published')->paginate(10);
        return view('blogs.index', compact('blogs'));
    }
}
