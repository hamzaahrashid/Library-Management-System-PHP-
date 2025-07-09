<?php
include "connection.php";
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
  footer {
            background-color: skyblue; /* Add a background color */
            text-align: center; /* Center the text */
            position: relative; /* Ensure it is positioned correctly */
            bottom: 0; /* Stick it to the bottom */
            width: 100%; /* Full width */
        }
        html, body {
    margin: 0;
    padding: 0;
    height: 100%; /* Full height for proper layout */
    display: flex;
    flex-direction: column;
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


        nav ul li a {
            display: inline-block;
            padding: 0px 10px;
            font-family: cursive;
            font-size: 16px;
            text-decoration: none;
            color: black;
            background-color: white;
            border-radius: 6px;
            transition: all 0.3s ease;
            line-height: 30px;
        }

        nav ul li a:hover {
            background-color: white;
            color: skyblue;
            transform: scale(1.1);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

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
            width: 100%;
            left: 0;
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

#demo {
    position: absolute;
    left: 74%;
    transform: translate(-50%, -50%);
    font-size: 30px;
    color: skyblue; /* Sky blue text color */
    margin-bottom: -450px;
    margin-top: 3px;

    border:  skyblue;  /* Sky blue border */
    padding: 10px;  /* Padding inside the border */
    border-radius: 8px;  /* Rounded corners for the border */
    background-color: #ffffff;  /* Solid white background */
    box-shadow: 0px 4px 8px rgba(30, 144, 255, 0.5); /* Sky blue shadow for better visibility */
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

 <?php
if (isset($_SESSION['login_user'])) {
    // Fetch book return date
    $b = mysqli_query($db, "SELECT * FROM issue_book WHERE username='$_SESSION[login_user]' AND approve='approve' ORDER BY retrn ASC LIMIT 0,1;");
    $bid = mysqli_fetch_assoc($b);

    // Initialize `$rest` as null
    $rest = null;

    if ($bid) {
        // Fetch timer related data
        $t = mysqli_query($db, "SELECT * FROM timer WHERE name='$_SESSION[login_user]' AND bid='$bid[bookid]';");
        $rest = mysqli_fetch_assoc($t);
    }
}
?>

    <div class="wrapper">

        <header>
            <div class="logo">
                <img src="book2.png" alt="Library Logo">
                <h1 style="font-family: cursive; color: black;margin-left: 60px;">BOOKVERSE</h1>
            </div>

            <?php

            if (isset($_SESSION['login_user'])) {
            ?>
              <nav>
                <ul>
                  <li><a style="font-family: cursive;" href="index.php">HOME</a></li>
                    
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
        <p id="demo"></p> 

        
        </header>


<script>
// Set the date we're counting down to
<?php if ($rest && isset($rest['tm'])) { ?>
    var countDownDate = new Date("<?php echo $rest['tm']; ?>").getTime();
<?php } else { ?>
    var countDownDate = null; // Handle cases with no timer data
<?php } ?>

if (countDownDate) {
    // Update the count down every 1 second
    var x = setInterval(function () {
        var now = new Date().getTime();
        var distance = countDownDate - now;

        if (distance > 0) {
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("demo").innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s";
        } else {
            clearInterval(x);
            document.getElementById("demo").innerHTML = "EXPIRED";
        }
    }, 1000);
} else {
    document.getElementById("demo").innerHTML = "No timer data";
}
</script>    
    



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

      
        
        <a href="fine.php"><i class="fas fa-dollar-sign"></i><span>Fine</span></a>
                      <a href="gallery.php"><i class="fas fa-images"></i><span>Books Gallery</span></a>

          <a href="aboutus.php"><i class="fas fa-info-circle"></i><span> About Us</span></a>
        
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


