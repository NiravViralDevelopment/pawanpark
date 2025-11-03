@extends('admin.layouts.admin')

@section('title', 'Team Members')
@section('page-title', 'Manage Team Members')

@section('content')
<div class="teams-page">
    <!-- Header Actions -->
    <div class="page-header">
        <div class="header-left">
            <p class="page-description">Manage your team members</p>
        </div>
        <div class="header-right">
            <a href="{{ route('admin.teams.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i>
                Add New Team Member
            </a>
        </div>
    </div>

    <!-- Teams Table -->
    <div class="card">
        <div class="card-body">
            @if($teams->count() > 0)
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Phone</th>
                                <th>WhatsApp</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($teams as $team)
                                <tr>
                                    <td><strong>{{ $team->id }}</strong></td>
                                    <td>
                                        <div class="team-photo">
                                            @if($team->image)
                                                <img src="{{ asset($team->image) }}" alt="{{ $team->name }}">
                                            @else
                                                <div class="no-photo">
                                                    <i class="fas fa-user"></i>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td><strong>{{ $team->name }}</strong></td>
                                    <td>{{ $team->position }}</td>
                                    <td>{{ $team->phone_number ?: '-' }}</td>
                                    <td>{{ $team->whatsapp_number ?: '-' }}</td>
                                    <td>{{ $team->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ route('admin.teams.edit', $team) }}" class="btn-icon btn-edit" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.teams.destroy', $team) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this team member?');">
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
                    @if ($teams->hasPages())
                        <div class="pagination-info">
                            Showing {{ $teams->firstItem() }} to {{ $teams->lastItem() }} of {{ $teams->total() }} results
                        </div>

                        <nav class="pagination">
                            {{-- Previous Page Link --}}
                            @if ($teams->onFirstPage())
                                <span class="pagination-link disabled">
                                    <i class="fas fa-chevron-left"></i> Previous
                                </span>
                            @else
                                <a href="{{ $teams->previousPageUrl() }}" class="pagination-link">
                                    <i class="fas fa-chevron-left"></i> Previous
                                </a>
                            @endif

                            {{-- Page Numbers --}}
                            @for ($i = 1; $i <= $teams->lastPage(); $i++)
                                @if ($i == $teams->currentPage())
                                    <span class="pagination-link active">{{ $i }}</span>
                                @else
                                    <a href="{{ $teams->url($i) }}" class="pagination-link">{{ $i }}</a>
                                @endif
                            @endfor

                            {{-- Next Page Link --}}
                            @if ($teams->hasMorePages())
                                <a href="{{ $teams->nextPageUrl() }}" class="pagination-link">
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
                    <i class="fas fa-users"></i>
                    <h3>No Team Members Yet</h3>
                    <p>Start by adding your first team member</p>
                    <a href="{{ route('admin.teams.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        Add First Team Member
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('extra_css')
<style>
    .teams-page {
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

    .page-description {
        color: #666;
        margin-top: 5px;
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

    .btn-primary {
        background: #333;
        color: white;
    }

    .btn-primary:hover {
        background: #000;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    .card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .card-body {
        padding: 0;
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

    .team-photo {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .team-photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .no-photo {
        width: 100%;
        height: 100%;
        background: #f0f0f0;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #999;
        font-size: 24px;
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

    .btn-edit {
        color: #333;
    }

    .btn-edit:hover {
        background: #f0f0f0;
    }

    .btn-delete {
        color: #dc3545;
    }

    .btn-delete:hover {
        background: #ffe5e5;
    }

    .d-inline {
        display: inline-block;
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
        margin-bottom: 25px;
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
        background: #f8f9fa;
        color: #999;
        cursor: not-allowed;
        border-color: #ddd;
    }

    .pagination-info {
        color: #666;
        font-size: 14px;
    }
</style>
@endsection

