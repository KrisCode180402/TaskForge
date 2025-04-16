<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register - TaskForge</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons for the eye icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        /* Full height for page and proper spacing for fixed footer */
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }


        /* Positioning for password toggle icons */
        .position-relative {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            top: 38px;
            /* adjust based on your input height */
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
                    <h2 class="mb-4 text-center">Register for TaskForge</h2>

                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger">
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>

                    <?= form_open('register') ?>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" id="username" placeholder="Enter your username" value="<?= set_value('username') ?>">
                        <?php if (isset($validation)): ?>
                            <small class="text-danger"><?= $validation->getError('username') ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email" value="<?= set_value('email') ?>">
                        <?php if (isset($validation)): ?>
                            <small class="text-danger"><?= $validation->getError('email') ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3 position-relative">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Enter a strong password">
                        <span class="toggle-password" onclick="togglePassword('password', 'toggle-icon1')">
                            <i class="bi bi-eye-slash" id="toggle-icon1"></i>
                        </span>
                        <?php if (isset($validation)): ?>
                            <small class="text-danger"><?= $validation->getError('password') ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3 position-relative">
                        <label for="pass_confirm" class="form-label">Confirm Password</label>
                        <input type="password" name="pass_confirm" class="form-control" id="pass_confirm" placeholder="Confirm your password">
                        <span class="toggle-password" onclick="togglePassword('pass_confirm', 'toggle-icon2')">
                            <i class="bi bi-eye-slash" id="toggle-icon2"></i>
                        </span>
                        <?php if (isset($validation)): ?>
                            <small class="text-danger"><?= $validation->getError('pass_confirm') ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label for="role_id" class="form-label">Select Role</label>
                        <select name="role_id" id="role_id" class="form-select">
                            <option value="">-- Select Role --</option>
                            <?php foreach ($roles as $role): ?>
                                <option value="<?= esc($role['id']) ?>" <?= set_select('role_id', $role['id']) ?>>
                                    <?= esc($role['role_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (isset($validation)): ?>
                            <small class="text-danger"><?= $validation->getError('role_id') ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                    <?= form_close() ?>

                    <p class="mt-3 text-center">Already have an account? <a href="<?= site_url('login') ?>">Login here</a></p>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>

</body>

</html>