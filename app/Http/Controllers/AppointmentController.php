<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppointmentRequest;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * Display appointments
     * Clients see only their appointments
     * Staff/Admin see all appointments
     */
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }

        // Client sees only their appointments
        if ($user->role->name === 'client') {
            /** @var \App\Models\User $user */
            $appointments = $user->appointments()->latest()->paginate(10);
        } else {
            // Staff/Admin see all appointments
            $appointments = Appointment::with('user')->latest()->paginate(15);
        }

        return view('appoinments.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new appointment
     */
    public function create()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }

        return view('appoinments.create');
    }

    /**
     * Store a new appointment (Client)
     * Uses StoreAppointmentRequest for validation
     */
    public function store(StoreAppointmentRequest $request)
    {
        $validated = $request->validated();
        $user = Auth::user();

        // Create the appointment with validated data
        $appointment = Appointment::create([
            'user_id' => $user->id,
            'appointment_date' => $validated['appointment_date'],
            'appointment_time' => $validated['appointment_time'],
            'status' => 'Pending',
        ]);

        return redirect()->route('appointments.index')->with('success', 'Appointment booked successfully! Your appointment ID is #' . $appointment->id);
    }

    /**
     * Show appointment details
     */
    public function show(Appointment $appointment)
    {
        $user = Auth::user();

        // Check authorization
        if ($user->id !== $appointment->user_id && $user->role->name === 'client') {
            return redirect()->route('appointments.index')->with('error', 'Unauthorized access.');
        }

        return view('appoinments.show', compact('appointment'));
    }

    /**
     * Delete an appointment
     */
    public function destroy(Appointment $appointment)
    {
        $user = Auth::user();

        // Check authorization
        if ($user->id !== $appointment->user_id && $user->role->name === 'client') {
            return redirect()->route('appointments.index')->with('error', 'Unauthorized access.');
        }

        $appointment->delete();

        return redirect()->route('appointments.index')->with('success', 'Appointment cancelled successfully!');
    }

    /**
     * Admin: view all appointments with approve/reject controls
     */
    public function adminIndex()
    {
        $user = Auth::user();

        if (!$user || $user->role_id !== 1) {
            abort(403, 'Unauthorized');
        }

        $appointments = Appointment::with('user')->latest()->paginate(20);

        return view('appoinments.admin.index', compact('appointments'));
    }

    /**
     * Admin: approve appointment with optional message
     */
    public function approve(Request $request, Appointment $appointment)
    {
        $user = Auth::user();

        if (!$user || $user->role_id !== 1) {
            abort(403, 'Unauthorized');
        }

        $data = $request->validate([
            'admin_message' => ['nullable', 'string', 'max:500'],
        ]);

        $lastQueue = Appointment::whereDate('appointment_date', $appointment->appointment_date)
            ->where('status', 'Approved')
            ->max('queue_number');

        $appointment->update([
            'status' => 'Approved',
            'queue_number' => ($lastQueue ?? 0) + 1,
            'admin_message' => $data['admin_message'] ?? null,
        ]);

        return redirect()->back()->with('success', 'Appointment approved.');
    }

    /**
     * Admin: reject appointment with optional message
     */
    public function reject(Request $request, Appointment $appointment)
    {
        $user = Auth::user();

        if (!$user || $user->role_id !== 1) {
            abort(403, 'Unauthorized');
        }

        $data = $request->validate([
            'admin_message' => ['nullable', 'string', 'max:500'],
        ]);

        $appointment->update([
            'status' => 'Rejected',
            'queue_number' => null,
            'admin_message' => $data['admin_message'] ?? null,
        ]);

        return redirect()->back()->with('success', 'Appointment rejected.');
    }
}