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
    transition: margin-left: 0.3s ease;
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

.container{

background-color:white ;
opacity: .7;
height: 700px;
width:1300px ;
margin-left:380px;

}
.align-right-form {
    display: flex;
    flex-direction: column; /* Stack items vertically */
    align-items: right; /* Align all elements to the right */
    gap: 10px; /* Add spacing between inputs and button */
margin-left: 1190;
}

.align-right-form .form-control {
    width: 315px; /* Set a consistent width for the inputs */
}

.align-right-form button {
    width: 100px; /* Optional: Set button width */
}

.scroll{
    width: 100%;
    height: 50px;
    overflow: auto;
}

.btn {
    font-size: 14px;
    padding: 5px 15px;
    height: 32px;
    border: none;
    border-radius: 7px;
    color: white;
    cursor: pointer;
    transition: all 0.3s ease-in-out; /* Smooth hover transitions */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Subtle shadow */
}

/* Returned Button Styling */
.btn-returned {
    background-color: #28a745; /* Green */
}
.btn-returned:hover {
    background-color: #218838; /* Darker green */
    box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2); /* Enhanced shadow on hover */
}

/* Expired Button Styling */
.btn-expired {
    background-color: #dc3545; /* Red */
}
.btn-expired:hover {
    background-color: #c82333; /* Darker red */
    box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2); /* Enhanced shadow on hover */
}

/* Add spacing between buttons */
div button {
    margin-right: 10px;
}
#demo {
    position: absolute;
    left: 75%;
    transform: translate(-50%, -50%);
    font-size: 30px;
    color: skyblue; /* Sky blue text color */

    margin-top: -32px;

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




<header>
 <div class="logo "><img src="book2.png" alt="Library Logo">

<p id="demo"></p>
 </div>
    
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



<!------ <h2 style="text-align: center;font-family: cursive;font-size: 30px;margin-top: 40px;">Information of Expired Books</h2>--->
<div class="container">
<?php
if(isset($_SESSION['login_user']))
    ?>

<div style="float: left;padding: 25px;">
<form method="post" action="">
<button name="submit2" type="submit" class="btn btn-default" style="height: 28px;border-radius:7px ;background-color:green;width: 200px;color: white; ">RETURNED</button>  
<button name="submit3" type="submit" class="btn btn-default" style="height: 28px;border-radius:7px;background-color:red ;width: 200px;color: white;">EXPIRED</button>
</form>
</div>
<?php
if (isset($_SESSION['login_user'])) {
    $day=0;
    $exp='<p style="color:white;background-color:red">EXPIRED</p>';
    $x=mysqli_query($db,"SELECT retrn from issue_book where username='$_SESSION[login_user]' and approve='$exp' ;");
    // Check if query executed successfully
    if (!$x) {
        echo "Error in fine query: " . mysqli_error($db);
    } else {
        while ($row = mysqli_fetch_assoc($x))
        {
            $d= strtotime($row['retrn']);
            $c= strtotime(date("Y-m-d"));
            $diff= $c-$d;
            if($diff>=0)
            {
                $day=$day+ floor($diff/(60*60*24)); // Calculate overdue days
            }
        }
    }

    $_SESSION['fine']=$day*0.10; // Fine is $0.10 per overdue day
}
?>

<div style="float:center;padding-top: 30px;font-size: 20px;">
    <?php
    $var=0;
    $result = mysqli_query($db,"SELECT * from fine where username='$_SESSION[login_user]' and status='not paid';");  // Query to fetch unpaid fines
    // Check if query executed successfully
    if (!$result) {
        echo "Error in unpaid fines query: " . mysqli_error($db);
    } else {
        while ($r = mysqli_fetch_assoc($result))
        {
            $var=$var+$r['fine']; // Sum unpaid fines
        }
    }
    $var2=$var+$_SESSION['fine'];   // Total fine = unpaid fines + current overdue fine
    ?>

<h2>Your Fine is: 
<?php
echo "Rs. ".$var2*279;  // Display total fine in PKR
?>
</h2>    

</div>

 <div class="srch" style="margin-top: 3px;float: right;">
        <form method="post" action="" name="form1" class="align-right-form">
            <input type="text" name="username" class="form-control" placeholder="Username" required="">
            <input type="text" name="bookname" class="form-control" placeholder="Book Name" required="">
            <button class="btn btn-default" name="submit" type="submit">Submit</button>
        </form>
    </div>

