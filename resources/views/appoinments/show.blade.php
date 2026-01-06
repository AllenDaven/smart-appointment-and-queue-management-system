@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('appointments.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold">
                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to Appointments
            </a>
        </div>

        <!-- Appointment Details Card -->
        <div class="bg-white rounded-lg shadow-xl overflow-hidden">
            <!-- Card Header -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-8 py-6">
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-3xl font-bold text-white">Appointment Details</h1>
                        <p class="text-blue-100 mt-1">Reference ID: #{{ $appointment->id }}</p>
                    </div>
                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold {{ $appointment->status === 'Pending' ? 'bg-yellow-100 text-yellow-800' : ($appointment->status === 'Confirmed' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }}">
                        {{ $appointment->status }}
                    </span>
                </div>
            </div>

            <!-- Card Body -->
            <div class="px-8 py-8">
                <!-- Appointment Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                    <!-- Date Section -->
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-lg border-2 border-blue-200">
                        <div class="flex items-center mb-2">
                            <svg class="w-6 h-6 text-blue-600 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <h3 class="text-lg font-semibold text-gray-900">Appointment Date</h3>
                        </div>
                        <p class="text-3xl font-bold text-blue-600">{{ $appointment->appointment_date->format('M d') }}</p>
                        <p class="text-gray-600 text-sm mt-1">{{ $appointment->appointment_date->format('l, Y') }}</p>
                    </div>

                    <!-- Time Section -->
                    <div class="bg-gradient-to-br from-indigo-50 to-indigo-100 p-6 rounded-lg border-2 border-indigo-200">
                        <div class="flex items-center mb-2">
                            <svg class="w-6 h-6 text-indigo-600 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h3 class="text-lg font-semibold text-gray-900">Appointment Time</h3>
                        </div>
                        <p class="text-3xl font-bold text-indigo-600">{{ $appointment->appointment_time->format('h:i A') }}</p>
                        <p class="text-gray-600 text-sm mt-1">Office Hours: 09:00 AM - 05:00 PM</p>
                    </div>
                </div>

                <!-- Additional Details -->
                <div class="space-y-4 border-t border-gray-200 pt-8">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600 font-semibold">Booking For:</span>
                        <span class="text-gray-900 text-lg">{{ $appointment->user->name }}</span>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-gray-600 font-semibold">Email:</span>
                        <span class="text-gray-900 text-lg">{{ $appointment->user->email }}</span>
                    </div>

                    @if($appointment->queue_number)
                        <div class="flex justify-between items-center bg-green-50 p-4 rounded-lg border-l-4 border-green-500">
                            <span class="text-gray-600 font-semibold">Queue Number:</span>
                            <span class="text-green-600 text-2xl font-bold">#{{ $appointment->queue_number }}</span>
                        </div>
                    @endif

                    <div class="flex justify-between items-center">
                        <span class="text-gray-600 font-semibold">Status:</span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $appointment->status === 'Pending' ? 'bg-yellow-100 text-yellow-800' : ($appointment->status === 'Confirmed' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }}">
                            {{ $appointment->status }}
                        </span>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-gray-600 font-semibold">Booked On:</span>
                        <span class="text-gray-900 text-lg">{{ $appointment->created_at->format('M d, Y \a\t h:i A') }}</span>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-gray-600 font-semibold">Last Updated:</span>
                        <span class="text-gray-900 text-lg">{{ $appointment->updated_at->diffForHumans() }}</span>
                    </div>
                </div>

                <!-- Status Information -->
                <div class="mt-8 bg-blue-50 border-l-4 border-blue-500 p-4 rounded-r-lg">
                    <h4 class="font-semibold text-blue-900 mb-2">Status Information</h4>
                    <ul class="text-sm text-blue-800 space-y-1">
                        @if($appointment->status === 'Pending')
                            <li>✓ Your appointment is pending confirmation</li>
                            <li>✓ We will notify you once it's confirmed</li>
                            <li>✓ You can cancel this appointment anytime</li>
                        @elseif($appointment->status === 'Confirmed')
                            <li>✓ Your appointment has been confirmed</li>
                            <li>✓ A queue number has been assigned: #{{ $appointment->queue_number }}</li>
                            <li>✓ Please arrive 5-10 minutes early</li>
                        @else
                            <li>✗ This appointment has been cancelled</li>
                        @endif
                    </ul>
                </div>
            </div>

            <!-- Card Footer -->
            <div class="bg-gray-50 px-8 py-6 flex gap-4">
                <a href="{{ route('appointments.index') }}" class="flex-1 text-center bg-gray-300 text-gray-800 font-bold py-3 px-6 rounded-lg hover:bg-gray-400 transition duration-200">
                    <svg class="w-5 h-5 inline mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Back
                </a>

                @if(Auth::user()->id === $appointment->user_id || Auth::user()->role->name !== 'client')
                    <form method="POST" action="{{ route('appointments.destroy', $appointment) }}" class="flex-1" onsubmit="return confirm('Are you sure you want to cancel this appointment? This action cannot be undone.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full bg-red-600 text-white font-bold py-3 px-6 rounded-lg hover:bg-red-700 transition duration-200">
                            <svg class="w-5 h-5 inline mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Cancel Appointment
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <!-- Need Help Section -->
        <div class="mt-8 bg-white rounded-lg shadow-lg p-6 text-center">
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Need Help?</h3>
            <p class="text-gray-600 mb-4">If you need to reschedule or have any questions about your appointment, please contact us.</p>
            <div class="flex justify-center gap-4">
                <a href="mailto:support@example.com" class="text-blue-600 hover:text-blue-800 font-semibold">
                    📧 Email Support
                </a>
                <span class="text-gray-400">|</span>
                <a href="tel:+1234567890" class="text-blue-600 hover:text-blue-800 font-semibold">
                    📞 Call Us
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
