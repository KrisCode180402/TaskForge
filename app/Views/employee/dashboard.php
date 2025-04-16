<?php helper('form'); ?>
<div class="container my-5">
    <!-- Header with welcome message and role info -->
    <div class="text-center my-4">
        <h1>Employee Dashboard</h1>
        <p>
            Welcome, <?= esc(session()->get('username')); ?>. You are logged in as <strong>Employee</strong>.
        </p>
    </div>

    <!-- Dynamic Alerts & Notifications -->
    <div id="alert-container">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('success'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('error'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
    </div>

    <h2 class="mb-4">Your Tasks</h2>

    <?php if (!empty($tasks) && is_array($tasks)): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Due Date</th>
                    <th>Current Status</th>
                    <th>Update Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tasks as $task): ?>
                    <tr>
                        <td><?= esc($task['id']); ?></td>
                        <td><?= esc($task['title']); ?></td>
                        <td><?= esc($task['description']); ?></td>
                        <td><?= esc($task['due_date']); ?></td>
                        <td><?= esc($task['status_name'] ?? $task['status']); ?></td>
                        <td>
                            <?= form_open('employee/updateTaskStatus/' . $task['id']) ?>
                            <div class="input-group input-group-sm">
                                <select name="status" class="form-select">
                                    <option value="To-Do" <?= set_select('status', 'To-Do', ($task['status'] == 'To-Do' || (isset($task['status_name']) && $task['status_name'] == 'To-Do'))) ?>>To-Do</option>
                                    <option value="In-Progress" <?= set_select('status', 'In-Progress', ($task['status'] == 'In-Progress' || (isset($task['status_name']) && $task['status_name'] == 'In-Progress'))) ?>>In-Progress</option>
                                    <option value="Done" <?= set_select('status', 'Done', ($task['status'] == 'Done' || (isset($task['status_name']) && $task['status_name'] == 'Done'))) ?>>Done</option>
                                </select>
                                <button type="submit" class="btn btn-secondary">Update</button>
                            </div>
                            <?= form_close() ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No tasks available.</p>
    <?php endif; ?>
</div>

