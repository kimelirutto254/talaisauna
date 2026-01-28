<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sauna Manager - Dashboard</title>
    
    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root {
            --sidebar-width: 260px;
            --sidebar-bg: #1e293b; /* Dark Slate */
            --content-bg: #f8fafc; /* Very Light Grey */
            --accent: #ff7e5f;
            --text-main: #334155; /* Dark Text for Light BG */
            --text-muted: #64748b;
            --sidebar-text: #f1f5f9;
            --sidebar-text-muted: #94a3b8;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: var(--content-bg);
            color: var(--text-main);
            min-height: 100vh;
            overflow-x: hidden;
        }

        #wrapper {
            display: flex;
            width: 100%;
        }

        #sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            background: var(--sidebar-bg);
            color: var(--sidebar-text);
            position: fixed;
            transition: all 0.3s;
            z-index: 1000;
        }

        #content {
            width: 100%;
            margin-left: var(--sidebar-width);
            padding: 2rem;
            min-height: 100vh;
        }

        .nav-link {
            color: var(--sidebar-text-muted);
            padding: 0.8rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.2s;
            border-radius: 8px;
            margin: 0 0.5rem;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--accent);
            background: rgba(255, 255, 255, 0.05);
        }

        .nav-link i {
            font-size: 1.1rem;
        }

        /* Light Cards */
        .glass-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .btn-sauna {
            background: linear-gradient(to right, var(--accent), #f43f5e);
            border: none;
            color: white;
            padding: 0.6rem 1.5rem;
            border-radius: 50px;
            font-weight: 500;
        }
        
        .btn-sauna:hover {
            opacity: 0.9;
            color: white;
            box-shadow: 0 4px 12px rgba(244, 63, 94, 0.2);
        }

        /* Stats Cards */
        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        @media (max-width: 768px) {
            #sidebar {
                margin-left: -260px; /* Hide sidebar by default on mobile */
                box-shadow: 4px 0 10px rgba(0,0,0,0.1);
            }
            #sidebar.active {
                margin-left: 0;
            }
            #content {
                margin-left: 0;
                width: 100%;
            }
            .sidebar-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100vw;
                height: 100vh;
                background: rgba(0, 0, 0, 0.5);
                z-index: 999;
                opacity: 0;
                transition: opacity 0.3s;
            }
            .sidebar-overlay.active {
                display: block;
                opacity: 1;
            }
        }
    </style>
</head>
<body>

<div id="wrapper">
    <!-- Mobile Sidebar Overlay -->
    <div class="sidebar-overlay" onclick="toggleSidebar()"></div>

    <!-- Sidebar -->
    <nav id="sidebar">
        <div class="p-4 mb-4 border-bottom border-secondary border-opacity-25">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="fw-bold mb-0" style="background: linear-gradient(to right, #ff7e5f, #feb47b); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Sauna Admin</h4>
                <button class="btn btn-sm btn-outline-light d-md-none" onclick="toggleSidebar()">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <small class="text-white-50">Manager Portal</small>
        </div>

        <ul class="nav flex-column gap-2 mt-2">
            <li class="nav-item">
                <a href="<?php echo e(route('dashboard')); ?>" class="nav-link <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo e(route('pricing-rules.index')); ?>" class="nav-link <?php echo e(request()->routeIs('pricing-rules.*') ? 'active' : ''); ?>">
                    <i class="bi bi-tags"></i> Pricing Rules
                </a>
            </li>
            <?php if(auth()->user()->role === 'admin'): ?>
            <li class="nav-item">
                <a href="<?php echo e(route('branches.index')); ?>" class="nav-link <?php echo e(request()->routeIs('branches.*') ? 'active' : ''); ?>">
                    <i class="bi bi-shop"></i> Branches
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo e(route('users.index')); ?>" class="nav-link <?php echo e(request()->routeIs('users.*') ? 'active' : ''); ?>">
                    <i class="bi bi-people"></i> Staff
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo e(route('transactions.index')); ?>" class="nav-link <?php echo e(request()->routeIs('transactions.*') ? 'active' : ''); ?>">
                    <i class="bi bi-receipt"></i> Transactions
                </a>
            </li>
            <?php endif; ?>
        </ul>

        <div class="mt-auto p-4 border-top border-light border-opacity-10 position-absolute bottom-0 w-100">
            <div class="d-flex align-items-center gap-3 mb-3">
                <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center text-white fw-bold" style="width: 40px; height: 40px;">
                    <?php echo e(substr(auth()->user()->name, 0, 1)); ?>

                </div>
                <div style="line-height: 1.2;">
                    <span class="d-block text-white"><?php echo e(auth()->user()->name); ?></span>
                    <small class="text-muted" style="font-size: 0.8rem;"><?php echo e(ucfirst(auth()->user()->role)); ?></small>
                </div>
            </div>
            <form action="<?php echo e(route('logout')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <button class="btn btn-outline-danger w-100 btn-sm rounded-pill">
                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                </button>
            </form>
        </div>
    </nav>

    <!-- Page Content -->
    <div id="content">
        <!-- Mobile Toggle -->
        <button class="btn btn-dark d-md-none mb-3" onclick="toggleSidebar()">
            <i class="bi bi-list"></i> Menu
        </button>

        <?php if(session('success')): ?>
            <div class="alert alert-success border-0 bg-success bg-opacity-25 text-white mb-4">
                <i class="bi bi-check-circle me-2"></i> <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
            <div class="alert alert-danger border-0 bg-danger bg-opacity-25 text-white mb-4">
                <ul class="mb-0">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php echo $__env->yieldContent('content'); ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH /Users/dismas/Desktop/businessmanager/resources/views/layouts/admin.blade.php ENDPATH**/ ?>