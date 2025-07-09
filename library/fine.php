

<?php
  include "connection.php";  // Ensure this file is correctly connecting to the database
  session_start();
  if (!isset($_SESSION['login_user'])) {
    // Redirect to the login page if the user is not logged in
    header("Location: login.php");
    exit(); // Ensures that the script stops executing after the redirect
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <title>Fine Calculation</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        /* Table styles */
table {
    width: calc(90% - 90px); /* Adjust the table width to leave space on both sides */
    margin: 20px auto; /* Add margin to the top, bottom, and center it horizontally */
    border-collapse: collapse;
    font-family: Arial, sans-serif;
    padding: 0 20px; /* Add padding to the left and right sides */

 
}

th, td {
    padding: 12px;
    text-align: left;
    border: 1px solid #ddd;
}

th {
    background-color: skyblue ;
    color: #333;
     box-sizing: border-box;
}

td {
    background-color: #f9f9f9;
}

tr:nth-child(even) td {
    background-color: #f1f1f1;
}

tr:hover {
    background-color: #ddd;
}

        /* Optional: Border and hover effects */
        .table-bordered th, .table-bordered td {
            border: 1px solid #ddd;
        }

        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }
        .search{
            padding-left: 1580px;

        }
        .welcome{
            flex-grow:1;
            text-align: center;
         font-family: cursive;
            color:black;

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

.profile_img {
    border-radius: 50%; /* This makes the image circular */
    object-fit: cover;  /* Ensures the image covers the area of the circle */
}
    
    /* Modal Styling */
.modal {
    display: none; /* Hidden by default */
    position: fixed;
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7); /* Black background with opacity */
}

.modal-content {
    background-color: #fff;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 600px;
    text-align: center;
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

/* Profile Image */
.profile_img {
    border-radius: 50%;
    object-fit: cover;
}

/* Style for file upload form inside the modal */
form {
    margin-top: 20px;
}
input[type="file"] {
    margin-bottom: 10px;
}
button {
    padding: 10px;
    background-color: skyblue;
    border: none;
    cursor: pointer;
}
button:hover {
    background-color: lightblue;
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
#demo {
    position: absolute;
    
    
    transform: translate(-50%, -50%);
    font-size: 30px;
    color: #ff1503;
    margin-bottom:-450px ;
    margin-top: 10px;
left:60%;
    border: 2px solid #ff1503;  /* Border around the timer */
    padding: 10px;  /* Padding inside the border */
    border-radius: 8px;  /* Rounded corners for the border */
    background-color: rgba(255, 255, 255, 0.7);  /* Light background */
}


    </style>

    <script >
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
<!----------------------------------------------------------------------------->




<!----------------------------------------------------------------------------->



    <nav>
        <ul>
            
            <li><a style="font-family:cursive;" href="index.php">HOME</a></li>
            <li><a style="font-family:cursive;" href="feedback.php">FEEDBACK</a></li>

             <?php
                    // If the user is logged in, show LOGOUT, else show LOGIN and SIGNUP
                    if (isset($_SESSION['login_user'])) { ?>
                        
                       

                        <li><a style="font-family:cursive;word-spacing: 4px ;-spacing: 3px;" href="student.php">STUDENT INFORMATION</a></li>

                        <li><a style="font-family: cursive;" href="logout.php">LOGOUT</a></li>
                    <?php } else { ?>
                        <li><a style="font-family: cursive;" href="login.php">LOGIN</a></li>
                        <li><a style="font-family: cursive;" href="registartion.php">SIGNUP</a></li>
                    <?php } ?>
          


        </ul>
    </nav>
 <p id="demo"></p> 


    <?php 
            if(isset($_SESSION['login_user']))
            { ?>



                <div class="welcome-messages" style="text-align: center;font-family: cursive;padding: 60px;font-size: 30px;">


                    <?php
                    echo "<a href='profile.php'><img class='img-circle profile_img'height=50 width=50 src='images/".$_SESSION['pic']."'></a>";
                      echo "  " .$_SESSION['login_user']; 

                    ?>
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
        <a href="about.php"><i class="fas fa-info-circle"></i><span> About Us</span></a>
        <a href="request.php"><i class="fas fa-paper-plane"></i><span> Request Books</span></a>
        <a href="issue_info.php"><i class="fas fa-eye"></i><span> Issue Information</span></a>
         <a href="fine.php"><i class="fas fa-dollar-sign"></i><span>Fine</span></a>

         <a href="logout.php"><i class="fas fa-sign-out-alt"></i><span> Logout</span></a>




    <?php } else { ?>
        <a href="login.php"><i class="fas fa-sign-in-alt"></i><span> Login</span></a>
        <a href="registration.php"><i class="fas fa-user-plus"></i><span> Sign Up</span></a>
    <?php } ?>
</div>

<div id="main-content">
    <!-- Your existing content goes here -->
</div>
<?php

            }
            ?>
</header>

<script>
// Set the date we're counting down to
var countDownDate = new Date('Nov 23,2024 23:00:00').getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  document.getElementById("demo").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "EXPIRED";
  }
}, 1000);
</script>
    

<br><br>
 
<h2 style="font-family:cursive;font-size: 25px;margin-left: 110px;"><strong>LIST OF STUDENTS</strong></h2>





<?php

$res = mysqli_query($db, "SELECT *  from fine where username='$_SESSION[login_user]';");

echo "<table class='table table-bordered table-hover'>";
echo "<tr>";
    echo "<th>Username</th>";
    echo "<th>BookID</th>";
    echo "<th>Return Date</th>";
    echo "<th>Days</th>";
    echo "<th>Fines in $</th>";
    echo "<th>Status</th>";
echo "</tr>";

while($row = mysqli_fetch_assoc($res)) {
    echo "<tr>";
         echo "<td>" . $row['username'] . "</td>";
        echo "<td>" . $row['bookid'] . "</td>";
        echo "<td>" . $row['returned'] . "</td>";
        echo "<td>" . $row['day']. "</td>";
        echo "<td>" . $row['fine'] ."</td>";
        echo "<td>" .$row['status']."</td>";
    echo "</tr>";
}
echo "</table>";



?>

</body>
</html>
