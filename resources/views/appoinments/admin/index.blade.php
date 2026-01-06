@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-10 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-4xl font-bold text-gray-900">📋 Manage Appointments</h1>
                <p class="text-sm text-gray-600 mt-1">Approve or reject pending appointments</p>
            </div>
            <a href="{{ route('appointments.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-800 bg-blue-50 px-4 py-2 rounded-lg">← Back</a>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-800 text-sm px-4 py-3 rounded-lg flex items-center gap-2">
                <span class="text-lg">✓</span> {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 text-red-800 text-sm px-4 py-3 rounded-lg">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Appointments Grid -->
        <div class="space-y-5">
            @forelse($appointments as $appointment)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition p-6">
                    <!-- Appointment Info -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
                        <!-- Left Column -->
                        <div class="space-y-3">
                            <div class="flex items-center gap-2">
                                <span class="text-gray-500 text-sm">👤 Client:</span>
                                <span class="font-semibold text-gray-900">{{ $appointment->user->name }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-gray-500 text-sm">📅 Date:</span>
                                <span class="font-semibold text-gray-900">{{ $appointment->appointment_date->format('M d, Y') }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-gray-500 text-sm">⏰ Time:</span>
                                <span class="font-semibold text-gray-900">{{ $appointment->appointment_time->format('h:i A') }}</span>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-3">
                            <div class="flex items-center gap-2">
                                <span class="text-gray-500 text-sm">Status:</span>
                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold
                                    {{ $appointment->status === 'Approved' ? 'bg-green-100 text-green-800' : ($appointment->status === 'Rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                    {{ $appointment->status }}
                                </span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-gray-500 text-sm">Queue #:</span>
                                <span class="font-semibold text-gray-900">{{ $appointment->queue_number ? '#' . $appointment->queue_number : '—' }}</span>
                            </div>
                            @if($appointment->admin_message)
                                <div class="bg-blue-50 border-l-4 border-blue-400 p-3 rounded">
                                    <span class="text-xs text-gray-600 font-medium">Message:</span>
                                    <p class="text-sm text-gray-800 mt-1">{{ $appointment->admin_message }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Action Forms -->
                    @if($appointment->status === 'Pending')
                        <div class="border-t pt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Note for Client (optional)</label>
                            <textarea id="msg_{{ $appointment->id }}" placeholder="e.g., 'Your appointment is confirmed. Please arrive 10 minutes early.'" class="w-full border border-gray-300 rounded-lg p-3 text-sm mb-4 focus:ring-2 focus:ring-blue-500 focus:border-transparent" rows="2"></textarea>

                            <div class="flex gap-3">
                                <!-- Approve Form -->
                                <form id="approve_{{ $appointment->id }}" method="POST" action="{{ route('admin.appointments.approve', $appointment) }}" class="flex-1">
                                    @csrf
                                    <input type="hidden" name="admin_message" id="approve_msg_{{ $appointment->id }}" value="">
                                    <button type="button" onclick="submitApprove({{ $appointment->id }})" class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-4 rounded-lg transition flex items-center justify-center gap-2">
                                        <span>✓</span> Approve Appointment
                                    </button>
                                </form>

                                <!-- Reject Form -->
                                <form id="reject_{{ $appointment->id }}" method="POST" action="{{ route('admin.appointments.reject', $appointment) }}" class="flex-1">
                                    @csrf
                                    <input type="hidden" name="admin_message" id="reject_msg_{{ $appointment->id }}" value="">
                                    <button type="button" onclick="submitReject({{ $appointment->id }})" class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-4 rounded-lg transition flex items-center justify-center gap-2">
                                        <span>✗</span> Reject Appointment
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="border-t pt-4 text-center text-gray-500 text-sm">
                            This appointment is already {{ strtolower($appointment->status) }}
                        </div>
                    @endif
                </div>
            @empty
                <div class="bg-gray-100 rounded-lg p-8 text-center text-gray-500">
                    <p class="text-lg">No pending appointments</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($appointments->count())
            <div class="mt-8">
                {{ $appointments->links('pagination::tailwind') }}
            </div>
        @endif
    </div>
</div>

<script>
    function submitApprove(appointmentId) {
        const message = document.getElementById(`msg_${appointmentId}`).value;
        const form = document.getElementById(`approve_${appointmentId}`);
        form.querySelector(`#approve_msg_${appointmentId}`).value = message;
        form.submit();
    }

    function submitReject(appointmentId) {
        const message = document.getElementById(`msg_${appointmentId}`).value;
        const form = document.getElementById(`reject_${appointmentId}`);
        form.querySelector(`#reject_msg_${appointmentId}`).value = message;
        form.submit();
    }
</script>
@endsection
