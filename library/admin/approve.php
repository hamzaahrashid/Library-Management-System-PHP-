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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="style.css">
  <title>Approve Request</title>

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

    .search {
      padding-left: 1580px;
    }

    .welcome {
      flex-grow: 1;
      text-align: center;
      font-family: cursive;
      color: black;
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

    .logo {
      margin-left: 40px;
    }

    .no-req {
      color: black;
      font-size: 30px;
      font-weight: bold;
      text-align: center;
      margin-top: 20px;
    }

    .search {
      margin-top: 10px;
    }

    form.Approve {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      margin-top: 30px;
    }

    form.Approve .form-group {
      width: 200px;
      max-width: 400px; /* Set maximum width for inputs */
      margin-bottom: 15px;
      text-align: center;
    }

    form.Approve label {
      display: block;
      margin-bottom: 5px;
      font-family: cursive;
      font-size: 14px;
      color: #333;
    }

    form.Approve .form-control {
      width: 200px; /* Make inputs stretch to the container's width */
      padding: 10px;
      font-size: 14px;
      border: 1px solid #ccc;
      border-radius: 5px;
      text-align: center;
    }

    form.Approve .form-control.date-input {
      font-size: 16px; /* Adjust font size for date inputs */
      height: 40px; /* Adjust height of date inputs */
      font-family: cursive;
    }

    form.Approve button {
      width: 150px;
      padding: 10px;
      background-color: white;
      color: black;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
    }

    form.Approve button:hover {
      background-color: lightgreen;
    }

    .background-box {
      background-color: skyblue; /* Sky blue background color */
      padding: 15px; /* Add spacing inside the box */
      border-radius: 10px; /* Rounded corners */
      max-width: 500px; /* Maximum width for the box */
      margin: 190px auto; /* Center the box horizontally and add spacing */
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Optional: Add shadow for better aesthetics */
    }

    .background-box:hover {
      background-color: white;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      transition: all 0.3s ease; /* Smooth transition effect */
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
    <div class="logo"><img src="book2.png" alt="Library Logo"></div>
  </header>
  <div class="container">
    <h3 style="text-align: center; font-size: 20px; font-family: cursive; margin-top: 30px;">Approve Request</h3>

    <div class="background-box">
      <form class="Approve" action="" method="post">
        <!-- Dropdown for Approve/Disapprove -->
        <select name="approve" class="form-control" required>
          <option value="">Select Action</option>
          <option value="approve">Approve</option>
          <option value="disapprove">Disapprove</option>
        </select><br>

        <!-- Hidden inputs for Issue Date and Return Date -->
        <?php
          $issue_date = date('Y-m-d'); // Current date
          $return_date = date('Y-m-d', strtotime('+7 days')); // 7 days from current date
          $formatted_return_datetime = date('M d, Y H:i:s', strtotime('+7 days')); // Formatted for the timer
        ?>
        <input type="hidden" name="issue" value="<?php echo $issue_date; ?>">
        <input type="hidden" name="retrn" value="<?php echo $return_date; ?>">

        <!-- Display Issue Date and Return Date as read-only for user visibility -->
        <label for="issue-date">Issue Date:</label>
        <input id="issue-date" type="text" class="form-control" value="<?php echo $issue_date; ?>" readonly><br>

        <label for="return-date">Return Date:</label>
        <input id="return-date" type="text" class="form-control" value="<?php echo $return_date; ?>" readonly><br>

        <label for="return-datetime">Return Date and Time:</label>
        <input type="text" name="tm" class="form-control" value="<?php echo $formatted_return_datetime; ?>" required><br>

        <button class="btn btn-default" type="submit" name="submit">Submit</button>
      </form>
    </div>
  </div>
  <div id="sidebar">
    <div class="profile">
      <?php if (isset($_SESSION['login

_user'])) { ?>
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
      <a href="aboutus.php"><i class="fas fa-info-circle"></i><span> About Us</span></a>
      <a href="request.php"><i class="fas fa-paper-plane"></i><span> Request Books</span></a>
      <a href="issue_info.php"><i class="fas fa-eye"></i><span> Issue Information</span></a>
      <a href="gallery.php"><i class="fas fa-images"></i><span> Books Gallery</span></a>
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
  if (isset($_POST['submit'])) {
    mysqli_query($db, "INSERT into timer values ('','$_SESSION[st_name]','$_SESSION[bid]','$_POST[tm]');");
    
    mysqli_query($db, "UPDATE `issue_book` SET `approve`='$_POST[approve]',`issue`='$_POST[issue]',`retrn`='$_POST[retrn]' where `username`='$_SESSION[st_name]' and bookid='$_SESSION[bid]';");

    mysqli_query($db, "UPDATE books SET quantity = quantity-1 where bookid='$_SESSION[bid]' ;");

    $res = mysqli_query($db, "SELECT quantity from books where bookid='$_SESSION[bid]';");

    while ($row = mysqli_fetch_assoc($res)) {
      if ($row['quantity'] == 0) {
        mysqli_query($db, "UPDATE books set status = 'Not Available' where bookid='$_SESSION[bid]';");
      }
    }
    ?>
    <script type="text/javascript">
      alert("Updated Successfully.");
      window.location = "request.php";
    </script>
    <?php
  }
  ?>
</body>
</html>