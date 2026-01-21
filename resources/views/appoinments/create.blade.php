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

    .booking-page {
        min-height: 100vh;
        background: linear-gradient(to bottom, #ffffff 0%, #f9fafb 100%);
        padding: 2rem 1rem;
    }

    .booking-container {
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

    .booking-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 2rem;
    }

    @media (min-width: 1024px) {
        .booking-grid {
            grid-template-columns: 2fr 1fr;
        }
    }

    .form-card {
        background: white;
        border-radius: 1.5rem;
        border: 1.5px solid #e5e7eb;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .form-header {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        padding: 2.5rem 2rem;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .form-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
        pointer-events: none;
    }

    .form-header-content {
        position: relative;
        z-index: 10;
    }

    .form-title {
        font-size: 1.75rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
    }

    .form-description {
        font-size: 0.95rem;
        opacity: 0.9;
    }

    .form-body {
        padding: 2.5rem 2rem;
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

    .user-info-card {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.08) 0%, rgba(37, 99, 235, 0.08) 100%);
        border: 1.5px solid #dbeafe;
        border-radius: 1rem;
        padding: 1.5rem;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .user-avatar {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
    }

    .user-details {
        flex: 1;
    }

    .user-label {
        font-size: 0.75rem;
        font-weight: 600;
        color: #3b82f6;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.25rem;
    }

    .user-name {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 0.25rem;
    }

    .user-email {
        font-size: 0.9rem;
        color: #6b7280;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-group {
        margin-bottom: 1.75rem;
    }

    .form-label {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 0.95rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 0.75rem;
    }

    .label-icon {
        width: 40px;
        height: 40px;
        border-radius: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .label-icon.blue {
        background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
        color: #2563eb;
    }

    .label-icon.purple {
        background: linear-gradient(135deg, #ede9fe 0%, #ddd6fe 100%);
        color: #7c3aed;
    }

    .form-input {
        width: 100%;
        padding: 0.9rem 1.25rem;
        border: 1.5px solid #e5e7eb;
        border-radius: 0.75rem;
        font-size: 0.95rem;
        font-weight: 500;
        color: #1f2937;
        transition: all 0.3s ease;
        font-family: 'Poppins', 'Inter', sans-serif;
    }

    .form-input:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .form-input.error {
        border-color: #ef4444;
    }

    .form-input.error:focus {
        border-color: #ef4444;
        box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
    }

    .form-hint {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-top: 0.5rem;
        font-size: 0.85rem;
        color: #6b7280;
    }

    .form-error {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-top: 0.5rem;
        font-size: 0.85rem;
        color: #ef4444;
        font-weight: 500;
    }

    .form-actions {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
    }

    @media (max-width: 640px) {
        .form-actions {
            flex-direction: column;
        }
    }

    .btn {
        flex: 1;
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

    .btn-primary {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
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

    .sidebar-card {
        background: white;
        border-radius: 1.5rem;
        border: 1.5px solid #e5e7eb;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        padding: 2rem;
        margin-bottom: 1.5rem;
    }

    .sidebar-title {
        font-size: 1.25rem;
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .sidebar-icon {
        width: 45px;
        height: 45px;
        border-radius: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .tip-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .tip-item {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        margin-bottom: 1rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #f3f4f6;
    }

    .tip-item:last-child {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none;
    }

    .tip-icon {
        width: 24px;
        height: 24px;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .tip-text {
        font-size: 0.9rem;
        color: #4b5563;
        line-height: 1.6;
    }

    .support-card {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.9) 0%, rgba(79, 70, 229, 0.9) 100%);
        border-radius: 1.5rem;
        padding: 2rem;
        color: white;
        text-align: center;
    }

    .support-icon-wrapper {
        width: 60px;
        height: 60px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.25rem;
    }

    .support-title {
        font-size: 1.35rem;
        font-weight: 800;
        margin-bottom: 0.75rem;
    }

    .support-text {
        font-size: 0.9rem;
        opacity: 0.95;
        margin-bottom: 1.5rem;
        line-height: 1.6;
    }

    .support-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        padding: 0.85rem 1.75rem;
        background: white;
        color: #3b82f6;
        border-radius: 0.75rem;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .support-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.25);
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
        margin-top: 3rem;
    }

    .feature-card {
        background: white;
        padding: 2rem;
        border-radius: 1.5rem;
        border: 1.5px solid #e5e7eb;
        transition: all 0.4s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .feature-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
        border-color: #3b82f6;
    }

    .feature-icon {
        width: 60px;
        height: 60px;
        border-radius: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.25rem;
        color: white;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
    }

    .feature-icon.blue {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    }

    .feature-icon.green {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
    }

    .feature-icon.purple {
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        box-shadow: 0 4px 15px rgba(139, 92, 246, 0.3);
    }

    .feature-title {
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 0.75rem;
        color: #1f2937;
    }

    .feature-description {
        color: #6b7280;
        line-height: 1.7;
        font-size: 0.95rem;
    }
</style>

<div class="booking-page">
    <div class="booking-container">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">Book Your Appointment</h1>
            <p class="page-subtitle">Schedule your consultation with our SMEs and offices</p>
        </div>

        <div class="booking-grid">
            <!-- Main Form -->
            <div>
                <div class="form-card">
                    <div class="form-header">
                        <div class="form-header-content">
                            <h2 class="form-title">Schedule Your Appointment</h2>
                            <p class="form-description">Select a date and time that works best for you</p>
                        </div>
                    </div>

                    <div class="form-body">
                        <form method="POST" action="{{ route('appointments.store') }}">
                            @csrf


                            <!-- Error Messages -->
                            @if ($errors->any())
                                <div class="alert alert-error">
                                    <svg class="alert-icon" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                    </svg>
                                    <div>
                                        <p style="font-weight: 700; margin-bottom: 0.5rem;">Please fix the following errors:</p>
                                        <ul style="list-style: disc; padding-left: 1.25rem;">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif

                            <!-- Success Message -->
                            @if(session('success'))
                                <div class="alert alert-success">
                                    <svg class="alert-icon" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    <p style="font-weight: 700;">{{ session('success') }}</p>
                                </div>
                            @endif

                            <!-- User Info -->
                            <div class="user-info-card">
                                <div class="user-avatar">
                                    <svg width="28" height="28" fill="white" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="user-details">
                                    <div class="user-label">Booking For</div>
                                    <div class="user-name">{{ Auth::user()->name }}</div>
                                    <div class="user-email">
                                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                        {{ Auth::user()->email }}
                                    </div>
                                </div>
                            </div>

                            <!-- Date Field -->
                            <div class="form-group">
                                <label for="appointment_date" class="form-label">
                                    <span class="label-icon blue">
                                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </span>
                                    <span>Appointment Date <span style="color: #ef4444;">*</span></span>
                                </label>
                                <input
                                    type="date"
                                    id="appointment_date"
                                    name="appointment_date"
                                    value="{{ old('appointment_date') }}"
                                    min="{{ date('Y-m-d') }}"
                                    required
                                    class="form-input @error('appointment_date') error @enderror"
                                >
                                @error('appointment_date')
                                    <p class="form-error">
                                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                                <p class="form-hint">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Select a date from today onwards
                                </p>
                            </div>

                            <!-- Time Field -->
                            <div class="form-group">
                                <label for="appointment_time" class="form-label">
                                    <span class="label-icon purple">
                                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </span>
                                    <span>Appointment Time <span style="color: #ef4444;">*</span></span>
                                </label>
                                <input
                                    type="time"
                                    id="appointment_time"
                                    name="appointment_time"
                                    value="{{ old('appointment_time') }}"
                                    required
                                    class="form-input @error('appointment_time') error @enderror"
                                >
                                @error('appointment_time')
                                    <p class="form-error">
                                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                                <p class="form-hint">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Office hours: <strong>09:00 AM - 05:00 PM</strong>
                                </p>
                            </div>

                            <!-- Form Actions -->
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">
                                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Confirm Booking
                                </button>
                                <a href="{{ route('appointments.index') }}" class="btn btn-secondary">
                                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div>
                <!-- Quick Tips Card -->
                <div class="sidebar-card">
                    <h3 class="sidebar-title">
                        <span class="sidebar-icon" style="background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%); color: white;">
                            <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </span>
                        Quick Tips
                    </h3>
                    <ul class="tip-list">
                        <li class="tip-item">
                            <svg class="tip-icon" style="color: #10b981;" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="tip-text">Book at least 24 hours in advance for the best availability</span>
                        </li>
                        <li class="tip-item">
                            <svg class="tip-icon" style="color: #10b981;" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="tip-text">Our office hours are from 9:00 AM to 5:00 PM</span>
                        </li>
                        <li class="tip-item">
                            <svg class="tip-icon" style="color: #10b981;" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="tip-text">You'll receive instant confirmation via email</span>
                        </li>
                        <li class="tip-item">
                            <svg class="tip-icon" style="color: #10b981;" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="tip-text">Please arrive 5-10 minutes before your scheduled time</span>
                        </li>
                    </ul>
                </div>

                <!-- Support Card -->
                <div class="support-card">
                    <div class="support-icon-wrapper">
                        <svg width="32" height="32" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <h3 class="support-title">Need Help?</h3>
                    <p class="support-text">Having trouble booking? Our support team is here to assist you anytime.</p>
                    <a href="#" class="support-btn">
                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        Contact Support
                    </a>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon blue">
                    <svg width="30" height="30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="feature-title">Easy Scheduling</h3>
                <p class="feature-description">Pick your preferred date and time instantly with our streamlined booking system designed for your convenience.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon green">
                    <svg width="30" height="30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <h3 class="feature-title">Expert Consultation</h3>
                <p class="feature-description">Connect with Subject Matter Experts and office professionals to get the guidance and support you need.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon purple">
                    <svg width="30" height="30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <h3 class="feature-title">Instant Confirmation</h3>
                <p class="feature-description">Receive immediate confirmation and real-time updates about your appointment status directly to your email.</p>
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
