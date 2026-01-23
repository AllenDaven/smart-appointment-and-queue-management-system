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

    .admin-page {
        min-height: 100vh;
        background: linear-gradient(to bottom, #ffffff 0%, #f9fafb 100%);
        padding: 2rem 1rem;
    }

    .admin-container {
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

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: white;
        border-radius: 1.5rem;
        border: 1.5px solid #e5e7eb;
        padding: 2rem;
        text-align: center;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        border-color: #3b82f6;
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        color: white;
    }

    .stat-icon.blue {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    }

    .stat-icon.green {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    }

    .stat-icon.yellow {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    }

    .stat-label {
        font-size: 0.85rem;
        font-weight: 600;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
    }

    .stat-value {
        font-size: 2.5rem;
        font-weight: 800;
        color: #1f2937;
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
        gap: 1.5rem;
    }

    .appointment-card {
        background: white;
        border-radius: 1.5rem;
        border: 1.5px solid #e5e7eb;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        transition: all 0.4s ease;
    }

    .appointment-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
        border-color: #3b82f6;
    }

    .appointment-header {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.08) 0%, rgba(37, 99, 235, 0.08) 100%);
        padding: 1.5rem;
        border-bottom: 1.5px solid #e5e7eb;
    }

    .appointment-content {
        padding: 2rem;
    }

    .appointment-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .appointment-info {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .info-icon {
        width: 45px;
        height: 45px;
        border-radius: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        color: white;
    }

    .info-icon.blue {
        background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
        color: #2563eb;
    }

    .info-icon.purple {
        background: linear-gradient(135deg, #ede9fe 0%, #ddd6fe 100%);
        color: #7c3aed;
    }

    .info-icon.green {
        background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
        color: #059669;
    }

    .info-label {
        font-size: 0.8rem;
        font-weight: 600;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.25rem;
    }

    .info-value {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1f2937;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1.25rem;
        border-radius: 9999px;
        font-weight: 700;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .status-pending {
        background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
        color: #92400e;
        border: 1px solid #fcd34d;
    }

    .status-approved {
        background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
        color: #166534;
        border: 1px solid #86efac;
    }

    .status-rejected {
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
        color: #991b1b;
        border: 1px solid #fca5a5;
    }

    .admin-message {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.05) 0%, rgba(99, 102, 241, 0.05) 100%);
        border-left: 4px solid #3b82f6;
        border-radius: 0.75rem;
        padding: 1rem;
        margin-top: 1rem;
    }

    .admin-message-label {
        font-size: 0.75rem;
        font-weight: 700;
        color: #3b82f6;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
    }

    .admin-message-text {
        font-size: 0.9rem;
        color: #1f2937;
        line-height: 1.6;
    }

    .actions-section {
        border-top: 1.5px solid #e5e7eb;
        padding-top: 1.5rem;
    }

    .form-label {
        display: block;
        font-size: 0.95rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 0.75rem;
    }

    .form-textarea {
        width: 100%;
        padding: 0.9rem 1.25rem;
        border: 1.5px solid #e5e7eb;
        border-radius: 0.75rem;
        font-size: 0.95rem;
        font-weight: 500;
        color: #1f2937;
        font-family: 'Poppins', 'Inter', sans-serif;
        resize: none;
        transition: all 0.3s ease;
        margin-bottom: 1rem;
    }

    .form-textarea:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .actions-buttons {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 1rem;
    }

    .btn {
        padding: 0.95rem 1.75rem;
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

    .btn-approve {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
    }

    .btn-approve:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4);
    }

    .btn-reject {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
    }

    .btn-reject:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(239, 68, 68, 0.4);
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
        width: 70px;
        height: 70px;
        margin: 0 auto 1.5rem;
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(99, 102, 241, 0.1));
        border-radius: 1.25rem;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #3b82f6;
    }

    .empty-title {
        font-size: 1.5rem;
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 0.5rem;
    }

    .empty-text {
        color: #6b7280;
        font-size: 0.95rem;
    }

    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 2rem;
    }
</style>

