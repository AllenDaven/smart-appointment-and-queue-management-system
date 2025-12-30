@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">

    <h1 class="text-2xl font-bold mb-4">Book an Appointment</h1>

    <!-- Success & Error Messages -->
    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-200 text-red-800 p-2 rounded mb-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Appointment Form -->
    <form method="POST" action="{{ route('appointments.store') }}" class="mb-6">
        @csrf
        <div class="mb-2">
            <label class="block font-semibold">Date</label>
            <input type="date" name="date" required class="border p-2 rounded w-full">
        </div>
        <div class="mb-2">
            <label class="block font-semibold">Time</label>
            <input type="time" name="time" required class="border p-2 rounded w-full">
        </div>
        <button type="submit" class="bg-blue-500 text-white p-2 rounded">Book Appointment</button>
    </form>

    <!-- Appointment Table -->
    <h2 class="text-xl font-bold mb-2">My Appointments</h2>
    <table class="border w-full">
        <thead>
            <tr class="bg-gray-200">
                <th class="border p-2">Date</th>
                <th class="border p-2">Time</th>
                <th class="border p-2">Status</th>
                <th class="border p-2">Queue Number</th>
            </tr>
        </thead>
        <tbody>
            @forelse($appointments as $appointment)
                <tr>
                    <td class="border p-2">{{ $appointment->appointment_date }}</td>
                    <td class="border p-2">{{ $appointment->appointment_time }}</td>
                    <td class="border p-2">{{ $appointment->status }}</td>
                    <td class="border p-2">{{ $appointment->queue_number ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="border p-2 text-center">No appointments yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection