<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Appointment;
use App\Models\Visit;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class CustomerDashboardController extends Controller
{
    /**
     * Stable key to identify duplicate records of the same pet.
     */
    private function petSignature(Patient $pet): string
    {
        $petName = strtolower(trim((string) ($pet->pet_name ?? '')));
        $species = strtolower(trim((string) ($pet->species ?? '')));
        $breed = strtolower(trim((string) ($pet->breed ?? '')));
        $birthdate = $pet->birthdate ? $pet->birthdate->format('Y-m-d') : '';
        $sex = strtolower(trim((string) ($pet->sex ?? '')));

        return implode('|', [$petName, $species, $breed, $birthdate, $sex]);
    }

    /**
     * Build query for pets accessible to the customer.
     */
    private function customerPetsQuery(User $user): Builder
    {
        $phoneDigits = preg_replace('/\D/', '', (string) ($user->phone ?? ''));

        return Patient::query()->where(function ($query) use ($user, $phoneDigits) {
            $query->where('owner_name', $user->name)
                ->orWhere('owner_contact', $user->email);

            if (!empty($phoneDigits)) {
                $query->orWhere('owner_contact', $phoneDigits)
                    ->orWhere('owner_contact', substr($phoneDigits, 0, 4) . '-' . substr($phoneDigits, 4, 3) . '-' . substr($phoneDigits, 7, 4));
            }

            // Customer-created records should also be directly visible.
            $query->orWhere('user_id', $user->id);
        });
    }

    /**
     * Pick the best representative row among duplicate pet records.
     */
    private function pickPreferredPet(Collection $pets): ?Patient
    {
        if ($pets->isEmpty()) {
            return null;
        }

        return $pets
            ->sortByDesc(function (Patient $pet) {
                $hasPhoto = !empty($pet->pet_photo_path) ? 100000 : 0;
                $hasContact = !empty($pet->owner_contact) ? 10000 : 0;
                return $hasPhoto + $hasContact + (int) $pet->id;
            })
            ->first();
    }

    /**
     * Collapse duplicate pet records (legacy duplicates) for customer display.
     */
    private function deduplicatePets(Collection $pets): Collection
    {
        return $pets
            ->groupBy(function (Patient $pet) {
                return $this->petSignature($pet);
            })
            ->map(function (Collection $group) {
                return $this->pickPreferredPet($group);
            })
            ->filter()
            ->values();
    }

    /**
     * Check whether the authenticated customer owns the given pet record.
     */
    private function customerOwnsPet(User $user, Patient $pet): bool
    {
        $phoneDigits = preg_replace('/\D/', '', (string) ($user->phone ?? ''));
        $petContactDigits = preg_replace('/\D/', '', (string) ($pet->owner_contact ?? ''));

        return $pet->user_id === $user->id
            || $pet->owner_name === $user->name
            || $pet->owner_contact === $user->email
            || (!empty($phoneDigits) && $petContactDigits === $phoneDigits);
    }

    /**
     * Show the customer dashboard
     */
    public function dashboard(): View
    {
        $user = Auth::user();

        $allMatchedPets = $this->customerPetsQuery($user)->get();
        $pets = $this->deduplicatePets($allMatchedPets);
        
        // Get upcoming appointments (exclude completed)
        $appointments = Appointment::whereIn('patient_id', $allMatchedPets->pluck('id'))
            ->where('appointment_date', '>=', now())
            ->where('status', '!=', 'completed')
            ->orderBy('appointment_date')
            ->limit(5)
            ->get();
        
        return view('customer.dashboard', [
            'pets' => $pets,
            'appointments' => $appointments,
        ]);
    }

    /**
     * Show customer's pets list
     */
    public function pets(): View
    {
        $user = Auth::user();

        $pets = $this->deduplicatePets($this->customerPetsQuery($user)->get());
        
        return view('customer.pets.index', [
            'pets' => $pets,
        ]);
    }

    /**
     * Show a specific pet and its records
     */
    public function showPet(Patient $patient): View
    {
        // Verify customer owns this pet
        $user = Auth::user();
        if (!$this->customerOwnsPet($user, $patient)) {
            abort(403);
        }

        $allCustomerPets = $this->customerPetsQuery($user)->get();
        $signature = $this->petSignature($patient);
        $matchingPets = $allCustomerPets
            ->filter(function (Patient $pet) use ($signature) {
                return $this->petSignature($pet) === $signature;
            })
            ->values();

        if ($matchingPets->isEmpty()) {
            $matchingPets = collect([$patient]);
        }

        $primaryPet = $this->pickPreferredPet($matchingPets) ?? $patient;
        $matchingPetIds = $matchingPets->pluck('id')->values();

        $visits = Visit::with('photos')
            ->whereIn('patient_id', $matchingPetIds)
            ->orderBy('visit_date', 'desc')
            ->orderBy('visit_time', 'desc')
            ->get();

        $appointments = Appointment::whereIn('patient_id', $matchingPetIds)
            ->where('appointment_date', '>=', now())
            ->where('status', '!=', 'completed')
            ->orderBy('appointment_date')
            ->get();

        if (empty($primaryPet->pet_photo_path)) {
            $alternatePhotoPet = $matchingPets->first(function (Patient $pet) {
                return !empty($pet->pet_photo_path);
            });

            if ($alternatePhotoPet) {
                $primaryPet->pet_photo_path = $alternatePhotoPet->pet_photo_path;
            }
        }

        $primaryPet->setRelation('visits', $visits);
        $primaryPet->setRelation('appointments', $appointments);
        
        return view('customer.pets.show', [
            'pet' => $primaryPet,
        ]);
    }

    /**
     * Show customer's appointments
     */
    public function appointments(): View
    {
        $user = Auth::user();

        $matchedPets = $this->customerPetsQuery($user)->get();
        
        $appointments = Appointment::whereIn('patient_id', $matchedPets->pluck('id'))
            ->where('status', '!=', 'completed')
            ->orderBy('appointment_date', 'desc')
            ->paginate(15);
        
        return view('customer.appointments.index', [
            'appointments' => $appointments,
        ]);
    }

    /**
     * Show a specific appointment details
     */
    public function showAppointment(Appointment $appointment): View
    {
        // Verify customer has access
        $user = Auth::user();
        $pet = $appointment->patient;

        if (!$this->customerOwnsPet($user, $pet)) {
            abort(403);
        }
        
        return view('customer.appointments.show', [
            'appointment' => $appointment,
            'pet' => $pet,
        ]);
    }
}
