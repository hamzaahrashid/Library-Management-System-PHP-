<?php
include "connection.php";
session_start();

if (!isset($_SESSION['login_user'])) {
    // Redirect to the login page if the user is not logged in
    header("Location: login.php");
    exit(); // Ensures that the script stops executing after the redirect
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Feedback</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
     <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>

        /* Additional styles for footer */

        header {
            height: 100px;
    position: relative; /* Ensures that items within the header stay inside it */
    height:100px; /* Set a fixed height for the header */
}

        

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            margin: 0;
        }
        .wrapper {
            flex: 1;
            overflow: auto;
        }
        .sec_img img {
            border: 5px solid skyblue;
            border-radius: 10px;
            padding: 10px;
            width: 80%;
            display: block;
            margin: 0 auto;
        }
        .comment {
            padding: 20px;
            margin: 140px auto;
            width: 1200px;
            height: 600px auto;
            max-width: 1200px;
            background-color: skyblue;
            opacity: 0.85;
            color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        .comment h4 {
            font-family: Arial, sans-serif;
            font-size: 1.2em;
            margin-bottom: 15px;
            color: black;
        }
        .comment form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .form-control {
            height: 200px; /* Increased height */
            width: 90%;
            max-width: 500px;
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            font-size: 1rem;
            resize: vertical; /* Allows the user to resize the textarea */
        }
        .btn {
            background-color: seagreen;
            color: white;
            border: none;
            border-radius: 5px;
            width: 120px;
            height: 40px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: darkgreen;
        }
        .mesg{
            flex-grow: 1;
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

/* Style for the feedback container */
.feedback-container {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

/* Style for each feedback box */
.feedback-box {
    background-color: #f0f8ff; /* Light blue background */
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: row;
    gap: 10px;
    align-items: center;
}

/* Style for each feedback item (each column) */
.feedback-item {
    font-size: 1rem;
    color: #333;
    flex: 1; /* Allows equal distribution of space */
    word-wrap: break-word;  /* Ensure long comments don't overflow */
}

.feedback-item strong {
    color: #007BFF; /* Blue color for the labels */
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
                <h1 style="font-family: cursive; color: black;">BOOKVERSE</h1>
            </div>

            <nav>
                <ul>
                    <li><a style="font-family: cursive;" href="index.php">HOME</a></li>
                    <li><a style="font-family: cursive;" href="books.php">BOOKS</a></li>

                    <?php
                    // If the user is logged in, show LOGOUT, else show LOGIN and SIGNUP
                    if (isset($_SESSION['login_user'])) { ?>
                        <li><a style="font-family: cursive;" href="logout.php">LOGOUT</a></li>
                         <li><a style="font-family: cursive;" href="profile.php">PROFILE</a></li>
                        
                    <?php } else { ?>
                        <li><a style="font-family: cursive;" href="login.php">LOGIN</a></li>
                        <li><a style="font-family: cursive;" href="registartion.php">SIGNUP</a></li>
                    <?php } ?>
                </ul>
            </nav>

            <?php 
            if(isset($_SESSION['login_user']))
            { ?>
                <div class="welcome-message" style="text-align: center;font-family: cursive;padding: 40px;">
                    <?php  echo "Welcome ".$_SESSION['login_user']; 
                    ?>
                </div>
<?php

            }
            ?>
        </header>

        <div class="comment">
            <h4><strong>If you have any suggestions or questions, please comment below.</strong></h4>
            <form action="" method="post">
                <textarea class="form-control" name="comment" placeholder="Write something..."></textarea> <!-- Changed to a textarea -->
                <input class="btn" type="submit" name="submit" value="Comment">
            </form>

            <div>
                <?php
                if (isset($_POST['submit'])) {
                    $sql = "INSERT INTO comment VALUES('','$_SESSION[login_user]' ,'$_POST[comment]');";
                    if (mysqli_query($db, $sql)) {
                        $q = "SELECT * FROM comment ORDER BY comment_id DESC";
                        $res = mysqli_query($db, $q);

                     echo "<div class='feedback-container'>";
            while ($row = mysqli_fetch_assoc($res)) {
                echo "<div class='feedback-box'>";
    
                echo "<div class='feedback-item'><strong>Username:@</strong> " . $row['username'] . "</div>";
                echo "<div class='feedback-item'><strong></strong> " . $row['comments'] . "</div>";
                echo "</div>"; // End feedback-box
            }
            echo "</div>"; // End feedback-container
        }
                } else {
                    $q = "SELECT * FROM comment ORDER BY comment_id DESC";
                    $res = mysqli_query($db, $q);

                      echo "<div class='feedback-container'>";
        while ($row = mysqli_fetch_assoc($res)) {
            echo "<div class='feedback-box'>";
            echo "<div class='feedback-item'><strong>Username:@</strong>" . $row['username'] . "</div>";
            echo "<div class='feedback-item'><strong></strong>" . $row['comments'] . "</div>";
            echo "</div>"; // End feedback-box
        }
        echo "</div>"; // End feedback-container
    }
                ?>
            </div>
        </div>

    </div>
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

</body>
</html>
