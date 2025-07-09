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
     <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        /* Additional styles for footer */
        footer {
            background-color: skyblue;
            padding: 5px;
            text-align: center;
            position: relative;
            bottom: 0;
            width: 100%;
        }

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            margin: 0;
            justify-content: center;
            align-items: center;
        }

        .wrapper {
            flex: 1;
             flex-direction: column;
    justify-content: center;
    align-items: center; /* Center both vertically and horizontally */
    width: 100%;
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

        .container1 {
            display: flex;
            justify-content: center;
            align-items: right;
            height: 100vh;
            padding-top: 20px;
            
        }

 .btn {
    display: block;
    margin: 20px auto; /* Center the button */
    padding: 10px 20px;
    font-size: 16px;
    background-color: skyblue;
    border: none;
    color: white;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.3s ease, transform 0.3s ease;
}


        .btn:hover {
            background-color: #4682b4;
        }

 .pro {
    width: 600px;
    min-height: 400px; /* Set a minimum height */
    margin: 20px auto;
    background-color: skyblue;
    text-align: center;
    padding: 20px;
    border-radius: 10px;
    position: relative;
}

        /* Loading spinner style */
        .loading-spinner {
            border: 5px solid #f3f3f3; /* Light background */
            border-top: 5px solid skyblue; /* Blue color for the spinner */
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 2s linear infinite;
            margin: 0 auto;
        }
        .profile_img {
    border-radius: 50%;
    object-fit: cover;
}
.table td{
    color:white;
    font-family: cursive;
}

        /* Animation for the spinner */
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Styles for the checkmark after spinner completes */
        .checkmark {
            font-size: 25px;
            color: green;
            display: none;
            animation: checkmarkAnimation 0.5s ease-in-out forwards;
        }

        /* Animation for checkmark transformation */
        @keyframes checkmarkAnimation {
            0% {
                opacity: 0;
                transform: scale(0);
            }
            50% {
                opacity: 0.5;
                transform: scale(1.2);
            }
            100% {
                opacity: 1;
                transform: scale(1);
            }
        }
        #sidebar {
    height: 80vh;
    width: 250px;
    position: fixed;
    top: 0;
    
    background-color: white;
    color: black;
    border-right: 2px solid skyblue;
    overflow: hidden;
    transition: width 0.3s ease, border-radius 0.3s ease;
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


    </style>

    <script>
         function transformButton() {
            var btn = document.getElementById("submitBtn");
            btn.style.display = "none"; // Hide the button

            var spinner = document.getElementById("spinner");
            spinner.style.display = "block"; // Show the spinner

            // Simulate a loading process
            setTimeout(function() {
                spinner.style.display = "none"; // Hide the spinner after some time
                var checkmark = document.getElementById("checkmark");
                checkmark.style.display = "inline-block"; // Show the checkmark
            }, 3000); // 3 seconds loading time
        }

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
            <h1 style="font-family: cursive; color: black;margin-left: 100px;">BOOKVERSE</h1>
        </div>
        <nav>
            <ul>
                <li><a style="font-family: cursive;" href="index.php">HOME</a></li>
                <li><a style="font-family: cursive;" href="books.php">BOOKS</a></li>
                <li><a style="font-family: cursive;" href="feedback.php">FEEDBACK</a></li>
                 <li><a style="font-family: cursive;" href="profile.php">PROFILE</a></li>

                <?php if (isset($_SESSION['login_user'])) { ?>
                    <li><a style="font-family: cursive;" href="logout.php">LOGOUT</a></li>
                <?php } else { ?>
                    <li><a style="font-family: cursive;" href="login.php">LOGIN</a></li>
                <?php } ?>
            </ul>
        </nav>
    </header>

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
        <a href="about.php"><i class="fas fa-info-circle"></i><span> About Us</span></a>
        <a href="request.php"><i class="fas fa-info-circle"></i><span> Request Books</span></a>
        <a href="expired.php"><i class="fas fa-exclamation-circle"></i><span>  Expired Books</span></a>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i><span> Logout</span></a>
    <?php } else { ?>
        <a href="login.php"><i class="fas fa-sign-in-alt"></i><span> Login</span></a>
        <a href="registration.php"><i class="fas fa-user-plus"></i><span> Sign Up</span></a>
    <?php } ?>
