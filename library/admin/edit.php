<?php
  include "connection.php";  // Ensure this file is correctly connecting to the database
  session_start();
  if (!isset($_SESSION['login_user'])) {
    // Redirect to the login page if the user is not logged in
    header("Location: ../login.php");
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
  <link rel="stylesheet" type="text/css" href="style.css">
     <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="style.css">
  <title>Book Request</title>


   <style>
        /* Table styles */
     /* Table styles */
table {
    width: calc(110% - 80px); /* Adjust the table width to leave space on both sides */
    margin: 50px auto; /* Add margin to the top, bottom, and center it horizontally */
    border-collapse: collapse;
    font-family: Arial, sans-serif;
    padding: 0 20px; /* Add padding to the left and right sides */

margin-left: -70px;

 
}

th, td {
    padding: 12px;
    text-align: left;
    border: 1px solid #ddd;
width: 10%;
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
  
.container{

background-color:white ;
height: 700px;
width:1300px ;
margin-left:380px;

}
label{
	color: black;
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

 
.box2{
	margin-top: -580px;
	margin-right: 610px;
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
.box2{

position: relative;
}
   .notification {
            width: 80%;
            margin: 20px auto;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
            font-family: Arial, sans-serif;
            font-size: 16px;
            color: white;
        }

        .notification.success {
            background-color: #4CAF50; /* Green */
        }

        .notification.error {
            background-color: #f44336; /* Red */
        }

        .notification.info {
            background-color: #2196F3; /* Blue */
        }
    </style>





</head>

<body>
	<!-- Display Notification Message -->
    <?php if (isset($message)): ?>
        <div class="notification <?php echo $message_type; ?>">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

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
<header>
 <div class="logo "><img src="book2.png" alt="Library Logo"></div>
    
</header>
<?php
$sql="SELECT ad.first,ad.last,ad.contact,a.username,a.password,a.email FROM admin a , admin_details ad where a.admin_id = ad.admin_id and username='$_SESSION[login_user]' ";
$result=mysqli_query($db,$sql) or die(mysql_error());

while ($row=mysqli_fetch_assoc($result)) {
	$first=$row['first'];
	$last=$row['last'];
	$username=$row['username'];
	$password=$row['password'];
	$email=$row['email'];
	$contact=$row['contact'];



	// code...
}
?>
<div class="container">
    <h2 style="text-align: center;font-family: cursive;font-size: 30px;margin-top: 40px;color: skyblue;"><strong>Edit Information</strong></h2>

<div style="margin-top: 30px;"><b style="font-family:cursive;color:black;margin-left: 600px;font-size: 20px;">Welcome,</b></div>
            <h4 style="color: skyblue;font-family: cursive;margin-left: 610px;font-size: 20px;">
            	<?php echo $_SESSION['login_user'];?>
            </h4>

 

</div>
<br><br>
<section>
  <div class="box2">
    <strong><h1 style="font-family: cursive; font-size: 24px; color: black;"></h1></strong><br>
    <form action="" method="post" enctype="multipart/form-data">
     
     <label><h4><b style="font-family:cursive;">First Name </b></h4> </label>
        <input class="form-control" type="text" name="first" value="<?php echo $first; ?>"><br>
        <label><h4><b style="font-family:cursive;">Last Name </b></h4> </label>

        <input class="form-control" type="text" name="last" value="<?php echo $last; ?>"><br>
        <label><h4><b style="font-family:cursive;">Username </b></h4> </label>

        <input class="form-control" type="text" name="username" value="<?php echo $username; ?>"><br>
        <label><h4><b style="font-family:cursive;">Password </b></h4> </label>

        <input class="form-control" type="text" name="password" value="<?php echo $password; ?>"><br>
        <label><h4><b style="font-family:cursive;">Email </b></h4> </label>

        <input class="form-control" type="text" name="email" value="<?php echo $email; ?>"><br>
        <label><h4><b style="font-family:cursive;">Contact </b></h4> </label>

        <input class="form-control" type="text" name="contact" value="<?php echo $contact; ?>"><br>

        <input class="form-control" type="file" name="file"><br>



  <!-- Centered button -->
            <button type="submit" class="btn" id="submitBtn" name="submit1"  onclick="transformButton()">Save</button>

            <!-- Loading Spinner -->
            <div id="spinner" class="loading-spinner" style="display: none;"></div>
            <!-- Green Checkmark -->
            <span id="checkmark" class="checkmark" style="display: none;">&#10003;</span>
     
    </form>
  </div>
  <?php
if (isset($_POST['submit1'])) {
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        move_uploaded_file($_FILES['file']['tmp_name'], "images/" . $_FILES['file']['name']);
        $picture = $_FILES['file']['name'];
    } else {
        // Handle file upload error
        $message = "Error uploading file.";
        $message_type = "error";
        exit;
    }

    $first = $_POST['first'];
    $last = $_POST['last'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];

    // Retrieve admin_id for the logged-in user
    $admin_id_query = "SELECT admin_id FROM admin WHERE username = ?";
    $stmt = mysqli_prepare($db, $admin_id_query);
    mysqli_stmt_bind_param($stmt, "s", $_SESSION['login_user']);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $admin_id);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    if ($admin_id) {
        // Update the admin table
        $sql1 = "UPDATE admin SET picture = ?, username = ?, password = ?, email = ? WHERE admin_id = ?";
        $stmt1 = mysqli_prepare($db, $sql1);
        mysqli_stmt_bind_param($stmt1, "ssssi", $picture, $username, $password, $email, $admin_id);
        if (mysqli_stmt_execute($stmt1)) {
            // Success
            $message = "Update successful.";
            $message_type = "success";
        } else {
            // Error updating admin
            $message = "Error updating admin data: " . mysqli_error($db);
            $message_type = "error";
        }
        mysqli_stmt_close($stmt1);

        // Update the admin_details table
        $sql2 = "UPDATE admin_details SET first = ?, last = ?, contact = ? WHERE admin_id = ?";
        $stmt2 = mysqli_prepare($db, $sql2);
        mysqli_stmt_bind_param($stmt2, "sssi", $first, $last, $contact, $admin_id);
        if (!mysqli_stmt_execute($stmt2)) {
            // Error updating admin details
            $message = "Error updating admin details: " . mysqli_error($db);
            $message_type = "error";
        }
        mysqli_stmt_close($stmt2);
    } else {
        // Admin not found
        $message = "Error: Admin not found.";
        $message_type = "error";
    }
}


?>
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
        <a href="about.php"><i class="fas fa-info-circle"></i><span> About Us</span></a>
        <a href="request.php"><i class="fas fa-paper-plane"></i><span> Request Books</span></a>
        <a href="expired.php"><i class="fas fa-exclamation-circle"></i><span>  Expired Books</span></a>
        <a href="issue_info.php"><i class="fas fa-eye"></i><span> Issue Info</span></a>
               <a href="gallery.php"><i class="fas fa-images"></i><span>Books Gallery</span></a>

         <a href="logout.php"><i class="fas fa-sign-out-alt"></i><span> Logout</span></a>




    <?php } else { ?>
        <a href="../login.php"><i class="fas fa-sign-in-alt"></i><span> Login</span></a>
        <a href="registration.php"><i class="fas fa-user-plus"></i><span> Sign Up</span></a>
    <?php } ?>
</div>


</body>
</html>