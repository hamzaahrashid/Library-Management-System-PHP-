<?php
include "connection.php";
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About Us</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <style>
        body {
            font-family: cursive;
            margin: 0;
            padding: 0;
        }

        .slider-container {
            position: relative;
            width: 100vw;
            height: calc(100vh - 70px);
            overflow: hidden;
        }

        .slider-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0;
            position: absolute;
            transition: opacity 1.5s ease-in-out;
        }

        .slider-container img.active {
            opacity: 0.8;
        }

        .slider-text {
            position: absolute;
            top: 50%;
            left: 5%;
            transform: translateY(-50%);
            color: white;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 20px;
            border-radius: 10px;
            max-width: 40%;

        }

        .slider-text h1 {
            margin: 0;
            font-size: 40px;
            font-weight: bold;
        }

        .slider-text p {
            margin: 10px 0 0;
            font-size: 28px;
        }

    .points {
    position: relative; /* Make sure the container can hold the border animation */
    margin: 40px auto;
    padding: 30px;
    border-radius: 10px;
    background: linear-gradient(135deg, #e6f7ff, #ffffff); /* Gradient background */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
    width: 80%;
    text-align: left;
    overflow: hidden; /* Hide the animation line when it goes outside the box */
}
        .points h3 {
            font-size: 24px;
            color: #444;
            margin-bottom: 20px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        }

        .points ul {
            list-style: none;
            padding: 0;
            display: grid;
            gap: 20px;
        }

        .points li {
            display: flex;
            align-items: center;
            gap: 15px;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            font-size: 18px;
            color: #333;
            font-weight: bold;
        }

        .points li i {
            color: #4CAF50;
            font-size: 24px;
            background-color: rgba(76, 175, 80, 0.1);
            padding: 10px;
            border-radius: 50%;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

      /* Glowing and moving gradient border */
..points::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border-radius: 10px; /* Round the corners of the border */
    background: linear-gradient(135deg, skyblue, lightblue, cyan); /* Gradient effect */
    background-size: 400% 400%; /* Stretch the gradient for movement */
    animation: borderAnimation 3s linear infinite; /* Animation to move the gradient */
    z-index: -1; /* Keep it behind the content */
}


        /* Glowing and moving border animation */
@keyframes borderAnimation {
    0% {
        background-position: 200% 200%;
    }
    100% {
        background-position: 0% 0%;
    }
}
.points {
    padding: 40px;
}

#sidebar {
    height: 80vh;
    width: 250px;
    position: fixed;
    top: 0;
    left: 0;
    background-color: white;
    color: black;
    border-right: 2px solid skyblue;
    overflow: hidden;
    transition: width 0.5s ease, border-radius 0.5s ease;
    z-index: 1000;
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    margin-top: 130px;
    margin-left: 20px;
}

#sidebar.collapsed {
    width: 70px; /* Only show icons */
}

#sidebar a {
    display: flex;
    align-items: center;
    padding: 15px 20px;
    color: black;
    text-decoration: none;
    font-family: cursive;
    font-size: 16px;
    transition: all 0.3s ease;
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);

}

#sidebar a i {
    margin-right: 15px;
    font-size: 18px;
}

#sidebar.collapsed a i {
    margin-right: 0;
    left: 20px;
}

#sidebar.collapsed a span {
    display: none; /* Hide the text when collapsed */
}

#sidebar a:hover {
    background-color: skyblue;
    color: white;
}

#sidebar:hover {
    width: 250px; /* Expand on hover */
}

#main-content {
    margin-left: 250px;
    padding: 20px;
    transition: margin-left 0.3s ease;
}

#sidebar.collapsed ~ #main-content {
    margin-left: 70px;
}

.profile {
    padding: 20px;
    text-align: center;
    border-bottom: 2px solid skyblue;
}

.profile img {
    width: 95px;
    height: 100px;
    border-radius: 50%;
    margin-bottom: 10px;
    object-fit: cover;
    border: 2px solid skyblue;

}
#sidebar.collapsed .profile img {
    width: 40px; /* Smaller size when sidebar is collapsed */
    height: 40px;
margin-right: -5px;
}
.profile h3 {
    margin: 10px 0 0;
    font-family: cursive;
    font-size: 18px;
}

.profile p {
    margin: 0;
    font-size: 14px;
    color: gray;
}


        footer {
            background-color: skyblue;
            text-align: center;
            padding: 10px;
            position: relative;
            bottom: 0;
            width: 100%;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
        }
    </style>

        <script>
   
