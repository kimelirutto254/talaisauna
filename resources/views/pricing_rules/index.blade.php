@extends('layouts.admin')

@section('content')
<div class="row g-4">
    <!-- List Rules -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm glass-card h-100">
            <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold theme-text">Current Pricing Rules</h5>
            </div>
            <div class="card-body">
                @if($rules->isEmpty())
                    <p class="text-muted text-center py-4">No pricing rules found. Create one to get started.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Sauna</th>
                                    <th>Type</th>
                                    <th>Price (KES)</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rules as $rule)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle bg-primary bg-opacity-10 p-2 me-2 text-primary">
                                                    <i class="bi bi-shop"></i>
                                                </div>
                                                <span class="fw-semibold">{{ $rule->sauna->name ?? 'Unknown Sauna' }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            @if($rule->price_type == 'flat')
                                                <span class="badge bg-info bg-opacity-10 text-info">Flat Rate</span>
                                            @elseif($rule->price_type == 'per_person')
                                                <span class="badge bg-success bg-opacity-10 text-success">Per Person</span>
                                            @elseif($rule->price_type == 'per_hour')
                                                <span class="badge bg-warning bg-opacity-10 text-warning">Per Hour</span>
                                            @endif
                                        </td>
                                        <td class="fw-bold">{{ number_format($rule->price, 2) }}</td>
                                        <td class="text-end">
                                            <form action="{{ route('pricing-rules.destroy', $rule) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this rule?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger border-0">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Add New Rule -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm glass-card">
            <div class="card-header bg-transparent border-0">
                <h5 class="mb-0 fw-bold theme-text">Add New Rule</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('pricing-rules.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label text-muted small text-uppercase fw-bold">Select Sauna</label>
                        <select name="sauna_id" class="form-select @error('sauna_id') is-invalid @enderror" required>
                            <option value="">Choose...</option>
                            @foreach($saunas as $sauna)
                                <option value="{{ $sauna->id }}">{{ $sauna->name }} ({{ $sauna->branch->name ?? 'N/A' }})</option>
                            @endforeach
                        </select>
                        @error('sauna_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted small text-uppercase fw-bold">Price Type</label>
                        <select name="price_type" class="form-select @error('price_type') is-invalid @enderror" required>
                            <option value="flat">Flat Rate (Fixed)</option>
                            <option value="per_person">Per Person</option>
                            <option value="per_hour">Per Hour</option>
                        </select>
                        @error('price_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted small text-uppercase fw-bold">Price Amount (KES)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">KES</span>
                            <input type="number" step="0.01" name="price" class="form-control border-start-0 @error('price') is-invalid @enderror" placeholder="0.00" required>
                        </div>
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-plus-lg me-1"></i> Add Pricing Rule
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
