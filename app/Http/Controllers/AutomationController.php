<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Visit;
use App\Models\Immunization;
use App\Models\BreedingRecord;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AutomationController extends Controller
{
    public function index()
    {
        // Detect incomplete patient records
        $incompleteRecords = Patient::whereNull('microchip_number')
            ->orWhereNull('owner_contact')
            ->limit(10)
            ->get();

        // Overdue immunizations (if any exist)
        $overdueImmunizations = Immunization::where('next_dose_date', '<', Carbon::now())
            ->whereNull('completed_at')
            ->with('patient')
            ->limit(10)
            ->get();

        // High-risk breeding patients
        $highRiskBreeding = BreedingRecord::where(function($query) {
            $query->whereNotNull('risk_factors')
                  ->orWhere('referred', true);
        })->with('patient')->limit(10)->get();

        // Recent visit summary
        $recentVisits = Visit::with('patient')
            ->orderBy('visit_date', 'desc')
            ->limit(5)
            ->get();

        // Quick stats
        $stats = [
            'total_patients' => Patient::count(),
            'visits_this_week' => Visit::where('visit_date', '>=', Carbon::now()->startOfWeek())->count(),
            'pending_immunizations' => Immunization::whereNull('completed_at')->count(),
            'active_breeding' => BreedingRecord::whereDate('created_at', '>=', Carbon::now()->subMonths(3))->count(),
        ];

        return view('automation-support', compact(
            'incompleteRecords',
            'overdueImmunizations',
            'highRiskBreeding',
            'recentVisits',
            'stats'
        ));
    }
}
