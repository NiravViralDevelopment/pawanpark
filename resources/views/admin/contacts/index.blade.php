@extends('admin.layouts.admin')

@section('title', 'Contacts')
@section('page-title', 'Contact Messages')

@section('content')
<div class="contacts-page">
    <!-- Header Actions -->
    <div class="page-header">
        <div class="header-left">
            <p class="page-description">View and manage all contact form submissions</p>
        </div>
    </div>

    <!-- Search and Filter Section -->
    <div class="card search-card">
        <div class="card-body">
            <form action="{{ route('admin.contacts.index') }}" method="GET" id="searchForm">
                <div class="search-header">
                    <h3><i class="fas fa-search"></i> Search & Filter</h3>
                    <div class="search-actions">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i> Search
                        </button>
                        <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary">
                            <i class="fas fa-redo"></i> Reset
                        </a>
                        <button type="button" class="btn btn-success" onclick="exportContacts()">
                            <i class="fas fa-download"></i> Export CSV
                        </button>
                    </div>
                </div>
                
                <div class="search-fields">
                    <div class="search-row">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" 
                                   value="{{ request('name') }}" placeholder="Search by name...">
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" 
                                   value="{{ request('email') }}" placeholder="Search by email...">
                        </div>
                        
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" name="phone" id="phone" class="form-control" 
                                   value="{{ request('phone') }}" placeholder="Search by phone...">
                        </div>
                        
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="">All Status</option>
                                <option value="read" {{ request('status') == 'read' ? 'selected' : '' }}>Read</option>
                                <option value="unread" {{ request('status') == 'unread' ? 'selected' : '' }}>Unread</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="search-row">
                        <div class="form-group full-width">
                            <label for="message">Message Content</label>
                            <input type="text" name="message" id="message" class="form-control" 
                                   value="{{ request('message') }}" placeholder="Search in message content...">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Contacts Table -->
    <div class="card">
        <div class="card-body">
            @if($contacts->count() > 0)
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Message</th>
                                <th>Status</th>
                                <th>Received</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contacts as $contact)
                                <tr class="{{ !$contact->is_read ? 'unread' : '' }}">
                                    <td>
                                        <strong>{{ $contact->name }}</strong>
                                    </td>
                                    <td>
                                        <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
                                    </td>
                                    <td>
                                        <a href="tel:{{ $contact->phone }}">{{ $contact->phone }}</a>
                                    </td>
                                    <td>
                                        <div class="message-preview">
                                            {{ Str::limit($contact->message, 60) }}
                                        </div>
                                    </td>
                                    <td>
                                        @if($contact->is_read)
                                            <span class="badge badge-success">Read</span>
                                        @else
                                            <span class="badge badge-warning">New</span>
                                        @endif
                                    </td>
                                    <td>{{ $contact->created_at->format('M d, Y H:i') }}</td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ route('admin.contacts.show', $contact->id) }}" class="btn-icon btn-view" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.contacts.edit', $contact->id) }}" class="btn-icon btn-edit" title="Add/Edit Follow-up">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.contacts.toggle-read', $contact->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn-icon btn-toggle" title="{{ $contact->is_read ? 'Mark as Unread' : 'Mark as Read' }}">
                                                    <i class="fas fa-{{ $contact->is_read ? 'envelope' : 'envelope-open' }}"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this contact?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-icon btn-delete" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="pagination-wrapper">
                    @if ($contacts->hasPages())
                        <div class="pagination-info">
                            Showing {{ $contacts->firstItem() }} to {{ $contacts->lastItem() }} of {{ $contacts->total() }} results
                        </div>

                        <nav class="pagination">
                            {{-- Previous Page Link --}}
                            @if ($contacts->onFirstPage())
                                <span class="pagination-link disabled">
                                    <i class="fas fa-chevron-left"></i> Previous
                                </span>
                            @else
                                <a href="{{ $contacts->previousPageUrl() }}" class="pagination-link">
                                    <i class="fas fa-chevron-left"></i> Previous
                                </a>
                            @endif

                            {{-- Page Numbers --}}
                            @for ($i = 1; $i <= $contacts->lastPage(); $i++)
                                @if ($i == $contacts->currentPage())
                                    <span class="pagination-link active">{{ $i }}</span>
                                @else
                                    <a href="{{ $contacts->url($i) }}" class="pagination-link">{{ $i }}</a>
                                @endif
                            @endfor

                            {{-- Next Page Link --}}
                            @if ($contacts->hasMorePages())
                                <a href="{{ $contacts->nextPageUrl() }}" class="pagination-link">
                                    Next <i class="fas fa-chevron-right"></i>
                                </a>
                            @else
                                <span class="pagination-link disabled">
                                    Next <i class="fas fa-chevron-right"></i>
                                </span>
                            @endif
                        </nav>
                    @endif
                </div>
            @else
                <div class="empty-state">
                    <i class="fas fa-envelope"></i>
                    <h3>No Messages Yet</h3>
                    <p>Contact form submissions will appear here</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('extra_css')
