@extends('admin.layouts.admin')

@section('title', 'Edit Project')
@section('page-title', 'Edit Project')

@section('content')
<div class="project-form-page">
    <div class="form-header">
        <a href="{{ route('admin.projects.index') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i> Back to Projects
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            {{-- Display Validation Errors --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Please fix the following errors:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data" id="project-form">
                @csrf
                @method('PUT')
                @include('admin.projects.form')
                
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i>
                        Update Project
                    </button>
                    <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('extra_js')
<script>
    // Delete image function
    function deleteImage(projectId, imageIndex) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/admin/projects/' + projectId + '/delete-image';
        
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = '{{ csrf_token() }}';
        
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';
        
        const indexInput = document.createElement('input');
        indexInput.type = 'hidden';
        indexInput.name = 'image_index';
        indexInput.value = imageIndex;
        
        form.appendChild(csrfInput);
        form.appendChild(methodInput);
        form.appendChild(indexInput);
        document.body.appendChild(form);
        form.submit();
    }
    
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Page loaded');
        
        const form = document.getElementById('project-form');
        const submitBtn = form ? form.querySelector('button[type="submit"]') : null;
        
        if (form && submitBtn) {
            form.addEventListener('submit', function(e) {
                console.log('Form submitting...');
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Updating...';
            });
        }
    });
</script>
@endsection

@section('extra_css')
<style>
    .project-form-page {
        animation: fadeIn 0.4s ease;
    }

    .form-header {
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

    .card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .card-body {
        padding: 30px;
    }

    .form-actions {
        display: flex;
        gap: 15px;
        margin-top: 30px;
        padding-top: 30px;
        border-top: 1px solid #e5e5e5;
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
        background: #333;
        color: white;
    }

    .btn-primary:hover {
        background: #000;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    .btn-secondary {
        background: #e5e5e5;
        color: #666;
    }

    .btn-secondary:hover {
        background: #d0d0d0;
    }
    
    .alert {
        padding: 15px 20px;
        border-radius: 6px;
        margin-bottom: 25px;
    }
    
    .alert-danger {
        background: #f8d7da;
        border: 1px solid #f5c2c7;
        color: #842029;
    }
    
    .alert strong {
        display: block;
        margin-bottom: 10px;
    }
    
    .alert ul {
        margin: 0;
        padding-left: 20px;
    }
    
    .alert li {
        margin: 5px 0;
    }
</style>
@endsection