</div>

<div id="main-content">
    <!-- Your existing content goes here -->
</div>

    <div class="container1">
        <form action="" method="post">
            <div class="pro">
            	<?php

             
$q = mysqli_query($db, "SELECT s.username, s.roll,s.password, s.email, si.first, si.last, si.contact 
                        FROM student s 
                        INNER JOIN student_info si ON s.studentid = si.studentid 
                        WHERE s.username = '" . mysqli_real_escape_string($db, $_SESSION['login_user']) . "';");


if(isset($_POST['submit1']))
{

?>
<script type="text/javascript">
    window.location: "edit.php";
</script>
<?php
        
}

            ?>
            <h2 style="font-family:cursive;color: white;">My Profile</h2>

            <?php
            $row=mysqli_fetch_assoc($q);

            echo "<div><img class= 'img-circle profile_img' height =110 width=120 src = 'images/".$_SESSION['pic']."'></div>";

            ?>
            <div><b style="font-family:cursive;color: white;">Welcome,</b></div>
            <h4 style="color: white;font-family: cursive;">
            	<?php echo $_SESSION['login_user'];?>
            </h4>
           
            <?php
echo "<table class='table table-bordered' style='border: 1px white; border-collapse: collapse; width: 100%; text-align: left;'>";


echo "<tr>";
echo "<td style='border: 1px solid  white; padding: 8px;'><b>First Name:</b></td>";
echo "<td style='border: 1px solid white; padding: 8px;'>" . htmlspecialchars($row['first']) . "</td>";
echo "</tr>";

echo "<tr>";
echo "<td style='border: 1px solid white; padding: 8px;'><b>Last Name:</b></td>";
echo "<td style='border: 1px solid white; padding: 8px;'>" . htmlspecialchars($row['last']) . "</td>";
echo "</tr>";

echo "<tr>";
echo "<td style='border: 1px solid white; padding: 8px;'><b>Username:</b></td>";
echo "<td style='border: 1px solid white; padding: 8px;'>" . htmlspecialchars($row['username']) . "</td>";
echo "</tr>";

echo "<tr>";
echo "<td style='border: 1px solid white; padding: 8px;'><b>Password:</b></td>";
echo "<td style='border: 1px solid white; padding: 8px;'>" . htmlspecialchars($row['password']) . "</td>";
echo "</tr>";

echo "<tr>";
echo "<td style='border: 1px solid white; padding: 8px;'><b>Email:</b></td>";
echo "<td style='border: 1px solid white; padding: 8px;'>" . htmlspecialchars($row['email']) . "</td>";
echo "</tr>";

echo "<tr>";
echo "<td style='border: 1px solid white; padding: 8px;'><b>Contact:</b></td>";
echo "<td style='border: 1px solid white; padding: 8px;'>" . htmlspecialchars($row['contact']) . "</td>";
echo "</tr>";

echo "</table>";


            ?>

 </div>
            <!-- Centered button -->
            <button type="submit" class="btn" id="submitBtn" name="submit1" onclick="transformButton()">Edit</button>

            <!-- Loading Spinner -->
            <div id="spinner" class="loading-spinner" style="display: none;"></div>
            <!-- Green Checkmark -->
            <span id="checkmark" class="checkmark" style="display: none;">&#10003;</span>
        </form>
    
        <?php

if(isset($_POST['submit1']))
{


?>
<script type="text/javascript">
    window.location="edit.php";
</script>
<?php
        
}
?>
    </div>
</div>


    <footer>
        <!-- Footer content -->
    </footer>
</body>
</html>
