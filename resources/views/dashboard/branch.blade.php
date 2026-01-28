@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-0">{{ $branch->name }}</h2>
        <p class="text-muted">{{ $branch->location }} - Manager Dashboard</p>
    </div>
    <div class="d-flex gap-2">
        <button class="btn btn-sauna" data-bs-toggle="modal" data-bs-target="#addIncomeModal">
            <i class="bi bi-plus-lg me-1"></i> New Sale
        </button>
        <button class="btn btn-outline-light rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#addExpenseModal">
            <i class="bi bi-dash-lg me-1"></i> Expnese
        </button>
    </div>
</div>

<!-- Stats Row -->
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="glass-card p-4 h-100 d-flex align-items-center gap-3">
            <div class="stat-icon bg-success bg-opacity-25 text-success">
                <i class="bi bi-wallet2"></i>
            </div>
            <div>
                <h6 class="text-muted mb-1">Total Sales</h6>
                <h3 class="fw-bold mb-0">{{ number_format($totalIncome) }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="glass-card p-4 h-100 d-flex align-items-center gap-3">
            <div class="stat-icon bg-danger bg-opacity-25 text-danger">
                <i class="bi bi-cart"></i>
            </div>
            <div>
                <h6 class="text-muted mb-1">Total Expenses</h6>
                <h3 class="fw-bold mb-0">{{ number_format($totalExpense) }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="glass-card p-4 h-100 d-flex align-items-center gap-3">
            <div class="stat-icon bg-primary bg-opacity-25 text-primary">
                <i class="bi bi-graph-up"></i>
            </div>
            <div>
                <h6 class="text-muted mb-1">Branch Profit</h6>
                <h3 class="fw-bold mb-0 {{ $profit >= 0 ? 'text-success' : 'text-danger' }}">
                    {{ number_format($profit) }}
                </h3>
            </div>
        </div>
    </div>
</div>

<!-- Chart & History Grid -->
<div class="row g-4">
    <div class="col-lg-8">
        <div class="glass-card p-4 mb-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0">Active Sessions</h5>
                <button class="btn btn-sm btn-outline-primary rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#newSessionModal">
                    <i class="bi bi-clock-history me-1"></i> New Session
                </button>
            </div>
            
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="text-muted small">
                        <tr>
                            <th>#</th>
                            <th>Customer</th>
                            <th>Sauna</th>
                            <th>Time Remaining</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($activeSessions as $session)
                            @php
                                $remaining = $session->expected_end_time->diffInMinutes(now(), false);
                                $isOverdue = $remaining > 0; // diffInMinutes returns positive if now > expected (wait, no. diff is absolute usually unless specific. Let's check logic.)
                                // Carbon diffInMinutes(now(), false): 
                                // if expected 10:00, now 09:50 -> 10. (Positive = future?) 
                                // actually: $date->diffInMinutes($now, false). If date is future, diff is negative?.
                                // Let's use simpler logic.
                                $minutesLeft = now()->diffInMinutes($session->expected_end_time, false);
                            @endphp
                            <tr>
                                <td>{{ $session->id }}</td>
                                <td>
                                    <div>{{ $session->customer?->name ?? 'Walk-in' }}</div>
                                    <small class="text-muted">{{ $session->customer?->phone }}</small>
                                </td>
                                <td>{{ $session->sauna->name }}</td>
                                <td>
                                    @if($minutesLeft > 0)
                                        <span class="text-success">{{ $minutesLeft }} min left</span>
                                    @else
                                        <span class="text-danger fw-bold">{{ abs($minutesLeft) }} min overdue</span>
                                    @endif
                                </td>
                                <td>
                                    @if($session->payments->sum('amount') >= $session->sauna->price)
                                        <span class="badge bg-success">Paid</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Unpaid</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-light border" type="button" data-bs-toggle="dropdown">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#paymentModal{{ $session->id }}">
                                                    <i class="bi bi-cash me-2"></i> Record Payment
                                                </button>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <form action="{{ route('sessions.checkout', $session->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item text-danger">
                                                        <i class="bi bi-box-arrow-right me-2"></i> Checkout
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                    
                                    <!-- Payment Modal nested/loop -->
                                    <div class="modal fade" id="paymentModal{{ $session->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-sm modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">Payment #{{ $session->id }}</h6>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <form action="{{ route('sessions.pay', $session->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body text-start">
                                                        <div class="mb-2">
                                                            <label class="small text-muted">Amount Due</label>
                                                            <input type="number" name="amount" class="form-control" value="{{ max(0, $session->sauna->price - $session->payments->sum('amount')) }}">
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="small text-muted">Method</label>
                                                            <select name="method" class="form-select">
                                                                <option value="mpesa">M-Pesa</option>
                                                                <option value="cash">Cash</option>
                                                                <option value="card">Card</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="small text-muted">Ref (Optional)</label>
                                                            <input type="text" name="reference" class="form-control" placeholder="M-Pesa Code">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary btn-sm w-100">Record</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">No active sessions.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="glass-card p-4 mb-4">
            <h5 class="fw-bold mb-4">Weekly Performance</h5>
            <canvas id="financeChart" style="max-height: 300px;"></canvas>
        </div>
        
        <div class="glass-card">
            <div class="card-header bg-transparent border-bottom border-light border-opacity-10 p-4">
                <h5 class="fw-bold mb-0">Recent Transactions</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="text-muted small text-uppercase">
                        <tr>
                            <th class="ps-4">Date</th>
                            <th>Description</th>
                            <th>Type</th>
                            <th class="text-end pe-4">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transactions->take(10) as $trx)
                            <tr>
                                <td class="ps-4">{{ $trx->date->format('M d') }}</td>
                                <td>{{ $trx->description }}</td>
                                <td>
                                    @if($trx->type == 'income')
                                        <span class="badge bg-success bg-opacity-25 text-success">Sale</span>
                                    @else
                                        <span class="badge bg-danger bg-opacity-25 text-danger">Expense</span>
                                    @endif
                                </td>
                                <td class="text-end pe-4 fw-bold {{ $trx->type == 'income' ? 'text-success' : 'text-danger' }}">
                                    {{ number_format($trx->amount) }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">No transactions recorded yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Quick Actions / Info -->
    <div class="col-lg-4">
        <div class="glass-card p-4 h-100">
            <h5 class="fw-bold mb-4">Quick Guide</h5>
            <div class="d-flex flex-column gap-3">
                <div class="p-3 bg-white bg-opacity-5 rounded-3 d-flex gap-3">
                    <i class="bi bi-info-circle text-info fs-4"></i>
                    <div>
                        <h6 class="fw-bold mb-1">Recording Sales</h6>
                        <p class="text-muted small mb-0">Ensure to capture all daily sauna sessions and product sales separately for better tracking.</p>
                    </div>
                </div>
                <div class="p-3 bg-white bg-opacity-5 rounded-3 d-flex gap-3">
                    <i class="bi bi-exclamation-triangle text-warning fs-4"></i>
                    <div>
                        <h6 class="fw-bold mb-1">Expense Policies</h6>
                        <p class="text-muted small mb-0">Expenses above 5,000 KES might need admin approval. Keep receipts handy.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Income Modal -->
<div class="modal fade" id="addIncomeModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content glass-card border-0">
            <div class="modal-header border-bottom border-light border-opacity-10">
                <h5 class="modal-title">New Sale</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('transactions.store') }}" method="POST">
                @csrf
                <input type="hidden" name="type" value="income">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label text-muted">Amount</label>
                        <input type="number" name="amount" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Description</label>
                        <input type="text" name="description" class="form-control" placeholder="e.g. VIP Session" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Date</label>
                        <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}" required>
                    </div>
                </div>
                <div class="modal-footer border-top border-light border-opacity-10">
                    <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Save Sale</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Expense Modal -->
