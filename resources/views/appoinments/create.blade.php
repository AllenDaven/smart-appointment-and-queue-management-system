@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">Book an Appointment</h1>
            <p class="text-gray-600">Schedule your consultation with our SMEs and offices</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-lg shadow-xl overflow-hidden mb-12">
            <!-- Form Header -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-8 py-6">
                <h2 class="text-2xl font-semibold text-white">Schedule Your Appointment</h2>
                <p class="text-blue-100 mt-1">Select a date and time that works best for you</p>
            </div>

            <!-- Form Body -->
            <form method="POST" action="{{ route('appointments.store') }}" class="px-6 py-8 sm:px-10">
                @csrf

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border border-red-100 rounded-lg p-4">
                        <div class="flex">
                            <svg class="h-4 w-4 text-red-500 mt-0.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                            <div class="ml-3">
                                <p class="text-sm font-semibold text-red-800">Please fix the following:</p>
                                <ul class="list-disc list-inside mt-1 text-sm text-red-700">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Success Message -->
                @if(session('success'))
                    <div class="mb-6 bg-green-50 border border-green-100 rounded-lg p-4">
                        <div class="flex">
                            <svg class="h-4 w-4 text-green-600 mt-0.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <p class="ml-3 text-sm font-semibold text-green-800">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                <!-- Date Field -->
                <div class="mb-6">
                    <label for="appointment_date" class="block text-sm font-semibold text-gray-700 mb-2">
                        <span class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Appointment Date
                        </span>
                    </label>
                    <input
                        type="date"
                        id="appointment_date"
                        name="appointment_date"
                        value="{{ old('appointment_date') }}"
                        min="{{ date('Y-m-d') }}"
                        required
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200 @error('appointment_date') border-red-500 @enderror"
                    >
                    @error('appointment_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-gray-500">Select a date from today onwards</p>
                </div>

                <!-- Time Field -->
                <div class="mb-6">
                    <label for="appointment_time" class="block text-sm font-semibold text-gray-700 mb-2">
                        <span class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Appointment Time
                        </span>
                    </label>
                    <input
                        type="time"
                        id="appointment_time"
                        name="appointment_time"
                        value="{{ old('appointment_time') }}"
                        required
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200 @error('appointment_time') border-red-500 @enderror"
                    >
                    @error('appointment_time')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-gray-500">Office hours: 09:00 AM - 05:00 PM</p>
                </div>

                <!-- User Info (Display Only) -->
                <div class="mb-8 bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <p class="text-sm text-gray-600">
                        <span class="font-semibold">Booking for:</span> <span class="text-gray-900">{{ Auth::user()->name }}</span>
                    </p>
                    <p class="text-sm text-gray-600 mt-1">
                        <span class="font-semibold">Email:</span> <span class="text-gray-900">{{ Auth::user()->email }}</span>
                    </p>
                </div>

                <!-- Form Actions -->
                <div class="flex gap-4">
                    <button
                        type="submit"
                        class="flex-1 bg-gradient-to-r from-blue-600 to-indigo-600 text-black font-bold py-3 px-6 rounded-lg hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200 flex items-center justify-center"
                    >
                        <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Book Appointment
                    </button>

                    <a
                        href="{{ route('appointments.index') }}"
                        class="flex-1 bg-gray-200 text-gray-800 font-semibold py-3 px-6 rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 transition duration-200 flex items-center justify-center"
                    >
                        <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Cancel
                    </a>
                </div>
            </form>
        </div>

        <div class="h-10"></div>

        <!-- Additional Info -->
        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white rounded-lg shadow p-4 text-left flex items-start gap-3">
                <svg class="w-6 h-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div>
                    <h3 class="font-semibold text-gray-900">Easy scheduling</h3>
                    <p class="text-sm text-gray-600">Pick your preferred date and time instantly.</p>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-4 text-left flex items-start gap-3">
                <svg class="w-6 h-6 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                </svg>
                <div>
                    <h3 class="font-semibold text-gray-900">Expert help</h3>
                    <p class="text-sm text-gray-600">Meet with SMEs and office experts.</p>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-4 text-left flex items-start gap-3">
                <svg class="w-6 h-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m7 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div>
                    <h3 class="font-semibold text-gray-900">Instant confirmation</h3>
                    <p class="text-sm text-gray-600">Receive immediate confirmation.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Set minimum time to 09:00 and maximum to 17:00
    document.getElementById('appointment_time').addEventListener('change', function() {
        const time = this.value;
        const [hours, minutes] = time.split(':');
        const hourNum = parseInt(hours, 10);

        if (hourNum < 9 || hourNum >= 17) {
            alert('Please select a time between 09:00 AM and 05:00 PM');
            this.value = '';
        }
    });

    // Format the date input to show selected date nicely
    document.getElementById('appointment_date').addEventListener('change', function() {
        const date = new Date(this.value);
        if (date < new Date().setHours(0,0,0,0)) {
            alert('Please select a future date');
            this.value = '';
        }
    });
</script>
@endsection
