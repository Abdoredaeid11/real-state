<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $projects = Project::query()
            ->when($request->search, function ($q) use ($request) {
                $term = $request->search;
                $q->where(function ($inner) use ($term) {
                    $inner->where('name', 'like', "%{$term}%")
                        ->orWhere('name_ar', 'like', "%{$term}%")
                        ->orWhere('developer', 'like', "%{$term}%")
                        ->orWhere('city', 'like', "%{$term}%")
                        ->orWhere('city_ar', 'like', "%{$term}%");
                });
            })
            ->when($request->type, fn($q) => $q->where('type', $request->type))
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->orderByDesc('created_at')
            ->paginate(10)
            ->appends($request->query());

        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'name_ar' => ['nullable', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:projects,slug'],
            'type' => ['required', Rule::in(['compound', 'property'])],
            'developer' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'city_ar' => ['nullable', 'string', 'max:255'],
            'location_text' => ['nullable', 'string', 'max:255'],
            'starting_price' => ['nullable', 'numeric', 'min:0'],
            'price_currency' => ['nullable', 'string', 'max:10'],
            'installments_up_to' => ['nullable', 'integer', 'min:1', 'max:50'],
            'min_bedrooms' => ['nullable', 'integer', 'min:0'],
            'max_bedrooms' => ['nullable', 'integer', 'min:0'],
            'delivery_year' => ['nullable', 'integer', 'min:1900', 'max:2100'],
            'short_description' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'description_ar' => ['nullable', 'string'],
            'status' => ['required', Rule::in(['active', 'inactive'])],
            'main_image_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:4096'],
            'gallery_images' => ['nullable', 'array'],
            'gallery_images.*' => ['image', 'mimes:jpeg,png,jpg,webp', 'max:4096'],
        ]);

        if ($request->hasFile('main_image_file')) {
            $path = $request->file('main_image_file')->store('projects/main', 'public');
            $validated['main_image'] = $path;
        }

        $project = Project::create($validated);

        if ($request->hasFile('gallery_images')) {
            $order = 0;
            foreach ($request->file('gallery_images') as $image) {
                $path = $image->store('projects/gallery', 'public');
                ProjectImage::create([
                    'project_id' => $project->id,
                    'image' => $path,
                    'is_main' => false,
                    'sort_order' => $order++,
                ]);
            }
        }

        return redirect()
            ->route('admin.projects.index', ['locale' => app()->getLocale()])
            ->with('success', 'Project created successfully.');
    }

    public function edit($locale, $id)
    {
        $project = Project::with('images')->findOrFail($id);

        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, $locale, $id)
    {
        $project = Project::with('images')->findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'name_ar' => ['nullable', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:projects,slug,' . $project->id],
            'type' => ['required', Rule::in(['compound', 'property'])],
            'developer' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'city_ar' => ['nullable', 'string', 'max:255'],
            'location_text' => ['nullable', 'string', 'max:255'],
            'starting_price' => ['nullable', 'numeric', 'min:0'],
            'price_currency' => ['nullable', 'string', 'max:10'],
            'installments_up_to' => ['nullable', 'integer', 'min:1', 'max:50'],
            'min_bedrooms' => ['nullable', 'integer', 'min:0'],
            'max_bedrooms' => ['nullable', 'integer', 'min:0'],
            'delivery_year' => ['nullable', 'integer', 'min:1900', 'max:2100'],
            'short_description' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'description_ar' => ['nullable', 'string'],
            'status' => ['required', Rule::in(['active', 'inactive'])],
            'main_image_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:4096'],
            'gallery_images' => ['nullable', 'array'],
            'gallery_images.*' => ['image', 'mimes:jpeg,png,jpg,webp', 'max:4096'],
            'remove_images' => ['nullable', 'array'],
            'remove_images.*' => ['integer', 'exists:project_images,id'],
            'main_image_id' => ['nullable', 'integer', 'exists:project_images,id'],
            'image_sort' => ['nullable', 'array'],
        ]);

        if ($request->hasFile('main_image_file')) {
            if ($project->main_image && Storage::disk('public')->exists($project->main_image)) {
                Storage::disk('public')->delete($project->main_image);
            }
            $path = $request->file('main_image_file')->store('projects/main', 'public');
            $validated['main_image'] = $path;
        }

        $project->update($validated);

        $removeImages = $request->input('remove_images', []);
        if (!empty($removeImages)) {
            $imagesToDelete = $project->images()->whereIn('id', $removeImages)->get();
            foreach ($imagesToDelete as $image) {
                if (Storage::disk('public')->exists($image->image)) {
                    Storage::disk('public')->delete($image->image);
                }
                $image->delete();
            }
        }

        if ($request->hasFile('gallery_images')) {
            $maxOrder = (int) $project->images()->max('sort_order');
            $order = $maxOrder + 1;
            foreach ($request->file('gallery_images') as $image) {
                $path = $image->store('projects/gallery', 'public');
                ProjectImage::create([
                    'project_id' => $project->id,
                    'image' => $path,
                    'is_main' => false,
                    'sort_order' => $order++,
                ]);
            }
        }

        $sortData = $request->input('image_sort', []);
        if (!empty($sortData)) {
            foreach ($sortData as $imageId => $sortOrder) {
                $image = $project->images->firstWhere('id', (int) $imageId);
                if ($image) {
                    $image->sort_order = (int) $sortOrder;
                    $image->save();
                }
            }
        }

        if ($request->filled('main_image_id')) {
            $mainId = (int) $request->input('main_image_id');
            $project->images()->update(['is_main' => false]);
            $image = $project->images()->where('id', $mainId)->first();
            if ($image) {
                $image->is_main = true;
                $image->save();
            }
        }

        return redirect()
            ->route('admin.projects.index', ['locale' => app()->getLocale()])
            ->with('success', 'Project updated successfully.');
    }

    public function destroy($locale, $id)
    {
        $project = Project::with('images')->findOrFail($id);

        if ($project->main_image && Storage::disk('public')->exists($project->main_image)) {
            Storage::disk('public')->delete($project->main_image);
        }

        foreach ($project->images as $image) {
            if (Storage::disk('public')->exists($image->image)) {
                Storage::disk('public')->delete($image->image);
            }
        }

        $project->delete();

        return redirect()
            ->route('admin.projects.index', ['locale' => app()->getLocale()])
            ->with('success', 'Project deleted successfully.');
    }
}
