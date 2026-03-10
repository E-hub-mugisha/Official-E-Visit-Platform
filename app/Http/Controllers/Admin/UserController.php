<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $users = User::latest()->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:users',
            'national_id' => 'nullable|string|unique:users',
            'phone'       => 'nullable|string|max:20',
            'role'        => 'required|in:super_admin,admin,guard,visitor',
            'password'    => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'national_id' => $request->national_id,
            'phone'       => $request->phone,
            'role'        => $request->role,
            'is_active'   => true,
            'password'    => Hash::make($request->password),
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User created successfully.');
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:users,email,' . $user->id,
            'national_id' => 'nullable|string|unique:users,national_id,' . $user->id,
            'phone'       => 'nullable|string|max:20',
            'role'        => 'required|in:super_admin,admin,guard,visitor',
            'is_active'   => 'boolean',
        ]);

        $user->update([
            'name'        => $request->name,
            'email'       => $request->email,
            'national_id' => $request->national_id,
            'phone'       => $request->phone,
            'role'        => $request->role,
            'is_active'   => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully.');
    }

    public function toggleStatus(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot deactivate your own account.');
        }

        $user->update(['is_active' => !$user->is_active]);

        $status = $user->is_active ? 'activated' : 'deactivated';

        return back()->with('success', "User {$status} successfully.");
    }

    public function resetPassword(Request $request, User $user)
    {
        $request->validate([
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user->update(['password' => Hash::make($request->new_password)]);

        return back()->with('success', 'Password reset successfully.');
    }
}