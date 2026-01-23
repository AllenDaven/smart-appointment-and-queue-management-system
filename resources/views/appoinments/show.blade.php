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

    .show-page {
        background: linear-gradient(to bottom, #ffffff 0%, #f9fafb 100%);
        padding: 2rem 1rem;
    }

    .show-container {
        max-width: 900px;
        margin: 0 auto;
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: #3b82f6;
        font-weight: 700;
        text-decoration: none;
        margin-bottom: 2rem;
        transition: all 0.3s ease;
    }

    .back-link:hover {
        color: #2563eb;
        gap: 0.75rem;
    }

    .detail-card {
        background: white;
        border-radius: 1.5rem;
        border: 1.5px solid #e5e7eb;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        transition: all 0.4s ease;
    }

    .card-header {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        padding: 3rem 2rem;
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

    .header-title {
        flex: 1;
    }

    .header-title h1 {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
    }

    .header-title p {
        font-size: 0.95rem;
        opacity: 0.9;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.6rem 1.5rem;
        border-radius: 9999px;
        font-weight: 700;
        font-size: 0.85rem;
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
        padding: 2.5rem;
    }

    .details-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .detail-box {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.05) 0%, rgba(99, 102, 241, 0.05) 100%);
        border: 1.5px solid #dbeafe;
        border-radius: 1rem;
        padding: 1.5rem;
        transition: all 0.3s ease;
    }

    .detail-box:hover {
        border-color: #3b82f6;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.1);
    }

    .detail-icon {
        width: 45px;
        height: 45px;
        border-radius: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 0.75rem;
        color: white;
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    }

    .detail-label {
        font-size: 0.75rem;
        font-weight: 600;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
    }

    .detail-value {
        font-size: 1.2rem;
        font-weight: 700;
        color: #1f2937;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem;
        border-bottom: 1px solid #f3f4f6;
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-label {
        font-size: 0.9rem;
        font-weight: 600;
        color: #6b7280;
    }

    .info-value {
        font-size: 0.95rem;
        font-weight: 500;
        color: #1f2937;
    }

    .queue-highlight {
        background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
        border: 2px solid #86efac;
        border-radius: 1rem;
        padding: 1.5rem;
        text-align: center;
        margin: 1.5rem 0;
    }

    .queue-value {
        font-size: 3rem;
        font-weight: 800;
        color: #059669;
    }

    .queue-label {
        font-size: 0.85rem;
        font-weight: 600;
        color: #047857;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-info {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.08) 0%, rgba(99, 102, 241, 0.08) 100%);
        border-left: 4px solid #3b82f6;
        border-radius: 0.75rem;
        padding: 1.5rem;
        margin-top: 2rem;
    }

    .status-info-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .status-info-list {
        list-style: none;
        space-y: 0.75rem;
    }

    .status-info-item {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        font-size: 0.9rem;
        color: #374151;
        margin-bottom: 0.75rem;
        line-height: 1.6;
    }

    .status-info-icon {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        margin-top: 2px;
        color: white;
        font-weight: bold;
        font-size: 0.8rem;
    }

    .status-info-icon.success {
        background: #10b981;
    }

    .status-info-icon.warning {
        background: #f59e0b;
    }

    .status-info-icon.danger {
        background: #ef4444;
    }

    .card-footer {
        background: linear-gradient(to right, #f9fafb, #f3f4f6);
        border-top: 1.5px solid #e5e7eb;
        padding: 1.5rem 2rem;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 1rem;
    }

    .btn {
        padding: 1rem 1.5rem;
        border-radius: 0.75rem;
        font-size: 0.95rem;
        font-weight: 700;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        text-decoration: none;
    }

    .btn-secondary {
        background: white;
        color: #6b7280;
        border: 1.5px solid #e5e7eb;
    }

    .btn-secondary:hover {
        background: #f9fafb;
        border-color: #d1d5db;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .btn-danger {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
    }

    .btn-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(239, 68, 68, 0.4);
    }

    .support-card {
        background: white;
        border-radius: 1.5rem;
        border: 1.5px solid #e5e7eb;
        padding: 2rem;
        text-align: center;
        margin-top: 2rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .support-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(99, 102, 241, 0.1));
        border-radius: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        color: #3b82f6;
    }

    .support-title {
        font-size: 1.5rem;
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 0.75rem;
    }

    .support-text {
        color: #6b7280;
        margin-bottom: 1.5rem;
        font-size: 0.95rem;
        line-height: 1.6;
    }

    .support-links {
        display: flex;
        justify-content: center;
        gap: 2rem;
    }

    .support-link {
        text-decoration: none;
        color: #3b82f6;
        font-weight: 700;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .support-link:hover {
        color: #2563eb;
        gap: 0.75rem;
    }
</style>

<div class="show-page">
    <div class="show-container">
        <!-- Back Link -->
        <a href="{{ route('appointments.index') }}" class="back-link">
            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Back to My Appointments
        </a>

        <!-- Main Detail Card -->
        <div class="detail-card">
            <!-- Card Header -->
            <div class="card-header">
                <div class="header-content">
                    <div class="header-title">
                        <h1>Appointment Details</h1>
                        <p>Reference ID: <strong>#{{ $appointment->id }}</strong></p>
                    </div>
                    <span class="status-badge {{ $appointment->status === 'Pending' ? 'status-pending' : ($appointment->status === 'Approved' ? 'status-approved' : 'status-rejected') }}">
                        <span>{{ $appointment->status === 'Approved' ? '✓' : ($appointment->status === 'Rejected' ? '✗' : '⏳') }}</span>
                        {{ $appointment->status }}
                    </span>
                </div>
            </div>

            <!-- Card Body -->
            <div class="card-body">
                <!-- Key Details Grid -->
                <div class="details-grid">
                    <!-- Date -->
                    <div class="detail-box">
                        <div class="detail-icon">
                            <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="detail-label">Appointment Date</div>
                        <div class="detail-value">{{ $appointment->appointment_date->format('M d, Y') }}</div>
                        <div style="font-size: 0.85rem; color: #6b7280; margin-top: 0.5rem;">{{ $appointment->appointment_date->format('l') }}</div>
                    </div>

                    <!-- Time -->
                    <div class="detail-box">
                        <div class="detail-icon">
                            <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="detail-label">Appointment Time</div>
                        <div class="detail-value">{{ $appointment->appointment_time->format('h:i A') }}</div>
                        <div style="font-size: 0.85rem; color: #6b7280; margin-top: 0.5rem;">Office Hours: 09:00 AM - 05:00 PM</div>
                    </div>

                    <!-- Status -->
                    <div class="detail-box">
                        <div class="detail-icon">
                            <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="detail-label">Current Status</div>
                        <div class="detail-value" style="color: {{ $appointment->status === 'Approved' ? '#059669' : ($appointment->status === 'Rejected' ? '#dc2626' : '#d97706') }};">{{ $appointment->status }}</div>
                    </div>
                </div>

                <!-- Queue Number Highlight -->
                @if($appointment->queue_number)
                    <div class="queue-highlight">
                        <div class="queue-label">Your Queue Number</div>
                        <div class="queue-value">#{{ $appointment->queue_number }}</div>
                    </div>
                @endif

                <!-- Additional Information -->
                <div style="background: white; border: 1.5px solid #e5e7eb; border-radius: 1rem; margin-top: 2rem;">
                    <div class="info-row">
                        <span class="info-label">👤 Booked For:</span>
                        <span class="info-value">{{ $appointment->user->name }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">📧 Email:</span>
                        <span class="info-value">{{ $appointment->user->email }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">📅 Booked On:</span>
                        <span class="info-value">{{ $appointment->created_at->format('M d, Y \a\t h:i A') }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">🔄 Last Updated:</span>
                        <span class="info-value">{{ $appointment->updated_at->diffForHumans() }}</span>
                    </div>
                </div>

                <!-- Status Information -->
                <div class="status-info">
                    <div class="status-info-title">
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                        What's Next?
                    </div>
                    <ul class="status-info-list">
                        @if($appointment->status === 'Pending')
                            <li class="status-info-item">
                                <span class="status-info-icon warning">!</span>
                                <span>Your appointment is waiting for confirmation. We'll review and notify you soon.</span>
                            </li>
                            <li class="status-info-item">
                                <span class="status-info-icon success">✓</span>
                                <span>Once approved, you'll receive a confirmation email with your queue number.</span>
                            </li>
                            <li class="status-info-item">
                                <span class="status-info-icon success">✓</span>
                                <span>You can cancel this appointment anytime if your plans change.</span>
                            </li>
                        @elseif($appointment->status === 'Approved')
                            <li class="status-info-item">
                                <span class="status-info-icon success">✓</span>
                                <span>Your appointment has been confirmed and approved!</span>
                            </li>
                            <li class="status-info-item">
                                <span class="status-info-icon success">✓</span>
                                <span>Queue #{{ $appointment->queue_number }} has been assigned to you.</span>
                            </li>
                            <li class="status-info-item">
                                <span class="status-info-icon success">✓</span>
                                <span>Please arrive 5-10 minutes before your scheduled time.</span>
                            </li>
                        @else
                            <li class="status-info-item">
                                <span class="status-info-icon danger">✗</span>
                                <span>This appointment has been rejected or cancelled.</span>
                            </li>
                            <li class="status-info-item">
                                <span class="status-info-icon success">✓</span>
                                <span>You can book a new appointment whenever you're ready.</span>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>

            <!-- Card Footer -->
            <div class="card-footer">
                <a href="{{ route('appointments.index') }}" class="btn btn-secondary">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Back
                </a>

                @if(Auth::user()->id === $appointment->user_id || Auth::user()->role->name !== 'client')
                    <button type="button" onclick="document.getElementById('cancelForm').submit();" class="btn btn-danger">
                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Cancel
                    </button>
                    <form id="cancelForm" method="POST" action="{{ route('appointments.destroy', $appointment) }}" onsubmit="return confirm('Are you sure? This cannot be undone.');" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                @endif
            </div>
        </div>

        <!-- Support Section -->
        <div class="support-card">
            <div class="support-icon">
                <svg width="28" height="28" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </div>
            <h3 class="support-title">Need Assistance?</h3>
            <p class="support-text">If you need to reschedule, have questions, or need help with your appointment, our support team is ready to assist you.</p>
            <div class="support-links">
                <a href="mailto:support@example.com" class="support-link">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    Email Support
                </a>
                <span style="color: #d1d5db;">|</span>
                <a href="tel:+1234567890" class="support-link">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                    Call Us
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