<div class="modal fade" id="addExpenseModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content glass-card border-0">
            <div class="modal-header border-bottom border-light border-opacity-10">
                <h5 class="modal-title text-danger">New Expense</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('transactions.store') }}" method="POST">
                @csrf
                <input type="hidden" name="type" value="expense">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label text-muted">Amount</label>
                        <input type="number" name="amount" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Description</label>
                        <input type="text" name="description" class="form-control" placeholder="e.g. Towel Laundry" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Date</label>
                        <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}" required>
                    </div>
                </div>
                <div class="modal-footer border-top border-light border-opacity-10">
                    <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Save Expense</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- New Session Modal -->
<div class="modal fade" id="newSessionModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content glass-card border-0">
            <div class="modal-header border-bottom border-light border-opacity-10">
                <h5 class="modal-title">Start New Session</h5> // Using "Sessions" as requested
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
                <form action="{{ route('sessions.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label text-muted">Select Sauna / Room</label>
                        <select name="sauna_id" id="saunaSelect" class="form-select" required onchange="updatePricingRules()">
                            <option value="">Choose Sauna...</option>
                            @foreach($saunas as $sauna)
                                <option value="{{ $sauna->id }}" 
                                    data-default-price="{{ $sauna->price }}"
                                    data-default-duration="{{ $sauna->session_duration }}"
                                    data-rules="{{ json_encode($sauna->pricingRules) }}">
                                    {{ $sauna->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted">Pricing Scheme</label>
                        <select name="pricing_rule_id" id="pricingRuleSelect" class="form-select" onchange="updateDurationFromRule()">
                            <option value="">Default (Flat Rate)</option>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="form-label text-muted">Customer Name (Opt)</label>
                            <input type="text" name="customer_name" class="form-control" placeholder="Walk-in">
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label text-muted">Phone (Opt)</label>
                            <input type="text" name="phone" class="form-control" placeholder="07...">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label text-muted">Duration (Minutes)</label>
                        <input type="number" name="duration" id="durationInput" class="form-control" value="60" required>
                    </div>
                </div>
                <div class="modal-footer border-top border-light border-opacity-10">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Check In</button>
                </div>
            </form>

            <script>
                function updatePricingRules() {
                    const saunaSelect = document.getElementById('saunaSelect');
                    const ruleSelect = document.getElementById('pricingRuleSelect');
                    const durationInput = document.getElementById('durationInput');
                    
                    const selectedOption = saunaSelect.options[saunaSelect.selectedIndex];
                    const rules = JSON.parse(selectedOption.getAttribute('data-rules') || '[]');
                    const defaultPrice = selectedOption.getAttribute('data-default-price');
                    const defaultDuration = selectedOption.getAttribute('data-default-duration');

                    // Reset options
                    ruleSelect.innerHTML = `<option value="">Default - KES ${defaultPrice}</option>`;
                    
                    // Add rules
                    rules.forEach(rule => {
                        let text = '';
                        if(rule.price_type === 'flat') text = `Flat Rate - KES ${rule.price}`;
                        else if(rule.price_type === 'per_person') text = `Per Person - KES ${rule.price}`;
                        else if(rule.price_type === 'per_hour') text = `Per Hour - KES ${rule.price}/hr`;
                        
                        const option = document.createElement('option');
                        option.value = rule.id;
                        option.text = text;
                        option.setAttribute('data-type', rule.price_type);
                        ruleSelect.add(option);
                    });

                    // Set default duration
                    if(defaultDuration) {
                        durationInput.value = defaultDuration;
                    }
                }

                function updateDurationFromRule() {
                    // Logic to adjust duration if needed based on rule (optional for now)
                }
            </script>
        </div>
    </div>
</div>

<!-- Chart Script -->
<script>
    const ctx = document.getElementById('financeChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar', // Using Bar for manager view variety
        data: {
            labels: {!! json_encode($chartData['labels']) !!},
            datasets: [
                {
                    label: 'Sales',
                    data: {!! json_encode($chartData['income']) !!},
                    backgroundColor: '#198754',
                    borderRadius: 4
                },
                {
                    label: 'Expenses',
                    data: {!! json_encode($chartData['expense']) !!},
                    backgroundColor: '#dc3545',
                    borderRadius: 4
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { labels: { color: '#64748b' } }
            },
            scales: {
                y: {
                    grid: { color: '#e2e8f0' },
                    ticks: { color: '#64748b' }
                },
                x: {
                    grid: { display: false },
                    ticks: { color: '#64748b' }
                }
            }
        }
    });
</script>
@endsection
