@extends('admin.layouts.admin')

@section('title', 'View Contact')
@section('page-title', 'Contact Message Details')

@section('content')
<div class="contact-view-page">
    <!-- Header Actions -->
    <div class="page-header">
        <div class="header-left">
            <a href="{{ route('admin.contacts.index') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Back to Contacts
            </a>
        </div>
        <div class="header-right">
            <a href="{{ route('admin.contacts.edit', $contact->id) }}" class="btn btn-info">
                <i class="fas fa-edit"></i>
                {{ $contact->follow_up_reason ? 'Edit Follow-up' : 'Add Follow-up' }}
            </a>
            <form action="{{ route('admin.contacts.toggle-read', $contact->id) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn {{ $contact->is_read ? 'btn-warning' : 'btn-success' }}">
                    <i class="fas fa-{{ $contact->is_read ? 'envelope' : 'envelope-open' }}"></i>
                    {{ $contact->is_read ? 'Mark as Unread' : 'Mark as Read' }}
                </button>
            </form>
            <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this contact?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash"></i>
                    Delete
                </button>
            </form>
        </div>
    </div>

    <!-- Contact Header -->
    <div class="card contact-header">
        <div class="card-body">
            <div class="contact-title-section">
                <div>
                    <h1 class="contact-name">{{ $contact->name }}</h1>
                    <div class="contact-status">
                        @if($contact->is_read)
                            <span class="badge badge-success">
                                <i class="fas fa-check-circle"></i> Read
                            </span>
                        @else
                            <span class="badge badge-warning">
                                <i class="fas fa-circle"></i> New
                            </span>
                        @endif
                    </div>
                </div>
                <div class="contact-date">
                    <i class="fas fa-calendar-alt"></i>
                    {{ $contact->created_at->format('F d, Y') }} at {{ $contact->created_at->format('H:i A') }}
                </div>
            </div>
        </div>
    </div>

    <div class="content-grid">
        <!-- Left Column -->
        <div class="left-column">
            <!-- Message -->
            <div class="card">
                <div class="card-header">
                    <h3><i class="fas fa-comment"></i> Message</h3>
                </div>
                <div class="card-body">
                    <div class="message-text">
                        {{ $contact->message }}
                    </div>
                </div>
            </div>

            <!-- Follow-up Reason -->
            @if($contact->follow_up_reason)
            <div class="card follow-up-card">
                <div class="card-header">
                    <h3><i class="fas fa-clipboard-check"></i> Follow-up Reason / Notes</h3>
                </div>
                <div class="card-body">
                    <div class="follow-up-text">
                        {{ $contact->follow_up_reason }}
                    </div>
                </div>
            </div>
            @else
            <div class="card empty-follow-up">
                <div class="card-body text-center">
                    <i class="fas fa-clipboard-list empty-icon"></i>
                    <p class="empty-text">No follow-up reason added yet</p>
                    <a href="{{ route('admin.contacts.edit', $contact->id) }}" class="btn btn-info">
                        <i class="fas fa-plus"></i> Add Follow-up Reason
                    </a>
                </div>
            </div>
            @endif
        </div>

        <!-- Right Column -->
        <div class="right-column">
            <!-- Contact Information -->
            <div class="card">
                <div class="card-header">
                    <h3><i class="fas fa-user"></i> Contact Information</h3>
                </div>
                <div class="card-body">
                    <div class="info-list">
                        <div class="info-item">
                            <div class="info-label">
                                <i class="fas fa-user"></i> Name
                            </div>
                            <div class="info-value">{{ $contact->name }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">
                                <i class="fas fa-envelope"></i> Email
                            </div>
                            <div class="info-value">
                                <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">
                                <i class="fas fa-phone"></i> Phone
                            </div>
                            <div class="info-value">
                                <a href="tel:{{ $contact->phone }}">{{ $contact->phone }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card">
                <div class="card-header">
                    <h3><i class="fas fa-bolt"></i> Quick Actions</h3>
                </div>
                <div class="card-body">
                    <div class="action-buttons-vertical">
                        <a href="mailto:{{ $contact->email }}?subject=Re: Your Inquiry" class="action-btn">
                            <i class="fas fa-reply"></i>
                            Reply via Email
                        </a>
                        <a href="tel:{{ $contact->phone }}" class="action-btn">
                            <i class="fas fa-phone"></i>
                            Call Now
                        </a>
                    </div>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="card">
                <div class="card-header">
                    <h3><i class="fas fa-info-circle"></i> Message Information</h3>
                </div>
                <div class="card-body">
                    <div class="info-list">
                        <div class="info-item">
                            <div class="info-label">Received</div>
                            <div class="info-value">{{ $contact->created_at->format('M d, Y H:i') }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Status</div>
                            <div class="info-value">
                                @if($contact->is_read)
                                    <span class="badge badge-success">Read</span>
                                @else
                                    <span class="badge badge-warning">Unread</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra_css')
<style>
    .contact-view-page {
        animation: fadeIn 0.4s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .header-right {
        display: flex;
        gap: 10px;
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

    .btn {
        padding: 10px 20px;
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

    .btn-success {
        background: #28a745;
        color: white;
    }

    .btn-success:hover {
        background: #218838;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
    }

    .btn-warning {
        background: #ffc107;
        color: #333;
    }

    .btn-warning:hover {
        background: #e0a800;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(255, 193, 7, 0.3);
    }

    .btn-danger {
        background: #dc3545;
        color: white;
    }

    .btn-danger:hover {
        background: #c82333;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
    }

    .btn-info {
        background: #17a2b8;
        color: white;
    }

    .btn-info:hover {
        background: #138496;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(23, 162, 184, 0.3);
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

    .contact-header {
        margin-bottom: 25px;
    }

    .contact-title-section {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }

    .contact-name {
        font-size: 32px;
        font-weight: 600;
        color: #333;
        margin: 0 0 15px 0;
    }

    .contact-status {
        display: flex;
        gap: 8px;
    }

    .badge {
        padding: 6px 14px;
        border-radius: 4px;
        font-size: 13px;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .badge-warning {
        background: #fff3cd;
        color: #856404;
    }

    .badge-success {
        background: #d4edda;
        color: #155724;
    }

    .contact-date {
        color: #666;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .content-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 20px;
    }

    .message-text {
        color: #555;
        line-height: 1.8;
        font-size: 15px;
        white-space: pre-wrap;
    }

    .follow-up-card {
        border-left: 4px solid #17a2b8;
    }

    .follow-up-text {
        color: #555;
        line-height: 1.8;
        font-size: 15px;
        white-space: pre-wrap;
        background: #f8f9fa;
        padding: 15px;
        border-radius: 6px;
    }

    .empty-follow-up .card-body {
        padding: 40px 25px;
    }

    .empty-icon {
        font-size: 48px;
        color: #ddd;
        margin-bottom: 15px;
    }

    .empty-text {
        color: #999;
        margin-bottom: 20px;
        font-size: 15px;
    }

    .text-center {
        text-align: center;
    }

    .info-list {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .info-item {
        display: flex;
        flex-direction: column;
        gap: 8px;
        padding: 12px;
        background: #f8f9fa;
        border-radius: 6px;
    }

    .info-label {
        font-size: 12px;
        color: #666;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .info-value {
        font-size: 15px;
        color: #333;
        font-weight: 600;
    }

    .info-value a {
        color: #007bff;
        text-decoration: none;
    }

    .info-value a:hover {
        text-decoration: underline;
    }

    .action-buttons-vertical {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .action-btn {
        padding: 12px 20px;
        background: #f8f9fa;
        border-radius: 6px;
        text-decoration: none;
        color: #333;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s ease;
    }

    .action-btn:hover {
        background: #e9ecef;
        transform: translateX(5px);
    }

    .action-btn i {
        color: #007bff;
    }

    .d-inline {
        display: inline;
    }

    @media (max-width: 1024px) {
        .content-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }

        .header-right {
            width: 100%;
        }

        .header-right form {
            flex: 1;
        }

        .header-right .btn {
            flex: 1;
            justify-content: center;
        }

        .contact-name {
            font-size: 24px;
        }

        .contact-title-section {
            flex-direction: column;
            gap: 15px;
        }
    }
</style>
@endsection

