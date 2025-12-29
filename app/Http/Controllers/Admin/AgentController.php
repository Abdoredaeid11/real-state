<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AgentController extends Controller
{
    public function index(Request $request)
    {
        $q = Agent::query();
        if ($search = $request->get('search')) {
            $q->where(function ($w) use ($search) {
                $w->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }
        if ($status = $request->get('status')) {
            $q->where('status', $status);
        }
        $agents = $q->orderBy('name')
            ->paginate(10)
            ->appends($request->query());

        return view('admin.agents.index', compact('agents'));
    }

    public function create()
    {
        return view('admin.agents.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255', 'unique:agents,email'],
            'phone' => ['nullable', 'string', 'max:50'],
            'bio' => ['nullable', 'string'],
            'status' => ['required', 'in:active,inactive'],
            'profile_image' => ['nullable', 'image', 'max:4096'],
            'facebook' => ['nullable', 'url'],
            'twitter' => ['nullable', 'url'],
            'instagram' => ['nullable', 'url'],
            'linkedin' => ['nullable', 'url'],
            'youtube' => ['nullable', 'url'],
        ]);

        $social = [
            'facebook' => $data['facebook'] ?? null,
            'twitter' => $data['twitter'] ?? null,
            'instagram' => $data['instagram'] ?? null,
            'linkedin' => $data['linkedin'] ?? null,
            'youtube' => $data['youtube'] ?? null,
        ];

        $agent = new Agent();
        $agent->name = $data['name'];
        $agent->email = $data['email'] ?? null;
        $agent->phone = $data['phone'] ?? null;
        $agent->bio = $data['bio'] ?? null;
        $agent->status = $data['status'];
        $agent->social_links = $social;

        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('agents', 'public');
            $agent->profile_image = $path;
        }

        $agent->save();

        return redirect()->route('admin.agents.index', app()->getLocale())
            ->with('success', __('admin.general.save'));
    }

    public function edit($locale, $id)
    {
        $agent = Agent::findOrFail($id);
        return view('admin.agents.edit', compact('agent'));
    }

    public function update(Request $request, $locale, $id)
    {
        $agent = Agent::findOrFail($id);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255', 'unique:agents,email,' . $agent->id],
            'phone' => ['nullable', 'string', 'max:50'],
            'bio' => ['nullable', 'string'],
            'status' => ['required', 'in:active,inactive'],
            'profile_image' => ['nullable', 'image', 'max:4096'],
            'facebook' => ['nullable', 'url'],
            'twitter' => ['nullable', 'url'],
            'instagram' => ['nullable', 'url'],
            'linkedin' => ['nullable', 'url'],
            'youtube' => ['nullable', 'url'],
        ]);

        $social = [
            'facebook' => $data['facebook'] ?? null,
            'twitter' => $data['twitter'] ?? null,
            'instagram' => $data['instagram'] ?? null,
            'linkedin' => $data['linkedin'] ?? null,
            'youtube' => $data['youtube'] ?? null,
        ];

        $agent->name = $data['name'];
        $agent->email = $data['email'] ?? null;
        $agent->phone = $data['phone'] ?? null;
        $agent->bio = $data['bio'] ?? null;
        $agent->status = $data['status'];
        $agent->social_links = $social;

        if ($request->hasFile('profile_image')) {
            if ($agent->profile_image && Storage::disk('public')->exists($agent->profile_image)) {
                Storage::disk('public')->delete($agent->profile_image);
            }
            $path = $request->file('profile_image')->store('agents', 'public');
            $agent->profile_image = $path;
        }

        $agent->save();

        return redirect()->route('admin.agents.index', $locale)
            ->with('success', __('admin.general.edit'));
    }

    public function destroy($locale, $id)
    {
        $agent = Agent::findOrFail($id);
        if ($agent->profile_image && Storage::disk('public')->exists($agent->profile_image)) {
            Storage::disk('public')->delete($agent->profile_image);
        }
        $agent->delete();

        return redirect()->route('admin.agents.index', $locale)
            ->with('success', __('admin.general.delete'));
    }
}

