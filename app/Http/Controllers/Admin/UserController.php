<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::query()
            ->when($request->search, function ($q) use ($request) {
                $term = $request->search;
                $q->where(function ($inner) use ($term) {
                    $inner->where('name', 'like', "%{$term}%")
                        ->orWhere('email', 'like', "%{$term}%");
                });
            })
            ->when($request->role, fn($q) => $q->where('role', $request->role))
            ->orderByDesc('created_at')
            ->paginate(10)
            ->appends($request->query());

        $roles = [
            User::ROLE_ADMIN => 'Admin',
            User::ROLE_BROKER => 'Broker',
            User::ROLE_USER => 'User',
        ];

        return view('admin.users.index', compact('users', 'roles'));
    }

    public function create()
    {
        $roles = [
            User::ROLE_ADMIN => 'Admin',
            User::ROLE_BROKER => 'Broker',
            User::ROLE_USER => 'User',
        ];

        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'name_ar' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', Rule::in([User::ROLE_ADMIN, User::ROLE_BROKER, User::ROLE_USER])],
        ]);

        User::create($validated);

        return redirect()->route('admin.users.index', ['locale' => app()->getLocale()])->with('success', 'User created successfully.');
    }

    public function edit($locale, $id)
    {
        $user = User::findOrFail($id);
        $roles = [
            User::ROLE_ADMIN => 'Admin',
            User::ROLE_BROKER => 'Broker',
            User::ROLE_USER => 'User',
        ];

        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $locale, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:8'],
            'role' => ['required', Rule::in([User::ROLE_ADMIN, User::ROLE_BROKER, User::ROLE_USER])],
        ]);

        if (empty($validated['password'])) {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('admin.users.index', ['locale' => app()->getLocale()])->with('success', 'User updated successfully.');
    }

    public function destroy($locale, $id)
    {
        $user = User::findOrFail($id);

        if (auth()->id() === $user->id) {
            return redirect()->back()->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()->route('admin.users.index', ['locale' => app()->getLocale()])->with('success', 'User deleted successfully.');
    }
}

