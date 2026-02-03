<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $q = Blog::query();
        if ($search = $request->get('search')) {
            $q->where(function ($w) use ($search) {
                $w->where('title', 'like', "%{$search}%")
                  ->orWhere('title_ar', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%");
            });
        }
        if ($status = $request->get('status')) {
            $q->where('status', $status);
        }
        $blogs = $q->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->paginate(10)
            ->appends($request->query());

        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view('admin.blogs.create');
    }

    public function store(Request $request, $locale)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'title_ar' => ['nullable', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:blogs,slug'],
            'content' => ['nullable', 'string'],
            'content_ar' => ['nullable', 'string'],
            'status' => ['required', 'in:draft,published'],
            'image' => ['nullable', 'image', 'max:4096'],
            'published_at' => ['nullable', 'date'],
        ]);

        $blog = new Blog();
        $blog->title = $data['title'];
        $blog->title_ar = $data['title_ar'] ?? null;
        $blog->slug = $data['slug'] ?? Str::slug($data['title']) . '-' . Str::random(6);
        $blog->content = $data['content'] ?? null;
        $blog->content_ar = $data['content_ar'] ?? null;
        $blog->status = $data['status'];
        $blog->published_at = $data['published_at'] ?? ($data['status'] === 'published' ? now() : null);
        $blog->author_id = auth()->id();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('blogs', 'public');
            $blog->image = $path;
        }

        $blog->save();

        return redirect()->route('admin.blogs.index', $locale)->with('success', __('admin.general.save'));
    }

    public function edit($locale, $id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blogs.edit', compact('blog'));
    }

    public function update(Request $request, $locale, $id)
    {
        $blog = Blog::findOrFail($id);
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'title_ar' => ['nullable', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:blogs,slug,' . $blog->id],
            'content' => ['nullable', 'string'],
            'content_ar' => ['nullable', 'string'],
            'status' => ['required', 'in:draft,published'],
            'image' => ['nullable', 'image', 'max:4096'],
            'published_at' => ['nullable', 'date'],
        ]);

        $blog->title = $data['title'];
        $blog->title_ar = $data['title_ar'] ?? null;
        $blog->slug = $data['slug'] ?? $blog->slug;
        $blog->content = $data['content'] ?? null;
        $blog->content_ar = $data['content_ar'] ?? null;
        $blog->status = $data['status'];
        $blog->published_at = $data['published_at'] ?? ($data['status'] === 'published' ? ($blog->published_at ?? now()) : null);

        if ($request->hasFile('image')) {
            if ($blog->image && Storage::disk('public')->exists($blog->image)) {
                Storage::disk('public')->delete($blog->image);
            }
            $path = $request->file('image')->store('blogs', 'public');
            $blog->image = $path;
        }

        $blog->save();

        return redirect()->route('admin.blogs.index', $locale)->with('success', __('admin.general.edit'));
    }

    public function destroy($locale, $id)
    {
        $blog = Blog::findOrFail($id);
        if ($blog->image && Storage::disk('public')->exists($blog->image)) {
            Storage::disk('public')->delete($blog->image);
        }
        $blog->delete();
        return redirect()->route('admin.blogs.index', $locale)->with('success', __('admin.general.delete'));
    }
}

