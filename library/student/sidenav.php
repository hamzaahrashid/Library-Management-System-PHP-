<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Example</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
        }

        /* Sidebar styles */
        #nav-bar {
            width: 250px;
            height: 100vh;
            background-color: #333;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 20px;
            transition: width 0.3s ease;
        }

        /* Nav Title */
        #nav-header {
            text-align: center;
            padding: 10px;
        }

        #nav-header a {
            color: white;
            font-size: 20px;
            text-decoration: none;
        }

        /* Nav Toggle for opening/closing sidebar */
        input#nav-toggle {
            display: none;
        }

        label[for="nav-toggle"] {
            font-size: 30px;
            color: white;
            cursor: pointer;
            display: block;
            text-align: center;
            padding: 10px;
        }

        /* Sidebar content */
        #nav-content {
            padding: 20px;
            margin-top: 20px;
        }

        .nav-button {
            display: flex;
            align-items: center;
            margin: 10px 0;
            color: white;
            text-decoration: none;
            font-size: 18px;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .nav-button:hover {
            background-color: #575757;
        }

        .nav-button i {
            margin-right: 10px;
        }

        /* Footer section */
        #nav-footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            padding: 20px;
            background-color: #222;
            color: white;
            text-align: center;
        }

        #nav-footer img {
            border-radius: 50%;
            width: 40px;
            height: 40px;
            margin-right: 10px;
        }

        /* Responsive Design for toggleable sidebar */
        #nav-bar #nav-content {
            display: none;
        }

        input#nav-toggle:checked ~ #nav-bar #nav-content {
            display: block;
        }

        /* Modal section for footer toggle */
        #nav-footer-content {
            display: none;
        }

        input#nav-footer-toggle:checked ~ #nav-footer #nav-footer-content {
            display: block;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div id="nav-bar">
    <div id="nav-header">
        <a href="https://codepen.io" target="_blank">
            C#<i class="fab fa-codepen"></i>DEPEN
        </a>
        <label for="nav-toggle">
            <span id="nav-toggle-burger">&#9776;</span>
        </label>
    </div>
    
    <div id="nav-content">
        <a href="#" class="nav-button">
            <i class="fas fa-palette"></i>
            <span>Your Work</span>
        </a>
        <a href="#" class="nav-button">
            <i class="fas fa-images"></i>
            <span>Assets</span>
        </a>
        <a href="#" class="nav-button">
            <i class="fas fa-thumbtack"></i>
            <span>Pinned Items</span>
        </a>
        <hr>
        <a href="#" class="nav-button">
            <i class="fas fa-heart"></i>
            <span>Following</span>
        </a>
        <a href="#" class="nav-button">
            <i class="fas fa-chart-line"></i>
            <span>Trending</span>
        </a>
        <a href="#" class="nav-button">
            <i class="fas fa-fire"></i>
            <span>Challenges</span>
        </a>
        <a href="#" class="nav-button">
            <i class="fas fa-magic"></i>
            <span>Spark</span>
        </a>
        <hr>
        <a href="#" class="nav-button">
            <i class="fas fa-gem"></i>
            <span>Codepen Pro</span>
        </a>
    </div>

    <!-- Footer Section -->
    <div id="nav-footer">
        <input id="nav-footer-toggle" type="checkbox">
        <label for="nav-footer-toggle">
            <i class="fas fa-caret-up"></i>
        </label>
        <div id="nav-footer-heading">
            <div id="nav-footer-avatar">
                <img src="https://gravatar.com/avatar/4474ca42d303761c2901fa819c4f2547" alt="Avatar">
            </div>
            <div id="nav-footer-titlebox">
                <a id="nav-footer-title" href="https://codepen.io/uahnbu/pens/public" target="_blank">uahnbu</a>
                <span id="nav-footer-subtitle">Admin</span>
            </div>
        </div>
        <div id="nav-footer-content">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
        </div>
    </div>
</div>

<!-- Main Content -->
<div id="content" style="margin-left: 250px; padding: 20px;">
    <h1>Main Content Goes Here</h1>
    <p>This is the main content area.</p>
</div>

</body>
</html>
