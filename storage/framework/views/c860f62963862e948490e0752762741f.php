<?php $__env->startSection('content'); ?>
<div class="row g-4">
    <!-- List Rules -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm glass-card h-100">
            <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold theme-text">Current Pricing Rules</h5>
            </div>
            <div class="card-body">
                <?php if($rules->isEmpty()): ?>
                    <p class="text-muted text-center py-4">No pricing rules found. Create one to get started.</p>
                <?php else: ?>
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
                                <?php $__currentLoopData = $rules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle bg-primary bg-opacity-10 p-2 me-2 text-primary">
                                                    <i class="bi bi-shop"></i>
                                                </div>
                                                <span class="fw-semibold"><?php echo e($rule->sauna->name ?? 'Unknown Sauna'); ?></span>
                                            </div>
                                        </td>
                                        <td>
                                            <?php if($rule->price_type == 'flat'): ?>
                                                <span class="badge bg-info bg-opacity-10 text-info">Flat Rate</span>
                                            <?php elseif($rule->price_type == 'per_person'): ?>
                                                <span class="badge bg-success bg-opacity-10 text-success">Per Person</span>
                                            <?php elseif($rule->price_type == 'per_hour'): ?>
                                                <span class="badge bg-warning bg-opacity-10 text-warning">Per Hour</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="fw-bold"><?php echo e(number_format($rule->price, 2)); ?></td>
                                        <td class="text-end">
                                            <form action="<?php echo e(route('pricing-rules.destroy', $rule)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this rule?');">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-sm btn-outline-danger border-0">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
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
                <form action="<?php echo e(route('pricing-rules.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    
                    <div class="mb-3">
                        <label class="form-label text-muted small text-uppercase fw-bold">Select Sauna</label>
                        <select name="sauna_id" class="form-select <?php $__errorArgs = ['sauna_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                            <option value="">Choose...</option>
                            <?php $__currentLoopData = $saunas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sauna): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($sauna->id); ?>"><?php echo e($sauna->name); ?> (<?php echo e($sauna->branch->name ?? 'N/A'); ?>)</option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['sauna_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted small text-uppercase fw-bold">Price Type</label>
                        <select name="price_type" class="form-select <?php $__errorArgs = ['price_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                            <option value="flat">Flat Rate (Fixed)</option>
                            <option value="per_person">Per Person</option>
                            <option value="per_hour">Per Hour</option>
                        </select>
                        <?php $__errorArgs = ['price_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted small text-uppercase fw-bold">Price Amount (KES)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">KES</span>
                            <input type="number" step="0.01" name="price" class="form-control border-start-0 <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="0.00" required>
                        </div>
                        <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-plus-lg me-1"></i> Add Pricing Rule
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/dismas/Desktop/businessmanager/resources/views/pricing_rules/index.blade.php ENDPATH**/ ?>