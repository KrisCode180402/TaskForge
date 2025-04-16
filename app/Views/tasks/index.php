<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Task Dashboard - TaskForge</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery UI CSS -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <style>
        /* Custom CSS for a modern look */
        .task-item {
            cursor: move;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="container my-5">
        <!-- Header with welcome message and role info -->
        <div class="text-center my-4">
            <h1>Task Dashboard</h1>
            <p>
                <font color="red" size="5">
                    Welcome! <?= esc(session()->get('username')); ?>, You are logged in as
                    <?php
                    $role = (session()->get('role_id') == 1) ? 'Admin' : ((session()->get('role_id') == 2) ? 'Manager' : 'Employee');
                    echo $role;
                    ?>.
                </font>
            </p>
        </div>

        <!-- Dynamic alerts container -->
        <div id="alert-container"></div>

        <h2 class="mb-4">Your Tasks</h2>

        <!-- Task list as sortable items -->
        <ul id="taskList" class="list-group">
            <?php if (!empty($tasks) && is_array($tasks)): ?>
                <?php foreach ($tasks as $task): ?>
                    <li class="list-group-item task-item" data-task-id="<?= $task['id'] ?>">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <strong><?= esc($task['title']); ?></strong><br>
                                <span><?= esc($task['description']); ?></span><br>
                                <small>Due: <?= esc($task['due_date']); ?></small>
                            </div>
                            <div>
                                <span class="badge bg-info"><?= esc($task['status_name'] ?? $task['status']); ?></span>
                                <a href="<?= site_url('tasks/edit/' . $task['id']); ?>" class="btn btn-primary btn-sm ms-2">Edit</a>
                                <a href="<?= site_url('tasks/delete/' . $task['id']); ?>" class="btn btn-danger btn-sm ms-2" onclick="return confirm('Are you sure you want to delete this task?')">Delete</a>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li class="list-group-item">No tasks available.</li>
            <?php endif; ?>
        </ul>

        <div class="mt-4">
            <a href="<?= site_url('tasks/create'); ?>" class="btn btn-success">Create New Task</a>
        </div>
    </div>

    <!-- jQuery, jQuery UI, and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(function() {
            $("#taskList").sortable({
                update: function(event, ui) {
                    // Get the new order of task IDs from the data-task-id attribute.
                    var order = $(this).sortable('toArray', {
                        attribute: 'data-task-id'
                    });
                    console.log("New order:", order);
                    // Send the new order via AJAX to update the positions.
                    $.ajax({
                        url: '<?= base_url("manager/reorderTasks") ?>',
                        method: 'POST',
                        data: {
                            order: order
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 'success') {
                                var alertHtml = '<div class="alert alert-success alert-dismissible fade show" role="alert">' +
                                    'Task order updated successfully!' +
                                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                                    '</div>';
                                $("#alert-container").html(alertHtml);
                            } else {
                                var alertHtml = '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                                    response.message +
                                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                                    '</div>';
                                $("#alert-container").html(alertHtml);
                            }
                        },
                        error: function() {
                            var alertHtml = '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                                'Error updating task order.' +
                                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                                '</div>';
                            $("#alert-container").html(alertHtml);
                        }
                    });
                }
            });
            $("#taskList").disableSelection();
        });
    </script>
</body>

</html>