
<h2 class="mb-4">Edit Task</h2>
<form action="<?= site_url('tasks/update/' . $task['id']) ?>" method="post">
    <?= csrf_field(); ?>
    <div class="mb-3">
        <label>Title</label>
        <input type="text" name="title" class="form-control" value="<?= esc($task['title']) ?>" required>
    </div>
    <div class="mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control"><?= esc($task['description']) ?></textarea>
    </div>
    <div class="mb-3">
        <label>Due Date</label>
        <input type="date" name="due_date" class="form-control" value="<?= esc($task['due_date']) ?>">
    </div>
    <div class="mb-3">
        <label>Status</label>
        <select name="status" class="form-control">
            <option value="To-Do" <?= ($task['status'] == 'To-Do') ? 'selected' : '' ?>>To-Do</option>
            <option value="In-Progress" <?= ($task['status'] == 'In-Progress') ? 'selected' : '' ?>>In-Progress</option>
            <option value="Done" <?= ($task['status'] == 'Done') ? 'selected' : '' ?>>Done</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Update Task</button>
</form>

