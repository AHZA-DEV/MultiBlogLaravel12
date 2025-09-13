<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('admin-access');
        $users = User::paginate(10);
        return view('dashboard.users.index', compact('users'));
    }

    public function create()
    {
        $this->authorize('admin-access');
        return view('dashboard.users.create');
    }

    public function store(Request $request)
    {
        $this->authorize('admin-access');
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,user',
            'status' => 'required|in:active,inactive',
            'bio' => 'nullable|string|max:1000',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status' => $request->status,
            'bio' => $request->bio,
        ]);

        return redirect()->route('dashboard.users')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        $this->authorize('admin-access');
        return view('dashboard.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $this->authorize('admin-access');
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:admin,user',
            'status' => 'required|in:active,inactive',
            'bio' => 'nullable|string|max:1000',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'status' => $request->status,
            'bio' => $request->bio,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('dashboard.users')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $this->authorize('admin-access');
        
        if ($user->id === Auth::id()) {
            return redirect()->route('dashboard.users')->with('error', 'You cannot delete yourself.');
        }

        $user->delete();
        return redirect()->route('dashboard.users')->with('success', 'User deleted successfully.');
    }
}
