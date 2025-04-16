<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= isset($title) ? esc($title) : 'TaskForge'; ?></title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('public/assets/css/style.css'); ?>">

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="<?= site_url('/') ?>">TaskForge</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php if (session()->has('isLoggedIn') && session()->get('isLoggedIn') === true): ?>
                        <?php
                        $role = session()->get('role_id');
                        $dashboardUrl = ($role == 1) ? 'admin/dashboard' : ($role == 2 ? 'manager/dashboard' : 'employee/dashboard');
                        $dashboardLabel = ($role == 1) ? 'Admin Dashboard' : ($role == 2 ? 'Manager Dashboard' : 'Employee Dashboard');
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url($dashboardUrl); ?>"><?= $dashboardLabel; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url('logout'); ?>">Logout</a>
                        </li>
                    <?php else: ?>
                        <!-- Public navigation links with anchor IDs -->
                        <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#about">About Us</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <!-- Dynamic alerts and content will go here -->
    </div>

  
