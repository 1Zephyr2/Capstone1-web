<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Patient;
use App\Models\Visit;
use App\Models\Appointment;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class AdminController extends Controller
{
    /**
     * Build a stable identity key for customer-account deduplication.
     */
    private function customerIdentityKey(User $user): string
    {
        $email = strtolower(trim((string) ($user->email ?? '')));
        if (!empty($email)) {
            return 'email:' . $email;
        }

        $phone = preg_replace('/\D/', '', (string) ($user->phone ?? ''));
        if (!empty($phone)) {
            return 'phone:' . $phone;
        }

        $name = strtolower(trim((string) ($user->name ?? '')));
        $username = strtolower(trim((string) ($user->username ?? '')));
        return 'fallback:' . $name . '|' . $username;
    }

    /**
     * Collapse duplicate customer rows for cleaner admin display.
     */
    private function deduplicateCustomers(Collection $customers): Collection
    {
        return $customers
            ->groupBy(function (User $user) {
                return $this->customerIdentityKey($user);
            })
            ->map(function (Collection $group) {
                return $group->sortByDesc('created_at')->first();
            })
            ->sortByDesc('created_at')
            ->values();
    }

    /**
     * Display the admin dashboard with anonymized statistics
     */
    public function dashboard()
    {
        // Get anonymized statistics (DPA compliant - no patient names/details)
        $stats = [
            'total_patients' => Patient::count(),
            'total_visits_this_month' => Visit::whereMonth('visit_date', now()->month)
                                              ->whereYear('visit_date', now()->year)
                                              ->count(),
            'total_appointments_today' => Appointment::whereDate('appointment_date', today())->count(),
            'total_users' => User::count(),
            'admin_count' => User::where('role', 'admin')->count(),
            'staff_count' => User::where('role', 'staff')->count(),
        ];

        // Get recent activity counts by date (anonymized)
        $recentVisits = Visit::selectRaw('DATE(visit_date) as date, COUNT(*) as count')
            ->where('visit_date', '>=', now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->get();

        return view('admin.dashboard', compact('stats', 'recentVisits'));
    }

    /**
     * Display user management page
     */
    public function users()
    {
        $activeTab = request('tab', 'staff');
        if (!in_array($activeTab, ['staff', 'pet_owners'], true)) {
            $activeTab = 'staff';
        }

        $staffCount = User::whereIn('role', ['admin', 'staff'])->count();

        if ($activeTab === 'staff') {
            $users = User::whereIn('role', ['admin', 'staff'])
                ->orderBy('created_at', 'desc')
                ->paginate(15)
                ->appends(['tab' => $activeTab]);

            $petOwnerCount = User::where('role', 'customer')->count();
        } else {
            $deduplicatedCustomers = $this->deduplicateCustomers(
                User::where('role', 'customer')->orderBy('created_at', 'desc')->get()
            );

            $petOwnerCount = $deduplicatedCustomers->count();

            $perPage = 15;
            $page = max((int) request('page', 1), 1);
            $items = $deduplicatedCustomers->forPage($page, $perPage)->values();

            $users = new LengthAwarePaginator(
                $items,
                $petOwnerCount,
                $perPage,
                $page,
                [
                    'path' => request()->url(),
                    'query' => request()->query(),
                ]
            );
        }

        return view('admin.users.index', compact('users', 'activeTab', 'staffCount', 'petOwnerCount'));
    }

    /**
     * Show form to create a new user
     */
    public function createUser()
    {
        return view('admin.users.create');
    }

    /**
     * Store a new user
     */
    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['nullable', 'regex:/^(09\d{9}|09\d{2}-\d{3}-\d{4})$/'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:admin,staff'],
        ]);

        // Normalize phone: remove hyphens for storage
        if ($validated['phone']) {
            $validated['phone'] = preg_replace('/\D/', '', $validated['phone']);
        }

        User::create([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Show form to edit a user
     */
    public function editUser(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update a user
     */
    public function updateUser(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $user->id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'phone' => ['nullable', 'regex:/^(09\d{9}|09\d{2}-\d{3}-\d{4})$/'],
            'role' => ['required', 'in:admin,staff'],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        // Normalize phone: remove hyphens for storage
        if ($validated['phone']) {
            $validated['phone'] = preg_replace('/\D/', '', $validated['phone']);
        }

        // Prevent users from changing their own role
        if ($user->id === Auth::id()) {
            $validated['role'] = $user->role;
        }

        $user->update([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'role' => $validated['role'],
        ]);

        if (!empty($validated['password'])) {
            $user->update(['password' => Hash::make($validated['password'])]);
        }

        return redirect()->route('admin.users.index')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Delete a user
     */
    public function destroyUser(User $user)
    {
        // Prevent deleting yourself
        if ($user->id === Auth::id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully.');
    }

    /**
     * Display system settings
     */
    public function settings()
    {
        return view('admin.settings');
    }
}