<div class="admin-page">
    <div class="admin-container">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">Manage Appointments</h1>
            <p class="page-subtitle">Review, approve, or reject pending appointment requests</p>
        </div>

        <!-- Stats Grid -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon blue">
                    <svg width="26" height="26" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <div class="stat-label">Total Appointments</div>
                <div class="stat-value">{{ $appointments->count() }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon yellow">
                    <svg width="26" height="26" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="stat-label">Pending Review</div>
                <div class="stat-value">{{ $appointments->where('status','Pending')->count() }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon green">
                    <svg width="26" height="26" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div class="stat-label">Approved</div>
                <div class="stat-value">{{ $appointments->where('status','Approved')->count() }}</div>
            </div>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="alert alert-success">
                <svg class="alert-icon" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <p style="font-weight: 700;">{{ session('success') }}</p>
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-error">
                <svg class="alert-icon" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
                <div>
                    <p style="font-weight: 700; margin-bottom: 0.5rem;">Please fix the following errors:</p>
                    <ul style="list-style: disc; padding-left: 1.25rem;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <!-- Appointments Grid -->
        <div class="appointments-grid">
            @forelse($appointments as $appointment)
                <div class="appointment-card">
                    <!-- Card Header -->
                    <div class="appointment-header">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div style="width: 50px; height: 50px; border-radius: 0.75rem; background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); display: flex; align-items: center; justify-content: center; color: white; flex-shrink: 0;">
                                    <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="info-label">Client Name</div>
                                    <div class="info-value">{{ $appointment->user->name }}</div>
                                </div>
                            </div>
                            <span class="status-badge {{ $appointment->status === 'Approved' ? 'status-approved' : ($appointment->status === 'Rejected' ? 'status-rejected' : 'status-pending') }}">
                                <span>{{ $appointment->status === 'Approved' ? '✓' : ($appointment->status === 'Rejected' ? '✗' : '⏳') }}</span>
                                {{ $appointment->status }}
                            </span>
                        </div>
                    </div>

                    <!-- Card Content -->
                    <div class="appointment-content">
                        <!-- Appointment Details Row 1 -->
                        <div class="appointment-row">
                            <div class="appointment-info">
                                <div class="info-icon blue">
                                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="info-label">Appointment Date</div>
                                    <div class="info-value">{{ $appointment->appointment_date->format('M d, Y') }}</div>
                                </div>
                            </div>

                            <div class="appointment-info">
                                <div class="info-icon purple">
                                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="info-label">Appointment Time</div>
                                    <div class="info-value">{{ $appointment->appointment_time->format('h:i A') }}</div>
                                </div>
                            </div>

                            <div class="appointment-info">
                                <div class="info-icon green">
                                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="info-label">Queue Number</div>
                                    <div class="info-value">{{ $appointment->queue_number ? '#' . $appointment->queue_number : '—' }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Admin Message (if exists) -->
                        @if($appointment->admin_message)
                            <div class="admin-message">
                                <div class="admin-message-label">💬 Admin Note</div>
                                <div class="admin-message-text">{{ $appointment->admin_message }}</div>
                            </div>
                        @endif

                        <!-- Action Section -->
                        @if($appointment->status === 'Pending')
                            <div class="actions-section">
                                <label class="form-label">📝 Add a Note for Client (Optional)</label>
                                <textarea id="msg_{{ $appointment->id }}" placeholder="e.g., 'Your appointment is confirmed. Please bring your ID and any required documents.'" class="form-textarea" rows="3"></textarea>

                                <div class="actions-buttons">
                                    <!-- Approve Form -->
                                    <form id="approve_{{ $appointment->id }}" method="POST" action="{{ route('admin.appointments.approve', $appointment) }}" style="display: contents;">
                                        @csrf
                                        <input type="hidden" name="admin_message" id="approve_msg_{{ $appointment->id }}" value="">
                                        <button type="button" onclick="submitApprove({{ $appointment->id }})" class="btn btn-approve">
                                            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            Approve
                                        </button>
                                    </form>

                                    <!-- Reject Form -->
                                    <form id="reject_{{ $appointment->id }}" method="POST" action="{{ route('admin.appointments.reject', $appointment) }}" style="display: contents;">
                                        @csrf
                                        <input type="hidden" name="admin_message" id="reject_msg_{{ $appointment->id }}" value="">
                                        <button type="button" onclick="submitReject({{ $appointment->id }})" class="btn btn-reject">
                                            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                            Reject
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <div class="actions-section">
                                <p style="text-align: center; color: #6b7280; font-size: 0.95rem; font-weight: 500;">This appointment has already been <strong>{{ strtolower($appointment->status) }}</strong></p>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <div class="empty-icon">
                        <svg width="36" height="36" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="empty-title">No Pending Appointments</h3>
                    <p class="empty-text">All set! There are no pending appointment requests to review at the moment.</p>
                </div>
            @endforelse
        </div>


        <!-- Pagination -->
        @if($appointments->count())
            <div class="pagination">
                {{ $appointments->links('pagination::tailwind') }}
            </div>
        @endif
    </div>
</div>

<script>
    function submitApprove(appointmentId) {
        const message = document.getElementById(`msg_${appointmentId}`)?.value || '';
        const form = document.getElementById(`approve_${appointmentId}`);
        form.querySelector(`#approve_msg_${appointmentId}`).value = message;
        form.submit();
    }

    function submitReject(appointmentId) {
        const message = document.getElementById(`msg_${appointmentId}`)?.value || '';
        const form = document.getElementById(`reject_${appointmentId}`);
        form.querySelector(`#reject_msg_${appointmentId}`).value = message;
        form.submit();
    }
</script>
@endsection
