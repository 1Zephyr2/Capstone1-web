<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class CustomerRegisterController extends Controller
{
    /**
     * Display the registration view.
     */
    public function show(): View
    {
        return view('auth.customer-register');
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['required', 'regex:/^(09\d{9}|09\d{2}-\d{3}-\d{4})$/'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Normalize phone: remove hyphens for storage
        $validated['phone'] = preg_replace('/\D/', '', $validated['phone']);
        
        // Auto-generate username from email (first part before @)
        $validated['username'] = explode('@', $validated['email'])[0];
        
        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = 'customer';

        $user = User::create($validated);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('customer.dashboard');
    }
}

