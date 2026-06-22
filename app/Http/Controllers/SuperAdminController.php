<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Patient;
use App\Models\Appointment;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;

class SuperAdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_admins'      => User::where('role', 'admin')->count(),
            'total_staff'       => User::where('role', 'staff')->count(),
            'total_customers'   => User::where('role', 'customer')->count(),
            'total_pets'        => Patient::count(),
            'total_appointments'=> Appointment::count(),
            'total_visits'      => Visit::count(),
        ];

        $recentAdmins = User::whereIn('role', ['admin', 'staff'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('super-admin.dashboard', compact('stats', 'recentAdmins'));
    }

    public function admins()
    {
        $users = User::whereIn('role', ['admin', 'staff'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('super-admin.admins.index', compact('users'));
    }

    public function createAdmin()
    {
        return view('super-admin.admins.create');
    }

    public function storeAdmin(Request $request)
    {
        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email'    => ['required', 'email', 'max:255', 'unique:users'],
            'phone'    => ['nullable', 'regex:/^(09\d{9}|09\d{2}-\d{3}-\d{4})$/'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role'     => ['required', 'in:admin,staff'],
        ]);

        if (!empty($validated['phone'])) {
            $validated['phone'] = preg_replace('/\D/', '', $validated['phone']);
        }

        User::create([
            'name'     => $validated['name'],
            'username' => $validated['username'],
            'email'    => $validated['email'],
            'phone'    => $validated['phone'] ?? null,
            'password' => Hash::make($validated['password']),
            'role'     => $validated['role'],
        ]);

        return redirect()->route('super-admin.admins.index')
            ->with('success', 'Account created successfully.');
    }

    public function editAdmin(User $user)
    {
        // Prevent editing another super admin
        if ($user->role === 'super_admin') {
            return redirect()->route('super-admin.admins.index')
                ->with('error', 'Super Admin accounts cannot be edited here.');
        }

        return view('super-admin.admins.edit', compact('user'));
    }

    public function updateAdmin(Request $request, User $user)
    {
        if ($user->role === 'super_admin') {
            abort(403);
        }

        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $user->id],
            'email'    => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'phone'    => ['nullable', 'regex:/^(09\d{9}|09\d{2}-\d{3}-\d{4})$/'],
            'role'     => ['required', 'in:admin,staff'],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        if (!empty($validated['phone'])) {
            $validated['phone'] = preg_replace('/\D/', '', $validated['phone']);
        }

        $user->update([
            'name'     => $validated['name'],
            'username' => $validated['username'],
            'email'    => $validated['email'],
            'phone'    => $validated['phone'] ?? null,
            'role'     => $validated['role'],
        ]);

        if (!empty($validated['password'])) {
            $user->update(['password' => Hash::make($validated['password'])]);
        }

        return redirect()->route('super-admin.admins.index')
            ->with('success', 'Account updated successfully.');
    }

    public function destroyAdmin(User $user)
    {
        if ($user->role === 'super_admin') {
            abort(403, 'Cannot delete Super Admin account.');
        }

        if ($user->id === Auth::id()) {
            return redirect()->route('super-admin.admins.index')
                ->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()->route('super-admin.admins.index')
            ->with('success', 'Account deleted successfully.');
    }

    public function auditLogs()
    {
        $logs = \App\Models\AuditLog::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(30);

        return view('super-admin.audit-logs', compact('logs'));
    }

    public function system()
    {
        $info = [
            'app_name'    => config('app.name'),
            'environment' => config('app.env'),
            'database'    => config('database.default'),
            'timezone'    => config('app.timezone'),
            'php_version' => PHP_VERSION,
            'laravel_ver' => app()->version(),
        ];

        return view('super-admin.system', compact('info'));
    }
}