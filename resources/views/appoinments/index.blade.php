@extends('layouts.app')

@section('content')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', 'Inter', sans-serif;
    }

    .appointments-page {
        background: linear-gradient(to bottom, #ffffff 0%, #f9fafb 100%);
        padding: 2rem 1rem;
    }

    .appointments-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .page-header {
        text-align: center;
        margin-bottom: 3rem;
        padding-top: 1rem;
    }

    .page-title {
        font-size: 3rem;
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 0.75rem;
        letter-spacing: -0.5px;
    }

    .page-subtitle {
        font-size: 1.1rem;
        color: #6b7280;
        font-weight: 400;
    }

    .action-bar {
        display: flex;
        justify-content: flex-end;
        margin-bottom: 2rem;
    }

    .btn-create {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.95rem 1.75rem;
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: white;
        font-weight: 700;
        border-radius: 0.75rem;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
    }

    .btn-create:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
    }

    .alert {
        padding: 1rem 1.25rem;
        border-radius: 0.75rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
    }

    .alert-error {
        background: #fef2f2;
        border: 1px solid #fecaca;
        color: #991b1b;
    }

    .alert-success {
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
        color: #166534;
    }

    .alert-icon {
        width: 20px;
        height: 20px;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .appointments-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .appointment-card {
        background: white;
        border-radius: 1.5rem;
        border: 1.5px solid #e5e7eb;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        flex-direction: column;
    }

    .appointment-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
        border-color: #3b82f6;
    }

    .card-header {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        padding: 1.5rem;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .card-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
        pointer-events: none;
    }

    .header-content {
        position: relative;
        z-index: 10;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }

    .header-date {
        flex: 1;
    }

    .header-date-label {
        font-size: 0.8rem;
        font-weight: 600;
        opacity: 0.9;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .header-date-value {
        font-size: 1.3rem;
        font-weight: 800;
        margin-top: 0.25rem;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.4rem 1rem;
        border-radius: 9999px;
        font-weight: 700;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        border: 2px solid rgba(255, 255, 255, 0.3);
    }

    .status-pending {
        background: rgba(245, 158, 11, 0.2);
        color: #fbbf24;
    }

    .status-approved {
        background: rgba(16, 185, 129, 0.2);
        color: #86efac;
    }

    .status-rejected {
        background: rgba(239, 68, 68, 0.2);
        color: #fca5a5;
    }

    .card-body {
        padding: 1.5rem;
        flex-grow: 1;
    }

    .card-info {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1rem;
        font-size: 0.9rem;
    }

    .card-info-icon {
        width: 32px;
        height: 32px;
        border-radius: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        color: white;
    }

    .card-info-icon.blue {
        background: linear-gradient(135deg, #dbeafe, #bfdbfe);
        color: #2563eb;
    }

    .card-info-icon.purple {
        background: linear-gradient(135deg, #ede9fe, #ddd6fe);
        color: #7c3aed;
    }

    .card-info-icon.green {
        background: linear-gradient(135deg, #dcfce7, #bbf7d0);
        color: #059669;
    }

    .card-info-label {
        font-weight: 600;
        color: #6b7280;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .card-info-value {
        font-weight: 700;
        color: #1f2937;
    }

    .card-timestamp {
        font-size: 0.8rem;
        color: #9ca3af;
        margin-top: 0.75rem;
        padding-top: 0.75rem;
        border-top: 1px solid #f3f4f6;
    }

    .card-footer {
        background: linear-gradient(to right, #f9fafb, #f3f4f6);
        border-top: 1.5px solid #e5e7eb;
        padding: 1rem;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.75rem;
    }

    .btn {
        padding: 0.75rem;
        border-radius: 0.65rem;
        font-size: 0.85rem;
        font-weight: 700;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.4rem;
        text-decoration: none;
    }

    .btn-view {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: white;
        box-shadow: 0 2px 8px rgba(59, 130, 246, 0.2);
    }

    .btn-view:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }

    .btn-cancel {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
        box-shadow: 0 2px 8px rgba(239, 68, 68, 0.2);
    }

    .btn-cancel:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }

    .empty-state {
        background: white;
        border-radius: 1.5rem;
        border: 1.5px solid #e5e7eb;
        padding: 4rem 2rem;
        text-align: center;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .empty-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 1.5rem;
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(99, 102, 241, 0.1));
        border-radius: 1.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #3b82f6;
    }

    .empty-title {
        font-size: 1.8rem;
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 0.75rem;
    }

    .empty-text {
        color: #6b7280;
        font-size: 0.95rem;
        margin-bottom: 2rem;
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
        line-height: 1.6;
    }

    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 2rem;
    }
</style>

<div class="appointments-page">
    <div class="appointments-container">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">My Appointments</h1>
            <p class="page-subtitle">Manage and view all your scheduled appointments</p>
        </div>

        <!-- Success & Error Messages -->
        @if(session('success'))
            <div class="alert alert-success">
                <svg class="alert-icon" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <p style="font-weight: 700;">{{ session('success') }}</p>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                <svg class="alert-icon" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
                <p style="font-weight: 700;">{{ session('error') }}</p>
            </div>
        @endif

        <!-- Appointments Grid -->
        @if($appointments->count() > 0)
            <div class="appointments-grid">
                @foreach($appointments as $appointment)
                    <div class="appointment-card">
                        <!-- Card Header -->
                        <div class="card-header">
                            <div class="header-content">
                                <div class="header-date">
                                    <div class="header-date-label">📅 Date</div>
                                    <div class="header-date-value">{{ $appointment->appointment_date->format('M d') }}</div>
                                    <div style="font-size: 0.8rem; opacity: 0.85;">{{ $appointment->appointment_date->format('Y') }}</div>
                                </div>
                                <span class="status-badge {{ $appointment->status === 'Pending' ? 'status-pending' : ($appointment->status === 'Approved' ? 'status-approved' : 'status-rejected') }}">
                                    <span>{{ $appointment->status === 'Approved' ? '✓' : ($appointment->status === 'Rejected' ? '✗' : '⏳') }}</span>
                                    {{ $appointment->status }}
                                </span>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="card-body">
                            <!-- Time -->
                            <div class="card-info">
                                <div class="card-info-icon blue">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="card-info-label">Time</div>
                                    <div class="card-info-value">{{ $appointment->appointment_time->format('h:i A') }}</div>
                                </div>
                            </div>

                            <!-- Queue Number -->
                            @if($appointment->queue_number)
                                <div class="card-info">
                                    <div class="card-info-icon green">
                                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="card-info-label">Queue #</div>
                                        <div class="card-info-value">#{{ $appointment->queue_number }}</div>
                                    </div>
                                </div>
                            @else
                                <div class="card-info">
                                    <div class="card-info-icon purple">
                                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="card-info-label">Status</div>
                                        <div class="card-info-value">{{ $appointment->status }}</div>
                                    </div>
                                </div>
                            @endif

                            <!-- User (for admin view) -->
                            @if(Auth::user()->role->name !== 'client')
                                <div class="card-info">
                                    <div class="card-info-icon blue">
                                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="card-info-label">Client</div>
                                        <div class="card-info-value">{{ $appointment->user->name }}</div>
                                    </div>
                                </div>
                            @endif

                            <!-- Timestamp -->
                            <div class="card-timestamp">
                                📌 Booked {{ $appointment->created_at->diffForHumans() }}
                            </div>
                        </div>

                        <!-- Card Footer -->
                        <div class="card-footer">
                            <a href="{{ route('appointments.show', $appointment) }}" class="btn btn-view">
                                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Details
                            </a>
                            @if(Auth::user()->id === $appointment->user_id || Auth::user()->role->name !== 'client')
                                <button type="button" onclick="document.getElementById('cancel-{{ $appointment->id }}').submit();" class="btn btn-cancel">
                                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    Cancel
                                </button>
                                <form id="cancel-{{ $appointment->id }}" method="POST" action="{{ route('appointments.destroy', $appointment) }}" onsubmit="return confirm('Are you sure you want to cancel this appointment?');" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($appointments->hasPages())
                <div class="pagination">
                    {{ $appointments->links('pagination::tailwind') }}
                </div>
            @endif
        @else
            <!-- Empty State -->
            <div class="empty-state">
                <div class="empty-icon">
                    <svg width="40" height="40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <h3 class="empty-title">No Appointments Yet</h3>
                <p class="empty-text">You haven't scheduled any appointments yet. Start by booking your first consultation with our SMEs and office professionals today.</p>
                <a href="{{ route('appointments.create') }}" class="btn-create">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Book Your First Appointment
                </a>
            </div>
        @endif
    </div>
</div>

@endsection