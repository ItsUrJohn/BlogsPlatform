<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $incomingFields = $request->validate([
            'loginname' => 'required',
            'loginpassword' => 'required',
        ]);

        if (auth()->attempt(['name' => $incomingFields['loginname'], 'password' => $incomingFields['loginpassword']])) {
            $request->session()->regenerate();

            // Check if user is admin
            if (auth()->user()->email === 'admin@blogplatform.com') {
                return redirect('/admin/dashboard');
            }

            return redirect('/dashboard');
        }

        return back()->withErrors([
            'loginname' => 'The provided credentials do not match our records.',
        ])->onlyInput('loginname');
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'You have been logged out successfully.');
    }

    // ONLY ONE register METHOD - KEEP THIS ONE
    public function register(Request $request)
    {
        $incomingFields = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|string|min:8|max:200|confirmed',
        ]);

        $incomingFields['password'] = bcrypt($incomingFields['password']);
        $incomingFields['profile_picture'] = null;
        $user = User::create($incomingFields);

        auth()->login($user);

        // Check if new user is admin (shouldn't happen via registration)
        if ($user->email === 'admin@blogplatform.com') {
            return redirect('/admin/dashboard');
        }

        return redirect('/dashboard')->with('success', 'Registration successful! Welcome to BlogPlatform!');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with('success', 'Password changed successfully!');
    }

    public function updateProfilePicture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = auth()->user();

        if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        $path = $request->file('profile_picture')->store('profile-pictures', 'public');

        $user->update([
            'profile_picture' => $path
        ]);

        return back()->with('success', 'Profile picture updated successfully!');
    }

    public function removeProfilePicture()
    {
        $user = auth()->user();

        if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        $user->update([
            'profile_picture' => null
        ]);

        return back()->with('success', 'Profile picture removed successfully!');
    }

}