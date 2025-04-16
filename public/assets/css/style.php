/* Global styles */
body {
background-color: #f0f2f5;
font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
color: #333;
margin: 0;
padding-bottom: 60px; /* Ensure content doesn't overlap the footer */
}

/* Navbar */
.navbar-brand {
font-weight: 700;
font-size: 1.75rem;
}


/* Table styling */
.table {
background-color: #fff;
border-radius: 0.5rem;
}

/* Dynamic Alert Styling */
#alert-container {
position: fixed;
top: 80px;
right: 20px;
z-index: 1050;
}

/* Button hover effect */
.btn:hover {
opacity: 0.9;
}

footer {
position: fixed;
bottom: 0;
width: 100%;
background-color: #343a40; /* Dark background */
color: #fff; /* Light text */
text-align: center;
padding: 1rem 0;
z-index: 1000; /* Ensure it stays on top */
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