<?php
  include "connection.php";
  session_start();

  // Initialize an error message variable
  $message = '';

  // Check if the form is submitted
  if (isset($_POST['submit'])) {
      // Get and sanitize user input
      $username = mysqli_real_escape_string($db, $_POST['username']);
      $password = mysqli_real_escape_string($db, $_POST['password']);
      $roll = mysqli_real_escape_string($db, $_POST['roll']);
      $email = mysqli_real_escape_string($db, $_POST['email']);
      $first = mysqli_real_escape_string($db, $_POST['first']);
      $last = mysqli_real_escape_string($db, $_POST['last']);
      $contact = mysqli_real_escape_string($db, $_POST['contact']);

      // Check if the username already exists in the database
      $check_username = "SELECT username,password FROM student WHERE username = '$username' and password = '$password'";

      $result = mysqli_query($db, $check_username);

      if (mysqli_num_rows($result) > 0) {
          // If username exists, display error message
          $message = "Username or password already taken. Please choose a different one.";
      } else {
          // Insert into 'student' table if username is available
          $query_student = "INSERT INTO student (username, password, roll, email,picture) 
                            VALUES ('$username', '$password', '$roll', '$email','p.jpg')";

          if (mysqli_query($db, $query_student)) {
              // Get the last inserted student_id
              $student_id = mysqli_insert_id($db);

              // Now insert into 'student_info' table
              $query_student_info = "INSERT INTO student_info (student_id, first, last, contact) 
                                     VALUES ('$student_id', '$first', '$last', '$contact')";

              if (mysqli_query($db, $query_student_info)) {
                  $message = "Registration successful!";
              } else {
                  $message = "Error: " . mysqli_error($db);
              }
          } else {
              $message = "Error: " . mysqli_error($db);
          }
      }
  }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>STUDENT REGISTRATION</title>
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

button {
    transition: all 0.4s ease; /* Smoother and slower transition */
    margin-top: 20px;
    width: 20%;
    padding: 10px;
    background-color: skyblue; /* Default background */
    color: white; /* Default text color */
    border: none;
    border-radius: 8px; /* Rounded corners */
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2); /* Subtle shadow */
    cursor: pointer; /* Pointer cursor on hover */
    font-weight: bold; /* Make text stand out */
}

button:hover {
    background-color: white; /* Change to white on hover */
    color: black; /* Text color on hover */
    transform: scale(1.1); /* Slight zoom effect */
    box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.3); /* Enhanced shadow on hover */
}

.box2{
    height: 40%;
}

    </style>
</head>
<body>

<header>
    <div class="logo"><img src="book2.png" alt="Library Logo"></div>
    <nav>
        <ul>
            <li><a style="font-family:cursive;" href="index.php">HOME</a></li>
            <li><a style="font-family:cursive;" href="books.php">BOOKS</a></li>
            <li><a style="font-family:cursive;" href="login.php">LOGIN</a></li>
            <li><a style="font-family:cursive;" href="feedback.php">FEEDBACK</a></li>
        </ul>
    </nav>
</header>

<section>
    <div class="box2">
        <strong><h1 style="font-family:cursive ;font-size: 20px;color:black;">REGISTRATION FORM</h1><strong><br>
        <form name="Login" action="" method="post">
               <b><p style="padding-right: 220px;font-size: 24px;font-weight: 600;font-family: cursive;margin-top: 20%;">Login as </p><br>

                <label for="admin" style="font-family:cursive;font-size: 20px;">Admin</label>
<input type="radio" name="user" id="admin" value="admin" style="margin-left: 10px;width: 20px;">
&nbsp&nbsp

<label for="student" style="font-family:cursive;font-size: 20px;">Student</label>
<input type="radio" name="user" id="student" value="student"style="margin-left: 10px;width: 20px;">


<button class="btn btn-default" type="submit" name="submit2" >Ok</button>
</section>

<?php

if(isset($_POST['submit2']))
{
    if($_POST['user']=='admin')
    {
        ?>
  echo "<script type='text/javascript'>
                window.location = 'admin/registration.php';
            </script>";
            <?php
    }
    else
    {
        ?>
          echo "<script type='text/javascript'>
                window.location = 'student/registration.php';
            </script>";
        <?php
    }
}
?>

</body>
</html>
