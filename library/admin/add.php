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
    <title>BOOKS</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

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

        
    
#sidebar {
    height: 80vh;
    width: 250px;
    position: fixed;
    top: 0;
    left: 20px;
    background-color: white;
    color: black;
    border-right: 2px solid skyblue;
    overflow: hidden;
    transition: width 0.5s ease, border-radius 0.5s ease;
    z-index: 1000;
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    margin-top: 130px;
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
  .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 60vh;
            background-color: skyblue;
            width: 900px;
            margin-left: 550px;
            margin-top: 100px;
            border-radius: 60px;
            opacity:.9;
            position: relative;
         transition: background-color 0.3s ease, opacity 0.3s ease; /* Smooth transition */
        }
        .container:hover{
background-color: antiquewhite;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .book .form-control {
            border-radius: 30px;
            width: 80%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            font-size: 16px;
            

        }

        .book .form-control:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);

        }

        .book .form-button {
            border-radius: 30px;
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 12px 30px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 15px;
            width: 80%;
        }

        .book .form-button:hover {
            background-color: #0056b3;
        }

        .form-control::placeholder {
            color: #888;
        }
           
         .btn {
    display: block;
    margin: 10px auto; /* Center the button */
    padding: 10px 20px;
    font-size: 16px;
    background-color: #4682b4;
    border: none;
    color: white;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.3s ease, transform 0.3s ease;
   margin-left: 860px;
width: 100px;
}



        .btn:hover {
            background-color: #4682b4;
        }




              @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

                /* Loading spinner style */
        .loading-spinner {
            border: 5px solid #f3f3f3; /* Light background */
            border-top: 5px solid skyblue; /* Blue color for the spinner */
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 2s linear infinite;
            margin: 5px auto;
            margin-left: 970px;
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
.book-box img {
    width: 100%;
    height: 200px;
    object-fit: cover;
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
               document.getElementById('bookForm').submit();
    }, 4000);// 5 seconds loading time
        }


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
                         <li><a style="font-family: cursive;" href="profile.php">PROFILE</a></li>
                    <?php } else { ?>
                        <li><a style="font-family: cursive;" href="../login.php">LOGIN</a></li>
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
    

<br><br>
 
<h2 style="font-family:cursive;font-size: 25px;margin-left: 96px;"><strong>ADD NEW BOOKS</strong></h2>
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

    <a href="add.php"><i class="fas fa-plus-circle"></i><span> Add Books</span></a>

    <?php if (isset($_SESSION['login_user'])) { ?>

        
        <a href="books.php"><i class="fas fa-book"></i><span> Books</span></a>

        <a href="aboutus.php"><i class="fas fa-info-circle"></i><span> About Us</span></a>
              <a href="gallery.php"><i class="fas fa-images"></i><span>Books Gallery</span></a>

        <a href="logout.php"><i class="fas fa-sign-out-alt"></i><span> Logout</span></a>
       
    <?php } else { ?>
        <a href="../login.php"><i class="fas fa-sign-in-alt"></i><span> Login</span></a>
        <a href="registration.php"><i class="fas fa-user-plus"></i><span> Sign Up</span></a>
    <?php } ?>
</div>

<div id="main-content">
   
</div>
 <div class="container">
    
       <form class="book" action="" method="post" id="bookForm" enctype="multipart/form-data">


    <input type="text" name="title" class="form-control" placeholder="Title" required=""  style="border-radius: 30px;width: 600px;height: 20px;">  </input>
   <br>
    <input type="text" name="edition" class="form-control" placeholder="Edition" required=""  style="border-radius: 30px;width: 600px;height: 20px;">  </input>
   <br>
    <input type="text" name="status" class="form-control" placeholder="Status" required=""  style="border-radius: 30px;width: 600px;height: 20px;">  </input>
      <br>

       <input type="text" name="quantity" class="form-control" placeholder="Quantity" required=""  style="border-radius: 30px;width: 600px;height: 20px;">  </input>
      <br>

    <input type="text" name="author_name" class="form-control" placeholder="Author" required=""  style="border-radius: 30px;width: 600px;height: 20px;">  </input>
    <br>
        <input type="text" name="dept_name" class="form-control" placeholder="Department" required=""  style="border-radius: 30px;width: 600px;height: 20px;">  </input>
        <br>

      <input class="form-control" type="file" name="file"><br>
     </div>
            <!-- Centered button -->
            <button type="submit" class="btn" name="submit" id="submitBtn" onclick="transformButton(event)">Edit</button>

            <!-- Loading Spinner -->
            <div id="spinner" class="loading-spinner" style="display: none;"></div>
            <!-- Green Checkmark -->
            <span id="checkmark" class="checkmark" style="display: none;">&#10003;</span>
        </form>
    </div>
</div>
<?php

if (isset($_POST['submit'])) {
    $title = mysqli_real_escape_string($db, $_POST['title']);
    $edition = mysqli_real_escape_string($db, $_POST['edition']);
    $status = mysqli_real_escape_string($db, $_POST['status']);
    $author_name = mysqli_real_escape_string($db, $_POST['author_name']);
        $quantity = mysqli_real_escape_string($db, $_POST['quantity']);
    
    $dept_name = isset($_POST['dept_name']) ? mysqli_real_escape_string($db, $_POST['dept_name']) : '';

    // Check if an image file is uploaded
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];
        $fileType = mime_content_type($_FILES['file']['tmp_name']);
        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

        // Validate file type
        if (in_array($fileType, $allowedTypes)) {
           $newFileName = uniqid() . '.' . $fileExtension; 
            $uploadPath = 'images/' . $newFileName;

            if (move_uploaded_file($fileTmpName, $uploadPath)) {
                // Insert book details into the database
                $bookQuery = "INSERT INTO books (title, edition, status,quantity, pic) VALUES ('$title', '$edition', '$status','$quantity' ,'$fileName')";
                if (mysqli_query($db, $bookQuery)) {
                    $bookid = mysqli_insert_id($db);

                    // Insert author details
                    $authorQuery = "INSERT INTO book_authors (bookid, author_name) VALUES ('$bookid', '$author_name')";
                    if (mysqli_query($db, $authorQuery)) {
                        // Insert department details
                        $departmentQuery = "INSERT INTO book_department (bookid, dept_name) VALUES ('$bookid', '$dept_name')";
                        if (mysqli_query($db, $departmentQuery)) {
                            echo "<script>alert('Book, Author, and Department added successfully!');</script>";
                        } else {
                            echo "<script>alert('Error adding department.');</script>";
                        }
                    } else {
                        echo "<script>alert('Error adding author.');</script>";
                    }
                } else {
                    echo "<script>alert('Error adding book.');</script>";
                }
            } else {
                echo "<script>alert('Failed to upload image.');</script>";
            }
        } else {
            echo "<script>alert('Invalid image file type. Allowed types: jpg, jpeg, png, gif.');</script>";
        }
    } else {
        echo "<script>alert('Please upload a valid image.');</script>";
    }
}

?>


</div>
   <br>
</form>
   </div>
</body>
</html>

