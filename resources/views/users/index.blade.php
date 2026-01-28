@extends('layouts.admin')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h2 class="fw-bold section-title">Staff Management</h2>
        <p class="text-muted">Manage system users and access roles</p>
    </div>
    <div class="col-md-6 text-md-end">
        <button type="button" class="btn btn-sauna" data-bs-toggle="modal" data-bs-target="#createUserModal">
            <i class="bi bi-person-plus me-2"></i>Add Staff
        </button>
    </div>
</div>

<div class="glass-card overflow-hidden">
    <div class="table-responsive">
        <table class="table table-borderless align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="ps-4">User</th>
                    <th>Role</th>
                    <th>Branch</th>
                    <th>Joined</th>
                    <th class="text-end pe-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr class="border-bottom border-light">
                    <td class="ps-4">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center fw-bold me-3" style="width: 40px; height: 40px;">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            <div>
                                <div class="fw-bold text-dark">{{ $user->name }}</div>
                                <div class="small text-muted">{{ $user->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        @if($user->role === 'admin')
                            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill">Administrator</span>
                        @else
                            <span class="badge bg-info bg-opacity-10 text-info px-3 py-2 rounded-pill">Manager</span>
                        @endif
                    </td>
                    <td>
                        @if($user->branch)
                            <div class="d-flex align-items-center text-dark">
                                <i class="bi bi-shop me-2 text-muted"></i>
                                {{ $user->branch->name }}
                            </div>
                        @elseif($user->role === 'admin')
                            <span class="text-muted fst-italic">All Branches</span>
                        @else
                            <span class="text-warning">Unassigned</span>
                        @endif
                    </td>
                    <td class="text-muted">
                        {{ $user->created_at->format('M d, Y') }}
                    </td>
                    <td class="text-end pe-4">
                        @if($user->id !== auth()->id())
                        <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('Delete this user?');" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-light text-danger hover-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Create User Modal -->
<div class="modal fade" id="createUserModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content glass-card border-0">
            <div class="modal-header border-bottom border-light border-opacity-10">
                <h5 class="modal-title fw-bold">Add New Staff Member</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label text-muted">Full Name</label>
                        <input type="text" name="name" class="form-control bg-light border-0" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Email Address</label>
                        <input type="email" name="email" class="form-control bg-light border-0" required>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label text-muted">Password</label>
                            <input type="password" name="password" class="form-control bg-light border-0" required minlength="6">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted">Role</label>
                            <select name="role" class="form-select bg-light border-0" onchange="toggleBranchSelect(this.value)">
                                <option value="manager">Manager</option>
                                <option value="admin">Administrator</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="mb-3" id="branchSelectGroup">
                        <label class="form-label text-muted">Assign Branch</label>
                        <select name="branch_id" class="form-select bg-light border-0">
                            <option value="">Select Branch...</option>
                            @foreach($branches as $branch)
                                <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                            @endforeach
                        </select>
                        <div class="form-text">Managers must be assigned to a branch.</div>
                    </div>
                </div>
                <div class="modal-footer border-top border-light border-opacity-10">
                    <button type="button" class="btn btn-link text-muted text-decoration-none" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sauna">Create Account</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function toggleBranchSelect(role) {
        const group = document.getElementById('branchSelectGroup');
        const select = group.querySelector('select');
        
        if (role === 'admin') {
            group.style.opacity = '0.5';
            group.style.pointerEvents = 'none';
            select.required = false;
            select.value = '';
        } else {
            group.style.opacity = '1';
            group.style.pointerEvents = 'auto';
            select.required = true;
        }
    }
</script>
@endsection
