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
 </style>

 <div class="container mt-4">
     <h2>Edit User</h2>

     <?php if (session()->getFlashdata('error')): ?>
         <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
     <?php endif; ?>

     <?= form_open('admin/updateUser/' . $user['id']) ?>
     <div class="mb-3">
         <label for="username" class="form-label">Username</label>
         <div class="input-group">
             <input type="text" name="username" class="form-control" id="username" value="<?= set_value('username', $user['username']) ?>" readonly>
             <button class="btn btn-outline-secondary" type="button" id="editUsernameBtn" onclick="toggleReadOnly('username', 'editUsernameBtn')">Edit</button>
         </div>
     </div>
     <div class="mb-3">
         <label for="email" class="form-label">Email</label>
         <div class="input-group">
             <input type="email" name="email" class="form-control" id="email" value="<?= set_value('email', $user['email']) ?>" readonly>
             <button class="btn btn-outline-secondary" type="button" id="editEmailBtn" onclick="toggleReadOnly('email', 'editEmailBtn')">Edit</button>
         </div>
     </div>
     <div class="mb-3 position-relative">
         <label for="role_id" class="form-label">Role</label>
         <select name="role_id" id="role_id" class="form-select">
             <option value="1" <?= set_select('role_id', '1', $user['role_id'] == 1) ?>>Admin</option>
             <option value="2" <?= set_select('role_id', '2', $user['role_id'] == 2) ?>>Manager</option>
             <option value="3" <?= set_select('role_id', '3', $user['role_id'] == 3) ?>>Employee</option>
         </select>
         <?php if (isset($validation)): ?>
             <small class="text-danger"><?= $validation->getError('role_id') ?></small>
         <?php endif; ?>
     </div>
     <div class="d-grid">
         <button type="submit" class="btn btn-primary">Update User</button>
     </div>
     <?= form_close() ?>
 </div>

 <?= $this->include('templates/footer') ?>

 <!-- Fixed footer styling (if footer in templates/footer doesn't already fix it) -->
 <style>
     footer {
         position: fixed;
         bottom: 0;
         left: 0;
         width: 100%;
     }
 </style>

 <!-- JavaScript for toggling readonly state -->
 <script>
     function toggleReadOnly(fieldId, buttonId) {
         var field = document.getElementById(fieldId);
         var btn = document.getElementById(buttonId);
         if (field.hasAttribute('readonly')) {
             field.removeAttribute('readonly');
             btn.innerText = 'Lock';
             field.focus();
         } else {
             field.setAttribute('readonly', 'readonly');
             btn.innerText = 'Edit';
         }
     }
 </script>

 <footer class="bg-dark text-light text-center py-3 fixed-bottom">
     <div class="container">
         <p>&copy; <?= date('Y') ?> TaskForge. All rights reserved.</p>
     </div>
 </footer>