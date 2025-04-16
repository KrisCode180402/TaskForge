
<div class="container my-5">
    <!-- Header with welcome message and role info -->
    <div class="text-center my-4">
        <h1>Manager Dashboard</h1>
        <p>
            Welcome, <?= esc(session()->get('username')); ?>. You are logged in as <strong>Manager</strong>.
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

    <!-- Task Overview Section with Drag-and-Drop -->
    <section class="my-5">
        <h3 class="mb-4">Your Tasks</h3>
        <ul id="taskList" class="list-group">
            <?php if (!empty($tasks) && is_array($tasks)): ?>
                <?php foreach ($tasks as $task): ?>
                    <li class="list-group-item task-item" data-task-id="<?= $task['id'] ?>">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <strong><?= esc($task['title']); ?></strong><br>
                                <span><?= esc($task['description']); ?></span><br>
                                <small>Due: <?= esc($task['due_date']); ?></small>
                                <?php if (isset($task['assigned_to']) && !empty($task['assigned_to'])): ?>
                                    <br>
                                    <small>Assigned to: <?= esc($task['assigned_to']); ?></small>
                                <?php endif; ?>
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

        <!-- Create New Task Button -->
        <div class="mt-4">
            <a href="<?= site_url('tasks/create'); ?>" class="btn btn-success">Create New Task</a>
        </div>
    </section>
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
                // AJAX call to update the order in the database.
                $.ajax({
                    url: '<?= base_url("manager/reorderTasks") ?>',
                    method: 'POST',
                    data: {
                        order: order
                    },
                    dataType: 'json',
                    success: function(response) {
                        var alertType = response.status === 'success' ? 'success' : 'danger';
                        var message = response.status === 'success' ? 'Task order updated successfully!' : response.message;
                        var alertHtml = '<div class="alert alert-' + alertType + ' alert-dismissible fade show" role="alert">' +
                            message +
                            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                            '</div>';
                        $("#alert-container").html(alertHtml);
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

