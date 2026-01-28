@extends('layouts.admin')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h2 class="fw-bold section-title">Branches</h2>
        <p class="text-muted">Manage your sauna locations</p>
    </div>
    <div class="col-md-6 text-md-end">
        <button type="button" class="btn btn-sauna" data-bs-toggle="modal" data-bs-target="#createBranchModal">
            <i class="bi bi-plus-lg me-2"></i>Add Branch
        </button>
    </div>
</div>

<div class="row">
    @foreach($branches as $branch)
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="glass-card h-100 p-4">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center text-primary" style="width: 50px; height: 50px; font-size: 1.5rem;">
                    <i class="bi bi-shop"></i>
                </div>
                <div class="dropdown">
                    <button class="btn btn-link text-muted p-0" data-bs-toggle="dropdown">
                        <i class="bi bi-three-dots-vertical"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <form action="{{ route('branches.destroy', $branch) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="bi bi-trash me-2"></i>Delete
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
            
            <h4 class="fw-bold mb-1">{{ $branch->name }}</h4>
            <div class="d-flex align-items-center text-muted mb-3">
                <i class="bi bi-geo-alt me-2"></i>
                {{ $branch->location }}
            </div>
            
            <hr class="border-secondary opacity-10">
            
            <div class="row g-2 text-center">
                <div class="col-6">
                    <div class="p-2 bg-light rounded-3">
                        <div class="h5 fw-bold mb-0 text-primary">{{ $branch->users_count ?? 0 }}</div>
                        <small class="text-muted">Staff</small>
                    </div>
                </div>
                <div class="col-6">
                    <div class="p-2 bg-light rounded-3">
                        <div class="h5 fw-bold mb-0 text-primary">{{ $branch->saunas_count ?? 0 }}</div>
                        <small class="text-muted">Saunas</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    
    @if($branches->isEmpty())
    <div class="col-12">
        <div class="glass-card text-center p-5">
            <div class="display-1 text-muted opacity-25 mb-3">
                <i class="bi bi-shop"></i>
            </div>
            <h4>No Branches Found</h4>
            <p class="text-muted">Get started by adding your first branch.</p>
            <button type="button" class="btn btn-outline-primary mt-2" data-bs-toggle="modal" data-bs-target="#createBranchModal">
                Create Branch
            </button>
        </div>
    </div>
    @endif
</div>

<!-- Create Branch Modal -->
<div class="modal fade" id="createBranchModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content glass-card border-0">
            <div class="modal-header border-bottom border-light border-opacity-10">
                <h5 class="modal-title fw-bold">Add New Branch</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('branches.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label text-muted">Branch Name</label>
                        <input type="text" name="name" class="form-control bg-light border-0" required placeholder="e.g. Downtown Branch">
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Location</label>
                        <input type="text" name="location" class="form-control bg-light border-0" required placeholder="e.g. 123 Main St, Nairobi">
                    </div>
                </div>
                <div class="modal-footer border-top border-light border-opacity-10">
                    <button type="button" class="btn btn-link text-muted text-decoration-none" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sauna">Create Branch</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
