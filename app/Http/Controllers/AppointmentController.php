<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
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
        $appointments = $user->appointments()->latest()->get();

        } else {
            // Staff/Admin see all appointments
            $appointments = Appointment::latest()->get();
        }

        return view('appointments.index', compact('appointments'));
    }

    /**
     * Store a new appointment (Client)
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required',
        ]);

        $user = Auth::user();

        Appointment::create([
            'user_id' => $user->id,
            'appointment_date' => $request->date,
            'appointment_time' => $request->time,
            'status' => 'Pending',
        ]);

        return redirect()->back()->with('success', 'Appointment booked!');
    }

    /**
     * Approve appointment (Staff/Admin)
     */
    public function approve(int $id)
    {
        $appointment = Appointment::findOrFail($id);

        // Calculate next queue number for the day
        $lastQueue = Appointment::whereDate('appointment_date', $appointment->appointment_date)
                                ->where('status', 'Approved')
                                ->max('queue_number');

        $appointment->update([
            'status' => 'Approved',
            'queue_number' => ($lastQueue ?? 0) + 1
        ]);

        return redirect()->back()->with('success', 'Appointment approved.');
    }

    /**
     * Reject appointment (Staff/Admin)
     */
    public function reject(int $id)
    {
        $appointment = Appointment::findOrFail($id);

        $appointment->update([
            'status' => 'Rejected',
            'queue_number' => null
        ]);

        return redirect()->back()->with('success', 'Appointment rejected.');
    }
}