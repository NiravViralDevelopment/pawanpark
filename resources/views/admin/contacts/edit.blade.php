@extends('admin.layouts.admin')

@section('title', 'Add Follow-up Reason')
@section('page-title', 'Add Follow-up Reason')

@section('content')
<div class="contact-edit-page">
    <!-- Header Actions -->
    <div class="page-header">
        <div class="header-left">
            <a href="{{ route('admin.contacts.show', $contact->id) }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Back to Contact
            </a>
        </div>
    </div>

    <div class="content-grid">
        <!-- Left Column - Form -->
        <div class="left-column">
            <div class="card">
                <div class="card-header">
                    <h3><i class="fas fa-edit"></i> Follow-up Reason</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.contacts.update', $contact->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="follow_up_reason">Follow-up Reason / Notes <span class="required">*</span></label>
                            <textarea 
                                name="follow_up_reason" 
                                id="follow_up_reason" 
                                rows="8" 
                                class="form-control @error('follow_up_reason') is-invalid @enderror"
                                placeholder="Enter follow-up reason or notes about this contact..."
                                required>{{ old('follow_up_reason', $contact->follow_up_reason) }}</textarea>
                            
                            @error('follow_up_reason')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                            
                            <div class="form-help">
                                Add notes about follow-up actions, customer requirements, or any important details about this inquiry.
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Save Follow-up Reason
                            </button>
                            <a href="{{ route('admin.contacts.show', $contact->id) }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Right Column - Contact Info -->
        <div class="right-column">
            <!-- Contact Summary -->
            <div class="card">
                <div class="card-header">
                    <h3><i class="fas fa-user"></i> Contact Summary</h3>
                </div>
                <div class="card-body">
                    <div class="summary-item">
                        <div class="summary-label">Name</div>
                        <div class="summary-value">{{ $contact->name }}</div>
                    </div>
                    <div class="summary-item">
                        <div class="summary-label">Email</div>
                        <div class="summary-value">
                            <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
                        </div>
                    </div>
                    <div class="summary-item">
                        <div class="summary-label">Phone</div>
                        <div class="summary-value">
                            <a href="tel:{{ $contact->phone }}">{{ $contact->phone }}</a>
                        </div>
                    </div>
                    <div class="summary-item">
                        <div class="summary-label">Received</div>
                        <div class="summary-value">{{ $contact->created_at->format('M d, Y H:i') }}</div>
                    </div>
                </div>
            </div>

            <!-- Original Message -->
            <div class="card">
                <div class="card-header">
                    <h3><i class="fas fa-comment"></i> Original Message</h3>
                </div>
                <div class="card-body">
                    <div class="message-preview">
                        {{ $contact->message }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra_css')
<style>
    .contact-edit-page {
        animation: fadeIn 0.4s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .page-header {
        margin-bottom: 25px;
    }

    .btn-back {
        color: #666;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: color 0.2s;
    }

    .btn-back:hover {
        color: #333;
    }

    .content-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 20px;
    }

    .card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        margin-bottom: 20px;
    }

    .card-header {
        padding: 20px 25px;
        border-bottom: 1px solid #e5e5e5;
    }

    .card-header h3 {
        font-size: 18px;
        font-weight: 600;
        color: #333;
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 0;
    }

    .card-header h3 i {
        color: #666;
    }

    .card-body {
        padding: 25px;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-group label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
    }

    .required {
        color: #dc3545;
    }

    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #e5e5e5;
        border-radius: 6px;
        font-size: 14px;
        font-family: inherit;
        transition: all 0.2s;
        resize: vertical;
    }

    .form-control:focus {
        outline: none;
        border-color: #007bff;
        box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
    }

    .form-control.is-invalid {
        border-color: #dc3545;
    }

    .form-control.is-invalid:focus {
        box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1);
    }

    .error-message {
        color: #dc3545;
        font-size: 13px;
        margin-top: 8px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .form-help {
        color: #666;
        font-size: 13px;
        margin-top: 8px;
        font-style: italic;
    }

    .form-actions {
        display: flex;
        gap: 12px;
        margin-top: 30px;
    }

    .btn {
        padding: 12px 24px;
        border-radius: 6px;
        border: none;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
    }

    .btn-primary {
        background: #007bff;
        color: white;
    }

    .btn-primary:hover {
        background: #0056b3;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
    }

    .btn-secondary {
        background: #6c757d;
        color: white;
    }

    .btn-secondary:hover {
        background: #545b62;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(108, 117, 125, 0.3);
    }

    .summary-item {
        padding: 12px 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .summary-item:last-child {
        border-bottom: none;
    }

    .summary-label {
        font-size: 12px;
        color: #666;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 6px;
    }

    .summary-value {
        font-size: 14px;
        color: #333;
        font-weight: 600;
    }

    .summary-value a {
        color: #007bff;
        text-decoration: none;
    }

    .summary-value a:hover {
        text-decoration: underline;
    }

    .message-preview {
        color: #555;
        line-height: 1.6;
        font-size: 14px;
        white-space: pre-wrap;
        max-height: 200px;
        overflow-y: auto;
    }

    @media (max-width: 1024px) {
        .content-grid {
            grid-template-columns: 1fr;
        }

        .right-column {
            order: -1;
        }
    }

    @media (max-width: 768px) {
        .form-actions {
            flex-direction: column;
        }

        .btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endsection

