<?php $__env->startSection('content'); ?>
<div class="row justify-content-center align-items-center" style="min-height: 60vh;">
    <div class="col-md-5 col-lg-4">
        <div class="glass-card p-4 p-md-5">
            <h2 class="text-center mb-4 fw-bold">Portal Login</h2>
            
            <form method="POST" action="<?php echo e(route('login')); ?>">
                <?php echo csrf_field(); ?>
                
                <div class="mb-3">
                    <label for="email" class="form-label text-white-50">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" required autofocus placeholder="name@sauna.com">
                </div>
                
                <div class="mb-4">
                    <label for="password" class="form-label text-white-50">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required placeholder="••••••••">
                </div>
                
                <div class="d-grid">
                    <button type="submit" class="btn btn-sauna btn-lg">Sign In</button>
                </div>
            </form>
            
            <div class="text-center mt-4">
                <small class="text-white-50">Restricted Access System</small>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/dismas/Desktop/businessmanager/resources/views/auth/login.blade.php ENDPATH**/ ?>