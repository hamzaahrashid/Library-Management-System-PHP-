<?php

session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BookVerse</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
        /* Additional styles for footer */
        footer {
            background-color: skyblue; /* Add a background color */
            padding: 5px;  /* Add padding */
            text-align: center; /* Center the text */
            position: relative; /* Ensure it is positioned correctly */
            bottom: 0; /* Stick it to the bottom */
            width: 100%; /* Full width */
        }
        body {
            min-height: 100vh; /* Ensure body is at least full height */
            display: flex;
            flex-direction: column; /* Flex column for proper footer placement */
            margin: 0; /* Remove margin */
        }
        .wrapper {
            flex: 1; /* Allow wrapper to grow */
        }
        .sec_img img {
            border: 5px solid skyblue;  /* Black border around the image */
            border-radius: 10px;      /* Rounded corners */
            padding: 10px;            /* Padding inside the border */
            width: 80%;               /* Adjust width to fit nicely in the layout */
            display: block;
            margin: 0 auto;           /* Center the image */

        }
        /* Navigation links hover effect */
nav ul li a {
    display: inline-block;
    padding: 0px 10px;
    font-family: cursive;
    font-size: 16px;
    text-decoration: none;
    color: black;
    background-color: white;
    border-radius: 6px;
    transition: all 0.3s ease; /* Smooth transition for hover effects */
    line-height: 30px;
}

/* Hover effect for links */
nav ul li a:hover {
    background-color: white; /* Change background on hover */
    color: skyblue; /* Change text color on hover */
    transform: scale(1.1); /* Slightly scale the link */
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2); /* Add shadow for effect */
}

/* Optional: Underline effect on hover */
nav ul li a::after {
    content: '';
    position: absolute;
    bottom: 4px;
    left: 50%;
    width: 0;
    height: 2px;
    background: skyblue;
    transition: width 0.3s ease, left 0.3s ease;
}

nav ul li a:hover::after {
    width: 100%; /* Full width underline on hover */
    left: 0;
}

    
#sidebar {
    height: 80vh;
    width: 250px;
    position: fixed;
    top: 0;
    left: 20px;
    background-color: white;
    color: black;
    border-right: 2px solid skyblue;
    overflow: hidden;
    transition: width 0.5s ease, border-radius 0.5s ease;
    z-index: 1000;
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    margin-top: 130px;

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

    <div class="wrapper">

        <header>
            <div class="logo">
                <img src="book2.png" alt="Library Logo">
                <h1 style="font-family: cursive; color: black;margin-left:60px ;">BOOKVERSE</h1>
            </div>

            <?php

            if (isset($_SESSION['login_user'])) {
            ?>
              <nav>
                <ul>

                  <li><a style="font-family: cursive;" href="index.php">HOME</a></li>
                     <li><a style="font-family:cursive;word-spacing: 4px ;-spacing: 3px;" href="student.php">STUDENT INFORMATION</a></li>
                       
                    <li><a style="font-family: cursive;" href="feedback.php">FEEDBACK</a></li>
                   
                </ul>
            </nav>
            <?php
        }

        else
        
    {
        ?>
          <nav>
                <ul>
                  <li><a style="font-family: cursive;" href="index.php">HOME</a></li>
                    <li><a style="font-family: cursive;" href="books.php">BOOKS</a></li>
                    <li><a style="font-family: cursive;" href="../login.php">LOGIN</a></li>
                    <li><a style="font-family: cursive;" href="feedback.php">FEEDBACK</a></li>
                </ul>
            </nav>   
            <?php
        }

        ?>

        
        </header>

            <div id="sidebar">
    <div class="profile">
        <?php if (isset($_SESSION['login_user'])) { ?>
            <img src="images/<?php echo $_SESSION['pic']; ?>" alt="Profile Picture">
            <h3><?php echo $_SESSION['login_user'];?></h3>
            <p>Library Admin</p>
        <?php } else { ?>
            <img src="default-avatar.png" alt="Default Profile Picture">
            <h3>Guest</h3>
            <p>Welcome to Library</p>
        <?php } ?>
    </div>
    <a href="index.php"><i class="fas fa-home"></i><span> Home</span></a>
   


    <?php if (isset($_SESSION['login_user'])) { ?>

        <a href="request.php"><i class="fas fa-paper-plane"></i><span> Book Request</span></a>
                       <a href="books.php"><i class="fas fa-book"></i><span> Books</span></a>


        <a href="issue_info.php"><i class="fas fa-hand-holding"></i><span> Issue Information</span></a>
        <a href="aboutus.php"><i class="fas fa-info-circle"></i><span> About Us</span></a>
               <a href="gallery.php"><i class="fas fa-images"></i><span>Books Gallery</span></a>
               <a href="add.php"><i class="fas fa-user-plus"></i><span> Add Books</span></a>
               
<a href="fine.php"><i class="fas fa-dollar-sign"></i><span> Fine</span></a>
   <a href="profile.php"><i class="fas fa-user"></i><span> Profile</span></a>
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


        <section>
            <div class="sec_img">
                <div class="w3-content w3-section" style="width: 500px;">
                    <img class="mySlides w3-animate-left" src="images/a.jpg" style="width:100%">
                    <img class="mySlides w3-animate-left" src="images/b.jpg" style="width:100%">
                    <img class="mySlides w3-animate-left" src="images/c.jpg" style="width:100%">
                    <img class="mySlides w3-animate-left" src="images/e.jpg" style="width:100%">
                </div>

                <script type="text/javascript">
                    var a = 0;
                    carousel();

                    function carousel() {
                        var i;
                        var x = document.getElementsByClassName("mySlides");
                        for (i = 0; i < x.length; i++) {
                            x[i].style.display = 'none';
                        }
                        a++;
                        if (a > x.length) { a = 1 }
                        x[a - 1].style.display = "block";
                        setTimeout(carousel, 5000);
                    }
                </script>

                <div class="box">
                    <h1 style="font-family: cursive;">WELCOME TO THE BOOKVERSE</h1>
                
                </div>
            </div>
        </section>
    </div>
        <?php
include "footer.php";
?>
</body>
</html>