document.addEventListener('DOMContentLoaded', function () {
    const sidebar = document.getElementById("sidebar");

    sidebar.addEventListener('mouseover', function () {
        sidebar.classList.remove('collapsed');
    });

    sidebar.addEventListener('mouseleave', function () {
        sidebar.classList.add('collapsed');
    });
});
</script>
</head>
<body>

<header>
    <div class="logo"><img src="book2.png" alt="Library Logo"></div>
</header>

<section>
    <!-- Slider with Text -->
    <div class="slider-container">
        <img class="mySlides active" src="images/library1.jpg" alt="Library Image 1">
        <img class="mySlides" src="images/ly2.jpg" alt="Library Image 2">
        <img class="mySlides" src="images/e.jpg" alt="Library Image 3">
        <img class="mySlides" src="images/f.jpg" alt="Library Image 3">

        <!-- Text on the slider -->
        <div class="slider-text">
            <h1>Welcome to Our Library</h1>
            <p>
                Discover a wide variety of books, journals, and research material in one place.
                We strive to provide a serene environment for all readers and learners.
                Join us in our journey to promote a love for reading.
            </p>
        </div>
    </div>

    <!-- Rules Section -->
    <div class="points">
        <h3>Library Rules and Policies</h3>
        <ul>
            <li><i class="fa fa-book"></i> Books must be returned on or before the due date.</li>
            <li><i class="fa fa-clock"></i> Fines for late returns are $0.10 (Rs.28) per day.</li>
            <li><i class="fa fa-volume-mute"></i> Maintain silence in the library to ensure a productive atmosphere.</li>
            <li><i class="fa fa-hand-paper"></i> Books should be handled with care to avoid damages.</li>
            <li><i class="fa fa-exclamation-circle"></i> In case of lost books, the member must pay the cost of the book.</li>
        </ul>
    </div>
</section>

<div id="sidebar">
    <div class="profile">
        <?php if (isset($_SESSION['login_user'])) { ?>
            <img src="images/<?php echo $_SESSION['pic']; ?>" alt="Profile Picture">
            <h3><?php echo $_SESSION['login_user']; ?></h3>
            <p>Library Member</p>
        <?php } else { ?>
            <img src="default-avatar.png" alt="Default Profile Picture">
            <h3>Guest</h3>
            <p>Welcome to Library</p>
        <?php } ?>
    </div>
    <a href="index.php"><i class="fas fa-home"></i><span> Home</span></a>
    <a href="feedback.php"><i class="fas fa-comments"></i><span> Feedback</span></a>
    <?php if (isset($_SESSION['login_user'])) { ?>
        <a href="profile.php"><i class="fas fa-user"></i><span> Profile</span></a>
        <a href="books.php"><i class="fas fa-book"></i><span> Books</span></a>
        <a href="aboutus.php"><i class="fas fa-info-circle"></i><span> About Us</span></a>
        <a href="request.php"><i class="fas fa-paper-plane"></i><span> Request Books</span></a>
               <a href="gallery.php"><i class="fas fa-images"></i><span>Books Gallery</span></a>

        <a href="expired.php"><i class="fas fa-clock"></i><span>  Expired Books</span></a>

<a href="fine.php"><i class="fas fa-dollar-sign"></i><span> Fine</span></a>


            <a href="logout.php"><i class="fas fa-sign-out-alt"></i><span> Logout</span></a>
    <?php } else { ?>
        <a href="../login.php"><i class="fas fa-sign-in-alt"></i><span> Login</span></a>
        <a href="registration.php"><i class="fas fa-user-plus"></i><span> Sign Up</span></a>
    <?php } ?>
</div>

<div id="main-content">
    <!-- Your existing content goes here -->
</div>


<?php
include "footer.php";
?>

<script>
    // Smooth Sliding Effect
    let slideIndex = 0;
    const slides = document.getElementsByClassName("mySlides");

    function showSlides() {
        for (let i = 0; i < slides.length; i++) {
            slides[i].classList.remove("active");
        }

        slideIndex++;
        if (slideIndex > slides.length) {
            slideIndex = 1;
        }

        slides[slideIndex - 1].classList.add("active");

        setTimeout(showSlides, 3000); // Change image every 3 seconds
    }

    // Initialize slider
    showSlides();
</script>

</body>
</html>
