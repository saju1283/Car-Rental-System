<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\RentalConfirmation;
use App\Mail\AdminRentalNotification;
use Carbon\Carbon;

class RentalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
 * Display a listing of the user's rentals.
 *
 * @return \Illuminate\View\View
 * @throws \Illuminate\Auth\Access\AuthorizationException
 */
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        $rentals = $user->rentals()
            ->with(['car' => function($query) {
                //$query->withTrashed();
            }])
            ->latest()
            ->paginate(10);

        return view('frontend.rentals.index', compact('rentals'));
    }

    public function create(Car $car)
    {
        return view('frontend.rentals.create', compact('car'));
    }

    public function store(Request $request, Car $car)
    {
        $validated = $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            '_token' => 'required'
        ]);

        // Check car availability
        if (!$this->isCarAvailable($car, $validated['start_date'], $validated['end_date'])) {
            return back()->with('error', 'This car is not available for the selected dates.');
        }

        try {
            // Calculate rental details
            $days = Carbon::parse($validated['start_date'])->diffInDays(
                Carbon::parse($validated['end_date'])
            ) + 1;
            $totalCost = $days * $car->daily_rent_price;

            // Create rental record
            $rental = Rental::create([
                'user_id' => Auth::id(),
                'car_id' => $car->id,
                'start_date' => $validated['start_date'],
                'end_date' => $validated['end_date'],
                'total_cost' => $totalCost,
                'status' => 'pending',
            ]);

            // Send confirmation emails
            $this->sendConfirmationEmails($rental);

            return redirect()
                ->route('frontend.rentals.index')
                ->with('success', 'Booking confirmed! Check your email for details.');

        } catch (\Exception $e) {
            Log::error('Rental creation failed: ' . $e->getMessage());
            return back()
                ->with('error', 'Failed to complete booking. Please try again.')
                ->withInput();
        }
    }

    protected function isCarAvailable(Car $car, $startDate, $endDate): bool
    {
        return !Rental::where('car_id', $car->id)
            ->where(function($query) use ($startDate, $endDate) {
                $query->whereBetween('start_date', [$startDate, $endDate])
                    ->orWhereBetween('end_date', [$startDate, $endDate])
                    ->orWhere(function($q) use ($startDate, $endDate) {
                        $q->where('start_date', '<=', $startDate)
                            ->where('end_date', '>=', $endDate);
                    });
            })
            ->whereIn('status', ['pending', 'ongoing'])
            ->exists();
    }

    protected function sendConfirmationEmails(Rental $rental): void
    {
        try {
            
            // Send to customer
            if (Auth::user()->email) {
                Mail::to(Auth::user()->email)
                    ->send(new RentalConfirmation($rental));
            }

            // Send to admin
            $adminEmail = config('mail.admin_address');
            if ($adminEmail) {
                Mail::to($adminEmail)
                    ->send(new AdminRentalNotification($rental));
            }
        } catch (\Exception $e) {
            Log::error('Email sending failed: ' . $e->getMessage());
        }
    }

    public function cancel(Rental $rental)
    {
        $this->authorize('cancel', $rental);

        if ($rental->status !== 'pending') {
            return back()->with('error', 'You can only cancel pending rentals.');
        }

        $rental->update(['status' => 'canceled']);
        
        return back()->with('success', 'Rental canceled successfully!');
    }
}