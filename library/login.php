<?php
  include "connection.php";
 session_start();
?>   

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 100px;
        }
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
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
        .login{
            margin-top: 30px;
            position: relative;
        }
        .label{
            font-size: 20px;
            font-weight: 600;
        }

    </style>
</head>
<body>

<header>
    <div class="logo"><img src="book2.png" alt="Library Logo"></div>
    <nav>
        <ul>
            <li><a href="index.php">HOME</a></li>
            <li><a href="books.php">BOOKS</a></li>
            <li><a href="feedback.php">FEEDBACK</a></li>
            <li><a href="registration.php">SIGNUP</a></li>
        </ul>
    </nav>
</header>

<section>
    <div class="box1">
        <strong><h1 style="font-size: 20px;font-family: cursive;">LOGIN</h1></strong><br>
        <form name="Login" action="" method="post">

            <b><p style="padding-right: 220px;font-size: 15px;font-weight: 600;font-family: cursive;">Login as </p><br>

                <label for="admin">Admin</label>
<input type="radio" name="user" id="admin" value="admin" style="margin-left: 20px;width: 20px;">

<label for="student">Student</label>
<input type="radio" name="user" id="student" value="student"style="margin-left: 20px;width: 20px;">


            <div class="login">
                <input type="text" name="username" placeholder="Username" required=""><br><br>
                <input type="password" name="password" placeholder="Password" required=""><br><br>
                <button type="submit" name="submit">Login</button>
            </div>
        </form>
        <p>
            <br>
            <a style="color: black;" href="update_pass.php"><strong> Forget password? </strong></a> &nbsp &nbsp &nbsp &nbsp 
            <strong> New to this website?</strong> <a style="color: black;" href="registration.php"><strong>&nbsp  Sign Up </strong></a>
        </p>
    </div>
</section>

<!-- Modal for displaying login errors -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p id="modal-message"></p>
    </div>
</div>

<?php
    if (isset($_POST['submit'])) {

        if($_POST['user']=='admin')
        {
                $count = 0;
        $res = mysqli_query($db, "SELECT * FROM admin WHERE username='$_POST[username]' && password='$_POST[password]';");
        
        $row = mysqli_fetch_assoc($res);
        $count = mysqli_num_rows($res);

        if ($count == 0) {
            // Display error message in modal
            echo "<script type='text/javascript'>
                document.getElementById('modal-message').innerText = 'The username and password doesn\'t match';
                document.getElementById('myModal').style.display = 'block';
            </script>";
        } else {
            /*-------------------------------------------------if username & pass matches -------------------------*/
            $_SESSION['login_user'] = $row['username'];
            $_SESSION['pic'] = $row['picture'];



            echo "<script type='text/javascript'>
                window.location = 'admin/profile.php';
            </script>";
        }

        }
        else
        {

            $count = 0;
        $res = mysqli_query($db, "SELECT * FROM student WHERE username='$_POST[username]' && password='$_POST[password]';");
        
        $row = mysqli_fetch_assoc($res);
        $count = mysqli_num_rows($res);

        if ($count == 0) {
            // Display error message in modal
            echo "<script type='text/javascript'>
                document.getElementById('modal-message').innerText = 'The username and password doesn\'t match';
                document.getElementById('myModal').style.display = 'block';
            </script>";
        } else {
            $_SESSION['login_user'] = $row['username'];
            $_SESSION['pic'] = $row['picture'];



            echo "<script type='text/javascript'>
                window.location = 'student/profile.php';
            </script>";
        }
    }
    }
?>

<script>
// JavaScript for handling modal behavior
window.onload = function() {
    var span = document.getElementsByClassName("close")[0];
    span.onclick = function() {
        document.getElementById('myModal').style.display = "none";
    }

    // Close the modal if the user clicks anywhere outside of it
    window.onclick = function(event) {
        if (event.target == document.getElementById('myModal')) {
            document.getElementById('myModal').style.display = "none";
        }
    }
}
</script>

<footer></footer>
</body>
</html>
