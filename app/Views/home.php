<?= $this->include('templates/header', ['title' => 'Home - TaskForge']) ?>

<style>
    
    body {
        background: linear-gradient(135deg, #eaf2f8, #d1d8e0);
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        padding: 0;
    }

    /* Ensure container doesn’t get hidden behind fixed footer */
    .content-wrapper {
        min-height: 100vh;
        padding-bottom: 70px;
        /* Adjust to your footer height */
    }

    /* Jumbotron / Hero Section */
    .jumbotron {
        background: rgba(255, 255, 255, 0.85);
        padding: 4rem 2rem;
        border-radius: 0.5rem;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease-in-out;
    }

    .jumbotron:hover {
        transform: scale(1.01);
    }

    .jumbotron h1 {
        font-size: 3rem;
        font-weight: bold;
    }

    .jumbotron p.lead {
        font-size: 1.25rem;
    }

    /* Animated Button Styling */
    .btn-animated {
        position: relative;
        overflow: hidden;
        transition: color 0.4s;
    }

    .btn-animated::before {
        content: "";
        position: absolute;
        left: -100%;
        top: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.2);
        transition: left 0.4s;
        z-index: 1;
    }

    .btn-animated:hover::before {
        left: 0;
    }

    /* Overview Section */
    #overview {
        background: #ffffffbb;
        border-radius: 10px;
        padding: 2rem;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        transition: background 0.3s ease-in-out;
    }

    #overview:hover {
        background: #ffffffdd;
    }

    /* About Us & Contact Sections */
    .about-section,
    .contact-section {
        background: #ffffffcc;
        border-radius: 10px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        transition: background 0.3s ease-in-out;
    }

    .about-section:hover,
    .contact-section:hover {
        background: #ffffffee;
    }

    .about-section h2,
    .contact-section h2 {
        margin-bottom: 1.5rem;
    }

    .contact-info {
        list-style: none;
        padding: 0;
        text-align: center;
    }

    .contact-info li {
        margin-bottom: 1rem;
    }

    .contact-info a {
        color: #007bff;
        text-decoration: none;
        transition: color 0.3s;
    }

    .contact-info a:hover {
        color: #0056b3;
    }

    /* Color Picker Section (Optional) */
    .color-picker-container {
        margin-top: 2rem;
        background: #fdfdfd;
        padding: 1rem;
        border-radius: 0.5rem;
        text-align: center;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

</style>

<div class="content-wrapper">
    <!-- Hero / Jumbotron Section -->
    <div class="jumbotron text-center py-5 rounded shadow-sm">
        <h1 class="display-4">Welcome to TaskForge</h1>
        <p class="lead">Manage your tasks effortlessly with a modern, dynamic, and user-friendly system.</p>
        <hr class="my-4">
        <p>Track tasks, assign roles, and boost productivity with ease.</p>
        <?php if (!session()->has('isLoggedIn') || session()->get('isLoggedIn') !== true): ?>
            <a class="btn btn-primary btn-lg me-2 btn-animated" href="<?= site_url('login'); ?>">Login</a>
            <a class="btn btn-secondary btn-lg btn-animated" href="<?= site_url('register'); ?>">Register</a>
        <?php else: ?>
            <a class="btn btn-primary btn-lg me-2 btn-animated" href="<?= site_url('tasks'); ?>">Go to Dashboard</a>
        <?php endif; ?>
    </div>

    <!-- Overview Section -->
    <section id="overview" class="my-5">
        <h2 class="text-center mb-4">About TaskForge</h2>
        <p class="text-center px-3">
            TaskForge is a robust task management system built on CodeIgniter 4.6.0.
            It enables teams to create, update, and track tasks efficiently with role-based access,
            interactive UI elements, and API integration support. Whether you're an individual or part
            of a larger organization, TaskForge adapts to your workflow and keeps your projects on track.
        </p>
        <div class="row mt-4">
            <div class="col-md-6 text-center">
                <h5>Team Collaboration</h5>
                <p>Assign tasks, set deadlines, and collaborate seamlessly across teams. Stay in sync with real-time updates and notifications.</p>
            </div>
            <div class="col-md-6 text-center">
                <h5>Intuitive Interface</h5>
                <p>Enjoy a clean, responsive design that allows you to focus on your work. Customize your dashboard and work effortlessly.</p>
            </div>
        </div>
    </section>

    <!-- About Us Section -->
    <section class="about-section mb-5" id="about">
        <h2 class="text-center">About Us</h2>
        <p>
            Welcome to TaskForge! We are a dedicated team of developers, designers, and project managers who believe in the power of efficient task management.
            Our goal is to provide a platform that not only simplifies your workflow but also inspires collaboration and innovation.
        </p>
        <p>
            From small startups to large enterprises, TaskForge is designed to scale with your needs, ensuring that every project, no matter how big or small,
            is handled with clarity and precision.
        </p>
    </section>

    <!-- Contact Us Section -->
    <section class="contact-section mb-5" id="contact">
        <h2 class="text-center">Contact Us</h2>
        <p class="mb-4 text-center">
            Have questions, feedback, or just want to say hello? We’d love to hear from you!
            Reach out to us via:
        </p>
        <ul class="contact-info">
            <li>Phone: <a href="tel:8288872787">828-887-2787</a></li>
            <li>Email: <a href="mailto:endlessady74787@gmail.com">endlessady74787@gmail.com</a></li>
        </ul>
    </section>

    
</div>

<?= $this->include('templates/footer') ?>

<!-- JavaScript for Smooth Scrolling and Interactivity -->
<script>
    // Smooth scrolling for same-page navigation (if using anchor links from header)
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('a.nav-link[href^="#"]').forEach(anchor => {
            anchor.addEventListener("click", function(e) {
                e.preventDefault();
                var targetElement = document.querySelector(this.getAttribute("href"));
                if (targetElement) {
                    targetElement.scrollIntoView({
                        behavior: "smooth"
                    });
                }
            });
        });
    });

    // Update color preview in the color picker section
    function updateColorPreview(color) {
        var preview = document.getElementById('color-preview');
        preview.style.background = color;
    }
</script>