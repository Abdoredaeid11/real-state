<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::query()->where('status', 'active');

        if ($request->filled('q')) {
            $term = $request->q;
            $query->where(function ($q) use ($term) {
                $q->where('name', 'like', "%{$term}%")
                    ->orWhere('name_ar', 'like', "%{$term}%")
                    ->orWhere('city', 'like', "%{$term}%")
                    ->orWhere('city_ar', 'like', "%{$term}%")
                    ->orWhere('developer', 'like', "%{$term}%");
            });
        }

        if ($request->filled('price_min')) {
            $query->where('starting_price', '>=', $request->price_min);
        }

        if ($request->filled('price_max')) {
            $query->where('starting_price', '<=', $request->price_max);
        }

        if ($request->filled('price_range')) {
            $range = explode('-', $request->price_range);
            $min = $range[0] ?? null;
            $max = $range[1] ?? null;

            if ($min !== null && $min !== '' && $min !== '0') {
                $query->where('starting_price', '>=', (float) $min);
            }

            if ($max !== null && $max !== '' && $max !== '0') {
                $query->where('starting_price', '<=', (float) $max);
            }
        }

        if ($request->filled('location')) {
            $location = $request->location;
            $query->where(function ($q) use ($location) {
                $q->where('city', 'like', "%{$location}%")
                    ->orWhere('city_ar', 'like', "%{$location}%");
            });
        }

        if ($request->filled('delivery_year')) {
            $query->where('delivery_year', $request->delivery_year);
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $sort = $request->get('sort');

        if ($sort === 'price_asc') {
            $query->orderBy('starting_price', 'asc');
        } elseif ($sort === 'price_desc') {
            $query->orderBy('starting_price', 'desc');
        } elseif ($sort === 'delivery_nearest') {
            $query->orderBy('delivery_year', 'asc')->orderBy('starting_price', 'asc');
        } else {
            $query->orderByDesc('created_at');
        }

        $projects = $query->with('images')->paginate(12)->appends($request->query());

        $locations = Project::whereNotNull('city')
            ->where('city', '!=', '')
            ->distinct()
            ->orderBy('city')
            ->pluck('city');

        $deliveryYears = Project::whereNotNull('delivery_year')
            ->distinct()
            ->orderBy('delivery_year')
            ->pluck('delivery_year');

        return view('projects.index', compact('projects', 'locations', 'deliveryYears'));
    }

    public function show($idOrSlug)
    {
        $project = Project::with(['images'])
            ->where('slug', $idOrSlug)
            ->orWhere('id', $idOrSlug)
            ->firstOrFail();

        $similarProjects = Project::with('images')
            ->where('status', 'active')
            ->where('id', '!=', $project->id)
            ->when($project->city, function ($q) use ($project) {
                $q->where('city', $project->city);
            })
            ->orderBy('starting_price')
            ->limit(3)
            ->get();

        return view('projects.show', compact('project', 'similarProjects'));
    }

    public function autocomplete(Request $request)
    {
        $term = $request->query('q');

        $query = Project::query();

        if ($term) {
            $query->where(function ($q) use ($term) {
                $q->where('name', 'like', "%{$term}%")
                    ->orWhere('name_ar', 'like', "%{$term}%")
                    ->orWhere('city', 'like', "%{$term}%")
                    ->orWhere('city_ar', 'like', "%{$term}%")
                    ->orWhere('developer', 'like', "%{$term}%");
            });
        }

        $results = $query
            ->orderBy('name')
            ->limit(10)
            ->get(['id', 'name', 'name_ar', 'city', 'city_ar', 'type', 'slug']);

        return response()->json([
            'data' => $results->map(function (Project $project) {
                return [
                    'id' => $project->id,
                    'name' => $project->name,
                    'name_ar' => $project->name_ar,
                    'city' => $project->city,
                    'city_ar' => $project->city_ar,
                    'type' => $project->type,
                    'url' => route('projects.show', $project->slug ?: $project->id),
                ];
            }),
        ]);
    }
}
