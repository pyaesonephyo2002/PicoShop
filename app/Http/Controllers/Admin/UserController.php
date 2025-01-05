<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller 
{
    public function index()
    {
        $users = User::whereNull('deleted_at')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    // Display the form for creating a new user
    public function create()
    {
        return view('admin.users.create');
    }

    // Store the newly created user in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|numeric',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:admin,user',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        
        try {
            $profilePath = null;
            if ($request->hasFile('profile_image')) {
                $profilePath = $request->file('profile_image')->store('profiles', 'public');
            }
        
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'role' => $request->role,
                'password' => bcrypt($request->password),
                'profile' => $profilePath,
            ]);
        
            return redirect()->route('backend.users.index')->with('success', 'User created successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to create user: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to create user. Please try again.');
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->route('backend.users.index')->with('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to delete user: ' . $e->getMessage());
            return redirect()->route('backend.users.index')->with('error', 'Failed to delete user. Please try again.');
        }
    }
}
