// Custom JavaScript for TaskForge

$(document).ready(function () {
  // Example: Confirm deletion on task delete button click
  $(".btn-danger").on("click", function () {
    return confirm("Are you sure you want to delete this task?");
  });

  // Additional interactive scripts can be added here...
});
$(document).ready(function() {
    // Example dynamic alert function
    function showAlert(message, type = 'success') {
        // Create a new alert element
        let alertHtml = `<div class="alert alert-${type} alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>`;
        $('#alert-container').append(alertHtml);
        
        // Automatically dismiss alert after 5 seconds
        setTimeout(() => {
            $('.alert').alert('close');
        }, 5000);
    }

    // Example: Show an alert when a task is created/updated (this code can be triggered via AJAX or on page load)
    // For demonstration, uncomment the next line to test:
    // showAlert('Task created successfully!', 'success');

    // Optional: Implement drag-and-drop sorting for tasks if a task list is present
    if ($('#sortable').length) {
        $('#sortable').sortable({
            update: function(event, ui) {
                // After sorting, send AJAX request to update order in the database.
                let order = $(this).sortable('toArray');
                $.post("<?= site_url('tasks/updateOrder') ?>", { order: order });
            }
        });
    }
});

//JavaScript for password toggle and error handling 

    // Toggle password show/hide functionality
    function togglePasswordVisibility() {
      var passwordField = document.getElementById("password");
      var toggleIcon = document.getElementById("toggle-icon");
      if (passwordField.type === "password") {
        passwordField.type = "text";
        toggleIcon.classList.remove("bi-eye-slash");
        toggleIcon.classList.add("bi-eye");
      } else {
        passwordField.type = "password";
        toggleIcon.classList.remove("bi-eye");
        toggleIcon.classList.add("bi-eye-slash");
      }
    }

    // Form error handling: Validate that email and password fields are not empty
    document.querySelector("form").addEventListener("submit", function(event) {
      var email = document.getElementById("email").value.trim();
      var password = document.getElementById("password").value.trim();
      if (!email || !password) {
        event.preventDefault();
        alert("Please fill in both email and password fields.");
      }
    });
    // Custom JavaScript for Form Validation and Password Toggle 
   
        // Function to toggle password visibility for a given field
        function togglePassword(fieldId, iconId) {
            var passwordField = document.getElementById(fieldId);
            var toggleIcon = document.getElementById(iconId);
            if (passwordField.type === "password") {
                passwordField.type = "text";
                toggleIcon.classList.remove("bi-eye-slash");
                toggleIcon.classList.add("bi-eye");
            } else {
                passwordField.type = "password";
                toggleIcon.classList.remove("bi-eye");
                toggleIcon.classList.add("bi-eye-slash");
            }
        }

        // Basic client-side form validation before submission
        document.querySelector("form").addEventListener("submit", function(event) {
            var username = document.getElementById("username").value.trim();
            var email = document.getElementById("email").value.trim();
            var password = document.getElementById("password").value.trim();
            var passConfirm = document.getElementById("pass_confirm").value.trim();
            var role = document.getElementById("role_id").value;

            if (!username || !email || !password || !passConfirm || !role) {
                event.preventDefault();
                alert("Please fill in all required fields.");
                return;
            }

            // Check if password and confirm password are the same
            if (password !== passConfirm) {
                event.preventDefault();
                alert("Password and Confirm Password do not match.");
            }
        });
    