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
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BOOKS</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="style.css">
  <title>Book Request</title>


   <style>
        /* Table styles */
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
    background-color: skyblue;
    color: #333;
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
    .profile_img {
    border-radius: 20%; /* This makes the image circular */
    object-fit: cover;  /* Ensures the image covers the area of the circle */
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

.hamburger {
    position: fixed;
    top: 15px;
    left: 10px;
    font-size: 25px;
    cursor: pointer;
    z-index: 1100;
    color: black;
    background-color: white;
    border: 2px solid skyblue;
    border-radius: 5px;
    padding: 5px 10px;
    transition: background-color 0.3s;
}

.hamburger:hover {
    background-color: skyblue;
    color: white;
}
.logo{
    margin-left: 40px;
}

    .no-req {
        color: black;
        font-size: 30px;
        font-weight: bold;
        text-align: center;
        margin-top: 20px;
    }
    .search{
      margin-top: 10px;
    }


    </style>

</head>

<body>

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

  <header>
      <div class="logo "><img src="book2.png" alt="Library Logo"></div>
    <nav>
        <ul>
            <li><a style="font-family:cursive;" href="index.php">HOME</a></li>
            <li><a style="font-family:cursive;" href="feedback.php">FEEDBACK</a></li>

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
                <div class="welcome-messages" style="text-align: center;font-family: cursive;padding: 60px;font-size: 20px;">
                  <?php
                    echo "<a href='profile.php'><img class='img-circle profile_img'height=50 width=50 src='images/".$_SESSION['pic']."'></a>";
                      echo "  " .$_SESSION['login_user']; 

                    ?>
                </div>

<?php

            }
            ?>


  </header>

   <div class="search">
        <form class = "navbar-form" method="post" name="form1">
            
            
            <input class="form-control" type="text" name="search" placeholder="search books..">
            <button style="width:100px; height: 30px;background-color: skyblue; " ; type="submit" name="submit1" class="btn btn-default">Search</button>
            
        </form>
        
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
        <a href="request.php"><i class="fas fa-paper-plane"></i><span> Request Books</span></a>
        <a href="request.php"><i class="fas fa-eye"></i><span> Issue Info</span></a>
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

if(isset($_SESSION['login_user']))
{

$q = mysqli_query($db, "SELECT issue_id,bookid,approve,issue,approve,retrn 
                        FROM issue_book  
                        WHERE username = '$_SESSION[login_user]';");


if(mysqli_num_rows($q)==0)
{
echo "<p class = 'no-req'> There's no pending request. </p>";

}

else
{
    echo "<table class='table table-bordered table-hover'>";
echo "<tr>";
    echo "<th>Issue-ID</th>";
    echo "<th>Book-ID</th>";
    echo "<th>Approve Status</th>";
    echo "<th>Issue Date</th>";
    echo "<th>Return Date</th>";

echo "</tr>";

while($row = mysqli_fetch_assoc($q)) {
    echo "<tr>";

        echo "<td>" . $row['issue_id'] . "</td>";
        echo "<td>" . $row['bookid'] . "</td>";
        echo "<td>" . $row['approve'] . "</td>";
        echo "<td>" . $row['issue'] . "</td>";
        echo "<td>" . $row['retrn'] . "</td>";
  
    echo "</tr>";
}
echo "</table>";

}

}
?>


</body>
</html>