<?php
if(isset($_POST['submit']))
{
    // Fetch bookid from books table based on bookname
    $bookname = mysqli_real_escape_string($db, $_POST['bookname']);
    $query = "SELECT bookid FROM books WHERE title = '$bookname'";
    $result = mysqli_query($db, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $bookid = $row['bookid'];
        $var1='<p style="color:white;background-color:green">RETURNED</p>';
        mysqli_query($db,"UPDATE issue_book SET approve='$var1' where username='$_POST[username]' and bookid='$bookid'");
        mysqli_query($db,"UPDATE books SET quantity = quantity+1 where bookid='$bookid'");
    } else {
        echo "Book not found.";
    }
}
?>

   
    <?php

    $c=0;
if(isset($_SESSION['login_user']))
{
      $ret='<p style="color:white;background-color:green">RETURNED</p>';
        $exp='<p style="color:white;background-color:red">EXPIRED</p>';

 if(isset($_POST['submit2']))
 {
$sql=" SELECT 
    s.username,
    s.roll,
    b.bookid,
    b.title,
    b.edition,
    ba.author_name,
    ib.issue_id,
    ib.issue,
    ib.retrn,
    ib.approve
FROM 
    student s
JOIN 
    issue_book ib ON s.username = ib.username
JOIN 
    books b ON b.bookid = ib.bookid
JOIN 
    book_authors ba ON b.bookid = ba.bookid
 where ib.approve='$ret' ORDER BY  ib.retrn DESC";
  $res=mysqli_query($db,$sql);
 }
 else if(isset($_POST['submit3']))
 {
    $sql=" SELECT 
    s.username,
    s.roll,
    b.bookid,
    b.title,
    b.edition,
    ba.author_name,
    ib.issue_id,
    ib.issue,
    ib.retrn,
    ib.approve
FROM 
    student s
JOIN 
    issue_book ib ON s.username = ib.username
JOIN 
    books b ON b.bookid = ib.bookid
JOIN 
    book_authors ba ON b.bookid = ba.bookid
 where ib.approve='$exp'   ORDER BY  ib.retrn DESC";
  $res=mysqli_query($db,$sql);

 }
 else
 {
     $sql=" SELECT 
    s.username,
    s.roll,
    b.bookid,
    b.title,
    b.edition,
    ba.author_name,
    ib.issue_id,
    ib.issue,
    ib.retrn,
    ib.approve
FROM 
    student s
JOIN 
    issue_book ib ON s.username = ib.username
JOIN 
    books b ON b.bookid = ib.bookid
JOIN 
    book_authors ba ON b.bookid = ba.bookid
 where ib.approve!='' and ib.approve!='approve'  ORDER BY  ib.retrn DESC";
  $res=mysqli_query($db,$sql);

 }



echo "<table class='table table-bordered table-hover'>";
echo "<tr>";
    echo "<th>Issue ID</th>";
    echo "<th>Student Username</th>";
    echo "<th>Roll No</th>";
    echo "<th>Book ID</th>";
    echo "<th>Book Name</th>";
    echo "<th>Author's Name</th>";
    echo "<th>Edition</th>";
    echo "<th>Approve</th>";
    echo "<th>Issue Date</th>";
    echo "<th>Return Date</th>";
echo "</tr>";


echo "<div class='scroll'>";
echo "<table class='table table-bordered table-hover'>";
while ($row = mysqli_fetch_assoc($res)) {

  
    echo "<tr>";
    echo "<td>" . $row['issue_id'] . "</td>";
    echo "<td>" . $row['username'] . "</td>";
    echo "<td>" . $row['roll'] . "</td>";
    echo "<td>" . $row['bookid'] . "</td>";
    echo "<td>" . $row['title'] . "</td>";
    echo "<td>" . $row['author_name'] . "</td>";
    echo "<td>" . $row['edition'] . "</td>";
        echo "<td>" . $row['approve'] . "</td>";
    echo "<td>" . $row['issue'] . "</td>";
    echo "<td>" . $row['retrn'] . "</td>";
    echo "</tr>";
}

echo "</table>";



}
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
        <a href="books.php"><i class="fas fa-book"></i><span> Books</span></a>
        
        <a href="request.php"><i class="fas fa-paper-plane"></i><span> Request Books</span></a>
        <a href="expired.php"><i class="fas fa-clock"></i><span>  Expired Books</span></a>
        <a href="fine.php"><i class="fas fa-dollar-sign"></i><span>Fine</span></a>
<a href="aboutus.php"><i class="fas fa-info-circle"></i><span> About Us</span></a>
       <a href="gallery.php"><i class="fas fa-images"></i><span>Books Gallery</span></a>

         <a href="logout.php"><i class="fas fa-sign-out-alt"></i><span> Logout</span></a>




    <?php } else { ?>
        <a href="../login.php"><i class="fas fa-sign-in-alt"></i><span> Login</span></a>
        <a href="registration.php"><i class="fas fa-user-plus"></i><span> Sign Up</span></a>
    <?php } ?>
</div>

<div id="main-content">
    <!-- Your existing content goes here -->
</div>

</body>
</html>