<style>
    .contacts-page {
        animation: fadeIn 0.4s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .page-header {
        margin-bottom: 25px;
    }

    .page-description {
        color: #666;
        margin-top: 5px;
    }

    .card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        margin-bottom: 20px;
    }

    .card-body {
        padding: 0;
    }

    /* Search Card Styles */
    .search-card .card-body {
        padding: 25px;
    }

    .search-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        flex-wrap: wrap;
        gap: 15px;
    }

    .search-header h3 {
        margin: 0;
        font-size: 18px;
        font-weight: 600;
        color: #333;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .search-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .btn {
        padding: 10px 20px;
        border: none;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        white-space: nowrap;
    }

    .btn-primary {
        background: #007bff;
        color: white;
    }

    .btn-primary:hover {
        background: #0056b3;
    }

    .btn-secondary {
        background: #6c757d;
        color: white;
    }

    .btn-secondary:hover {
        background: #545b62;
    }

    .btn-success {
        background: #28a745;
        color: white;
    }

    .btn-success:hover {
        background: #218838;
    }

    .search-fields {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .search-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group.full-width {
        grid-column: 1 / -1;
    }

    .form-group label {
        font-size: 14px;
        font-weight: 500;
        color: #333;
        margin-bottom: 6px;
    }

    .form-control {
        padding: 10px 14px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 14px;
        transition: all 0.2s;
    }

    .form-control:focus {
        outline: none;
        border-color: #007bff;
        box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
    }

    .table-responsive {
        overflow-x: auto;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table thead {
        background: #f8f9fa;
    }

    .table th {
        padding: 15px;
        text-align: left;
        font-weight: 600;
        font-size: 14px;
        color: #333;
        border-bottom: 2px solid #e5e5e5;
    }

    .table td {
        padding: 15px;
        border-bottom: 1px solid #f0f0f0;
        font-size: 14px;
        vertical-align: middle;
    }

    .table tbody tr:hover {
        background: #f8f9fa;
    }

    .table tbody tr.unread {
        background: #fff9e6;
        font-weight: 500;
    }

    .table tbody tr.unread:hover {
        background: #fff3cd;
    }

    .message-preview {
        max-width: 200px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        color: #666;
    }

    .badge {
        padding: 4px 10px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 500;
    }

    .badge-warning {
        background: #fff3cd;
        color: #856404;
    }

    .badge-success {
        background: #d4edda;
        color: #155724;
    }

    .action-buttons {
        display: flex;
        gap: 8px;
    }

    .btn-icon {
        width: 32px;
        height: 32px;
        border-radius: 4px;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
        background: none;
        text-decoration: none;
    }

    .btn-view {
        color: #007bff;
    }

    .btn-view:hover {
        background: #e7f3ff;
    }

    .btn-edit {
        color: #17a2b8;
    }

    .btn-edit:hover {
        background: #d1ecf1;
    }

    .btn-toggle {
        color: #28a745;
    }

    .btn-toggle:hover {
        background: #d4edda;
    }

    .btn-delete {
        color: #dc3545;
    }

    .btn-delete:hover {
        background: #ffe5e5;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }

    .empty-state i {
        font-size: 60px;
        color: #ddd;
        margin-bottom: 20px;
    }

    .empty-state h3 {
        font-size: 22px;
        color: #333;
        margin-bottom: 10px;
    }

    .empty-state p {
        color: #999;
    }

    .pagination-wrapper {
        padding: 20px;
        border-top: 1px solid #e5e5e5;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
    }

    .pagination {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .pagination-link {
        min-width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0 12px;
        border: 1px solid #ddd;
        border-radius: 6px;
        color: #333;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.2s ease;
        background: white;
    }

    .pagination-link:hover:not(.disabled):not(.active) {
        background: #f8f9fa;
        border-color: #333;
        color: #333;
    }

    .pagination-link.active {
        background: #333;
        color: white;
        border-color: #333;
    }

    .pagination-link.disabled {
        opacity: 0.5;
        cursor: not-allowed;
        background: #f8f9fa;
    }

    .pagination-info {
        font-size: 14px;
        color: #666;
    }

    .d-inline {
        display: inline;
    }

    @media (max-width: 768px) {
        .search-header {
            flex-direction: column;
            align-items: stretch;
        }

        .search-actions {
            width: 100%;
        }

        .search-actions .btn {
            flex: 1;
        }

        .search-row {
            grid-template-columns: 1fr;
        }

        .table {
            font-size: 12px;
        }

        .table th, .table td {
            padding: 10px;
        }

        .message-preview {
            max-width: 150px;
        }

        .pagination-wrapper {
            flex-direction: column-reverse;
            align-items: stretch;
        }

        .pagination {
            flex-wrap: wrap;
            justify-content: center;
        }

        .pagination-info {
            text-align: center;
        }
    }
</style>
@endsection

@section('extra_js')
<script>
    function exportContacts() {
        // Get the form data
        const form = document.getElementById('searchForm');
        const formData = new FormData(form);
        
        // Build query string
        const params = new URLSearchParams(formData);
        const queryString = params.toString();
        
        // Construct export URL with filters
        const exportUrl = '{{ route("admin.contacts.export") }}' + (queryString ? '?' + queryString : '');
        
        // Redirect to export URL
        window.location.href = exportUrl;
    }
</script>
@endsection

