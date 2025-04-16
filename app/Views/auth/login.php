<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login - TaskForge</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons for the eye icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        /* Ensure the body takes full height for the fixed footer effect */
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        /* Adjust container so that content does not get hidden behind the footer */
        .content-wrapper {
            padding-bottom: 60px;
            /* Adjust based on footer height */
            min-height: 100%;
        }

        /* Optional: Adjust the position of the password toggle icon */
        .toggle-password {
            position: absolute;
            top: 38px;
            right: 10px;
            cursor: pointer;
            z-index: 2;
        }
    </style>
</head>

<body>
    <div class="content-wrapper">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <h2 class="mb-4 text-center">Login to TaskForge</h2>

                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger">
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>

                    <?= form_open('login') ?>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email" value="<?= set_value('email') ?>">
                        <?php if (isset($validation)): ?>
                            <small class="text-danger"><?= $validation->getError('email') ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3 position-relative">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password">
                        <!-- Toggle icon for password visibility -->
                        <span class="toggle-password" onclick="togglePasswordVisibility()">
                            <i class="bi bi-eye-slash" id="toggle-icon"></i>
                        </span>
                        <?php if (isset($validation)): ?>
                            <small class="text-danger"><?= $validation->getError('password') ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                    <?= form_close() ?>

                    <p class="mt-3 text-center">Don't have an account? <a href="<?= site_url('register') ?>">Register here</a></p>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-light text-center py-3 fixed-bottom">
        <div class="container">
            <p>&copy; <?= date('Y') ?> TaskForge. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/script.js"></script>

</body>

</html>