
<h2 class="mb-4">Create Task</h2>
<form action="<?= site_url('tasks/store') ?>" method="post">
    <?= csrf_field(); ?>
    <div class="mb-3">
        <label>Title</label>
        <input type="text" name="title" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control"></textarea>
    </div>
    <div class="mb-3">
        <label>Due Date</label>
        <input type="date" name="due_date" class="form-control">
    </div>
    <button type="submit" class="btn btn-success">Save Task</button>
</form>

