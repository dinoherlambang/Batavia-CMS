<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminAuthController extends Controller
{
    /**
     * Show the admin login form
     */
    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    /**
     * Handle admin login
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $user = Auth::user();
            
            // Check if user can access admin panel
            if (!$user->canAccessAdmin()) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'You do not have permission to access the admin panel.',
                ]);
            }

            // Update last login time
            $user->update(['last_login_at' => now()]);
            
            $request->session()->regenerate();
            
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Handle admin logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('admin.login');
    }

    /**
     * Show admin dashboard
     */
    public function dashboard()
    {
        $user = Auth::user();
        
        if (!$user->canAccessAdmin()) {
            return redirect()->route('admin.login');
        }

        $stats = [
            'users' => User::count(),
            'posts' => \DB::table('posts')->count(),
            'pages' => \DB::table('pages')->count(),
            'categories' => \DB::table('categories')->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}