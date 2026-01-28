<?php $__env->startSection('content'); ?>
<div class="row mb-4">
    <div class="col-md-6">
        <h2 class="fw-bold section-title">Transactions</h2>
        <p class="text-muted">Track revenue and expenses</p>
    </div>
    <div class="col-md-6 text-md-end">
        <button type="button" class="btn btn-sauna" data-bs-toggle="modal" data-bs-target="#recordTransactionModal">
            <i class="bi bi-plus-lg me-2"></i>Record Transaction
        </button>
    </div>
</div>

<!-- Stats Overview -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="glass-card p-3 d-flex align-items-center">
            <div class="rounded-circle bg-success bg-opacity-10 text-success p-3 me-3">
                <i class="bi bi-arrow-down-left fs-4"></i>
            </div>
            <div>
                <small class="text-muted d-block uppercase tracking-wide">Total Income</small>
                <div class="h4 fw-bold mb-0 text-dark">
                    KES <?php echo e(number_format($transactions->where('type', 'income')->sum('amount'), 2)); ?>

                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="glass-card p-3 d-flex align-items-center">
            <div class="rounded-circle bg-danger bg-opacity-10 text-danger p-3 me-3">
                <i class="bi bi-arrow-up-right fs-4"></i>
            </div>
            <div>
                <small class="text-muted d-block uppercase tracking-wide">Total Expenses</small>
                <div class="h4 fw-bold mb-0 text-dark">
                    KES <?php echo e(number_format($transactions->where('type', 'expense')->sum('amount'), 2)); ?>

                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="glass-card p-3 d-flex align-items-center">
            <div class="rounded-circle bg-primary bg-opacity-10 text-primary p-3 me-3">
                <i class="bi bi-wallet2 fs-4"></i>
            </div>
            <div>
                <small class="text-muted d-block uppercase tracking-wide">Net Balance</small>
                <div class="h4 fw-bold mb-0 text-dark">
                    KES <?php echo e(number_format($transactions->where('type', 'income')->sum('amount') - $transactions->where('type', 'expense')->sum('amount'), 2)); ?>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="glass-card overflow-hidden">
    <div class="table-responsive">
        <table class="table table-borderless align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="ps-4">Date</th>
                    <th>Description</th>
                    <th>Branch</th>
                    <th>Staff</th>
                    <th>Type</th>
                    <th class="text-end pe-4">Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="border-bottom border-light">
                    <td class="ps-4 text-muted">
                        <?php echo e(\Carbon\Carbon::parse($transaction->date)->format('M d, Y')); ?>

                    </td>
                    <td>
                        <div class="fw-medium text-dark"><?php echo e($transaction->description ?: 'No description'); ?></div>
                    </td>
                    <td>
                        <?php if($transaction->branch): ?>
                            <span class="badge bg-light text-dark border"><?php echo e($transaction->branch->name); ?></span>
                        <?php else: ?>
                            <span class="text-muted small">-</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <small class="text-muted"><?php echo e($transaction->user->name); ?></small>
                    </td>
                    <td>
                        <?php if($transaction->type === 'income'): ?>
                            <span class="badge bg-success bg-opacity-10 text-success px-3 rounded-pill">Income</span>
                        <?php else: ?>
                            <span class="badge bg-danger bg-opacity-10 text-danger px-3 rounded-pill">Expense</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-end pe-4 fw-bold <?php echo e($transaction->type === 'income' ? 'text-success' : 'text-danger'); ?>">
                        <?php echo e($transaction->type === 'income' ? '+' : '-'); ?> KES <?php echo e(number_format($transaction->amount, 2)); ?>

                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="6" class="text-center py-5 text-muted">
                        <i class="bi bi-receipt display-4 opacity-25 mb-3 d-block"></i>
                        No transactions found.
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    <?php if($transactions->hasPages()): ?>
    <div class="p-4 border-top border-light">
        <?php echo e($transactions->links()); ?>

    </div>
    <?php endif; ?>
</div>

<!-- Record Transaction Modal -->
<div class="modal fade" id="recordTransactionModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content glass-card border-0">
            <div class="modal-header border-bottom border-light border-opacity-10">
                <h5 class="modal-title fw-bold">Record Transaction</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?php echo e(route('transactions.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label text-muted">Type</label>
                            <select name="type" class="form-select bg-light border-0" required>
                                <option value="income">Income</option>
                                <option value="expense">Expense</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted">Date</label>
                            <input type="date" name="date" class="form-control bg-light border-0" value="<?php echo e(date('Y-m-d')); ?>" required>
                        </div>
                    </div>
                    
                    <?php if(auth()->user()->role === 'admin'): ?>
                    <div class="mb-3">
                        <label class="form-label text-muted">Branch</label>
                        <select name="branch_id" class="form-select bg-light border-0" required>
                            <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($branch->id); ?>"><?php echo e($branch->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <?php endif; ?>

                    <div class="mb-3">
                        <label class="form-label text-muted">Amount (KES)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0">KES</span>
                            <input type="number" name="amount" class="form-control bg-light border-0" step="0.01" min="0" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label text-muted">Description</label>
                        <textarea name="description" class="form-control bg-light border-0" rows="3" placeholder="e.g. Sales for today, Utility bill payment..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-top border-light border-opacity-10">
                    <button type="button" class="btn btn-link text-muted text-decoration-none" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sauna">Save Transaction</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/dismas/Desktop/businessmanager/resources/views/transactions/index.blade.php ENDPATH**/ ?>