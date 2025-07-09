<?php
include "connection.php";  // Ensure this file is correctly connecting to the database
session_start();
if (!isset($_SESSION['login_user'])) {
    // Redirect to the login page if the user is not logged in
    header("Location: ../login.php");
    exit();
}

// Pagination Variables
$results_per_page = 5; // Number of results per page

// Get total number of records
$total_records_query = mysqli_query($db, "SELECT COUNT(*) as total FROM student s, student_info si WHERE s.studentid=si.studentid");
$total_records_row = mysqli_fetch_assoc($total_records_query);
$total_records = $total_records_row['total'];

// Calculate total pages
$total_pages = ceil($total_records / $results_per_page);

// Get the current page number from GET; default is 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;
if ($page < 1) $page = 1; // Ensure the page number is at least 1

// Calculate the starting record for the SQL query
$start_from = ($page - 1) * $results_per_page;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <title>Student Information</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        /* Center the table and search bar */
        .search {
            text-align: right;
            margin-right: 90px;
            margin-bottom: 20px;
        }
    
        /* Pagination styling */
        .pagination {
            text-align: center;
            margin: 20px 0;
        }
        .pagination a {
            margin: 0 5px;
            padding: 8px 12px;
            text-decoration: none;
            background-color: lightgray;
            color: black;
            border-radius: 4px;
        }
        .pagination a.active {
            background-color: skyblue;
            color: white;
        }

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
                        <li><a style="font-family: cursive;" href=" ../login.php">LOGIN</a></li>
                        <li><a style="font-family: cursive;" href="registartion.php">SIGNUP</a></li>
                    <?php } ?>
          


        </ul>
    </nav>
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
            <p>Library Admin</p>
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
        <a href="aboutus.php"><i class="fas fa-info-circle"></i><span> About Us</span></a>
        <a href="request.php"><i class="fas fa-paper-plane"></i><span> Request Books</span></a>

               <a href="books.php"><i class="fas fa-book"></i><span>Books</span></a>

               <a href="gallery.php"><i class="fas fa-images"></i><span>Books Gallery</span></a>

        <a href="issue_info.php"><i class="fas fa-eye"></i><span> Issue Information</span></a>
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

            }
            ?>
</header>
<h2 style="font-family:cursive;font-size: 25px;text-align: left;margin-left:110px ;"><strong>LIST OF STUDENTS</strong></h2>
<div class="search">
    <form class="navbar-form" method="post" name="form1">
        <input class="form-control" type="text" name="search" placeholder="Search students...">
        <button style="width:100px; height: 30px;background-color: skyblue;" type="submit" name="submit" class="btn btn-default">Search</button>
    </form>
</div>
<?php
if (isset($_POST['submit'])) {
    $search_query = mysqli_real_escape_string($db, $_POST['search']);
    $q = mysqli_query($db, 
        "SELECT si.first, si.last, s.username, s.roll, s.email, si.contact 
         FROM student s, student_info si 
         WHERE s.studentid=si.studentid 
         AND si.first LIKE '%$search_query%' 
         LIMIT $start_from, $results_per_page"
    );

    if (mysqli_num_rows($q) == 0) {
        echo "<p style='text-align: center; color: red;'>Sorry! No student found with this name.</p>";
    } else {
        echo "<table>";
        echo "<tr>
                <th>Username</th>
                <th>Roll</th>
                <th>Email</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Contact</th>
              </tr>";

        while ($row = mysqli_fetch_assoc($q)) {
            echo "<tr>
                    <td>{$row['username']}</td>
                    <td>{$row['roll']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['first']}</td>
                    <td>{$row['last']}</td>
                    <td>{$row['contact']}</td>
                  </tr>";
        }
        echo "</table>";
    }
} else {
    $res = mysqli_query($db, 
        "SELECT si.first, si.last, s.username, s.roll, s.email, si.contact 
         FROM student s, student_info si 
         WHERE s.studentid=si.studentid 
         LIMIT $start_from, $results_per_page"
    );

    echo "<table>";
    echo "<tr>
            <th>Username</th>
            <th>Roll</th>
            <th>Email</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Contact</th>
          </tr>";

    while ($row = mysqli_fetch_assoc($res)) {
        echo "<tr>
                <td>{$row['username']}</td>
                <td>{$row['roll']}</td>
                <td>{$row['email']}</td>
                <td>{$row['first']}</td>
                <td>{$row['last']}</td>
                <td>{$row['contact']}</td>
              </tr>";
    }
    echo "</table>";
}

// Pagination links
echo "<div class='pagination'>";
for ($i = 1; $i <= $total_pages; $i++) {
    echo "<a href='?page=$i' class='" . ($i == $page ? "active" : "") . "'>$i</a>";
}
echo "</div>";
?>
</body>
</html>
