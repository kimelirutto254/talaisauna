<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-0">Dashboard Overview</h2>
        <p class="text-muted">Welcome back, <?php echo e(auth()->user()->name); ?></p>
    </div>
    <div class="d-flex gap-2">
        <button class="btn btn-sauna" data-bs-toggle="modal" data-bs-target="#addIncomeModal">
            <i class="bi bi-plus-lg me-1"></i> Add Sale
        </button>
        <button class="btn btn-outline-light rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#addExpenseModal">
            <i class="bi bi-dash-lg me-1"></i> Add Expense
        </button>
    </div>
</div>

<!-- Stats Row -->
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="glass-card p-4 h-100 d-flex align-items-center gap-3">
            <div class="stat-icon bg-success bg-opacity-25 text-success">
                <i class="bi bi-cash-coin"></i>
            </div>
            <div>
                <h6 class="text-muted mb-1">Total Sales</h6>
                <h3 class="fw-bold mb-0"><?php echo e(number_format($totalIncome)); ?></h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="glass-card p-4 h-100 d-flex align-items-center gap-3">
            <div class="stat-icon bg-danger bg-opacity-25 text-danger">
                <i class="bi bi-basket"></i>
            </div>
            <div>
                <h6 class="text-muted mb-1">Expenses</h6>
                <h3 class="fw-bold mb-0"><?php echo e(number_format($totalExpense)); ?></h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="glass-card p-4 h-100 d-flex align-items-center gap-3">
            <div class="stat-icon bg-info bg-opacity-25 text-info">
                <i class="bi bi-graph-up-arrow"></i>
            </div>
            <div>
                <h6 class="text-muted mb-1">Net Profit</h6>
                <h3 class="fw-bold mb-0 <?php echo e($profit >= 0 ? 'text-success' : 'text-danger'); ?>">
                    <?php echo e(number_format($profit)); ?>

                </h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="glass-card p-4 h-100 d-flex align-items-center gap-3">
            <div class="stat-icon bg-warning bg-opacity-25 text-warning">
                <i class="bi bi-shop-window"></i>
            </div>
            <div>
                <h6 class="text-muted mb-1">Active Branches</h6>
                <h3 class="fw-bold mb-0"><?php echo e($branches->count()); ?></h3>
            </div>
        </div>
    </div>
</div>

<!-- Main Content Grid -->
<div class="row g-4">
    <!-- Chart Section -->
    <div class="col-lg-8">
        <div class="glass-card p-4 h-100">
            <h5 class="fw-bold mb-4">Financial Overview (Last 7 Days)</h5>
            <canvas id="financeChart" style="max-height: 350px;"></canvas>
        </div>
    </div>

    <!-- Branch Summary Side -->
    <div class="col-lg-4">
        <div class="glass-card p-4 h-100">
            <h5 class="fw-bold mb-4">Branch Performance</h5>
            <div class="d-flex flex-column gap-3">
                <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $bProfit = $branch->transactions->where('type', 'income')->sum('amount') - 
                                   $branch->transactions->where('type', 'expense')->sum('amount');
                    ?>
                    <div class="p-3 rounded-3 bg-white bg-opacity-5 border border-light border-opacity-10">
                        <div class="d-flex justify-content-between mb-2">
                            <h6 class="fw-bold mb-0"><?php echo e($branch->name); ?></h6>
                            <span class="badge <?php echo e($bProfit >= 0 ? 'bg-success' : 'bg-danger'); ?>">
                                <?php echo e(number_format($bProfit)); ?>

                            </span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 70%"></div>
                        </div>
                        <small class="text-muted mt-2 d-block"><?php echo e($branch->location); ?></small>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</div>

<!-- Modals -->

<!-- Income Modal -->
<div class="modal fade" id="addIncomeModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content glass-card border-0">
            <div class="modal-header border-bottom border-secondary border-opacity-25">
                <h5 class="modal-title">Record New Sale</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?php echo e(route('transactions.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="type" value="income">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label text-muted">Branch</label>
                        <select name="branch_id" class="form-select" required>
                            <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($branch->id); ?>"><?php echo e($branch->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Amount (KES)</label>
                        <div class="input-group">
                            <span class="input-group-text">KES</span>
                            <input type="number" name="amount" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Service / Description</label>
                        <input type="text" name="description" class="form-control" placeholder="e.g. Sauna Session, Massage" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Date</label>
                        <input type="date" name="date" class="form-control" value="<?php echo e(date('Y-m-d')); ?>" required>
                    </div>
                </div>
                <div class="modal-footer border-top border-secondary border-opacity-25">
                    <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success px-4">Save Sale</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Expense Modal -->
<div class="modal fade" id="addExpenseModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content glass-card border-0">
            <div class="modal-header border-bottom border-secondary border-opacity-25">
                <h5 class="modal-title text-danger">Record New Expense</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?php echo e(route('transactions.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="type" value="expense">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label text-muted">Branch</label>
                        <select name="branch_id" class="form-select" required>
                            <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($branch->id); ?>"><?php echo e($branch->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Amount (KES)</label>
                        <div class="input-group">
                            <span class="input-group-text">KES</span>
                            <input type="number" name="amount" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Description</label>
                        <input type="text" name="description" class="form-control" placeholder="e.g. Cleaning Supplies, Electricity" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Date</label>
                        <input type="date" name="date" class="form-control" value="<?php echo e(date('Y-m-d')); ?>" required>
                    </div>
                </div>
                <div class="modal-footer border-top border-secondary border-opacity-25">
                    <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger px-4">Save Expense</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const ctx = document.getElementById('financeChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($chartData['labels']); ?>,
            datasets: [
                {
                    label: 'Sales',
                    data: <?php echo json_encode($chartData['income']); ?>,
                    borderColor: '#198754', // Success green
                    backgroundColor: 'rgba(25, 135, 84, 0.1)',
                    tension: 0.4,
                    fill: true
                },
                {
                    label: 'Expenses',
                    data: <?php echo json_encode($chartData['expense']); ?>,
                    borderColor: '#dc3545', // Danger red
                    backgroundColor: 'rgba(220, 53, 69, 0.1)',
                    tension: 0.4,
                    fill: true
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    labels: { color: '#64748b' } // text-muted color
                }
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/dismas/Desktop/businessmanager/resources/views/dashboard/admin.blade.php ENDPATH**/ ?>