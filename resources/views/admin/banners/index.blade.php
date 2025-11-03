@extends('admin.layouts.admin')

@section('title', 'Banners')
@section('page-title', 'Manage Banners')

@section('content')
<div class="banners-page">
    <!-- Header Actions -->
    <div class="page-header">
        <div class="header-left">
            <p class="page-description">Manage website banners</p>
        </div>
        <div class="header-right">
            <a href="{{ route('admin.banners.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i>
                Add New Banner
            </a>
        </div>
    </div>

    <!-- Banners Table -->
    <div class="card">
        <div class="card-body">
            @if($banners->count() > 0)
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Banner Image</th>
                                <th>Status</th>
                                <th>Order</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($banners as $banner)
                                <tr>
                                    <td><strong>{{ $banner->id }}</strong></td>
                                    <td>
                                        <div class="banner-preview">
                                            <img src="{{ asset($banner->image) }}" alt="Banner {{ $banner->id }}">
                                        </div>
                                    </td>
                                    <td>
                                        @if($banner->is_active)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td>{{ $banner->order }}</td>
                                    <td>{{ $banner->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ route('admin.banners.edit', $banner) }}" class="btn-icon btn-edit" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.banners.destroy', $banner) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this banner?');">
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
                    @if ($banners->hasPages())
                        <div class="pagination-info">
                            Showing {{ $banners->firstItem() }} to {{ $banners->lastItem() }} of {{ $banners->total() }} results
                        </div>

                        <nav class="pagination">
                            {{-- Previous Page Link --}}
                            @if ($banners->onFirstPage())
                                <span class="pagination-link disabled">
                                    <i class="fas fa-chevron-left"></i> Previous
                                </span>
                            @else
                                <a href="{{ $banners->previousPageUrl() }}" class="pagination-link">
                                    <i class="fas fa-chevron-left"></i> Previous
                                </a>
                            @endif

                            {{-- Page Numbers --}}
                            @for ($i = 1; $i <= $banners->lastPage(); $i++)
                                @if ($i == $banners->currentPage())
                                    <span class="pagination-link active">{{ $i }}</span>
                                @else
                                    <a href="{{ $banners->url($i) }}" class="pagination-link">{{ $i }}</a>
                                @endif
                            @endfor

                            {{-- Next Page Link --}}
                            @if ($banners->hasMorePages())
                                <a href="{{ $banners->nextPageUrl() }}" class="pagination-link">
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
                    <i class="fas fa-images"></i>
                    <h3>No Banners Yet</h3>
                    <p>Start by creating your first banner</p>
                    <a href="{{ route('admin.banners.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        Add First Banner
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('extra_css')
<style>
    .banners-page {
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

    .banner-preview {
        width: 200px;
        height: 80px;
        overflow: hidden;
        border-radius: 6px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .banner-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .badge {
        padding: 4px 10px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 500;
    }

    .badge-success {
        background: #d4edda;
        color: #155724;
    }

    .badge-secondary {
        background: #e2e3e5;
        color: #383d41;
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
