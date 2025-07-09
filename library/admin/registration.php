<?php
  include "connection.php";

  // Initialize an error message variable
  $message = '';

  // Check if the form is submitted
  if (isset($_POST['submit'])) {
      // Get and sanitize user input
      $username = mysqli_real_escape_string($db, $_POST['username']);
      $password = mysqli_real_escape_string($db, $_POST['password']);
      $email = mysqli_real_escape_string($db, $_POST['email']);
      $first = mysqli_real_escape_string($db, $_POST['first']);
      $last = mysqli_real_escape_string($db, $_POST['last']);
      $contact = mysqli_real_escape_string($db, $_POST['contact']);

        // Handle file upload
    $image = $_FILES['picture']['name'];
    $imageTmp = $_FILES['picture']['tmp_name'];
    $imageSize = $_FILES['picture']['size'];
    $imageError = $_FILES['picture']['error'];
    
    // Set the image upload directory
    $uploadDir = 'images/';
    
    // Generate a unique name for the image to avoid conflicts
    $imageExtension = pathinfo($image, PATHINFO_EXTENSION);
    $newImageName = uniqid('profile_', true) . '.' . $imageExtension;

    // Move the image to the desired directory
    $imagePath = $uploadDir . $newImageName;
    
    // Validate image size and type
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    
    if ($imageError === 0) {
        if ($imageSize < 5000000) { // Limit file size to 5MB
            if (in_array($imageExtension, $allowedExtensions)) {
                // Move the uploaded image to the 'uploads' folder
                if (move_uploaded_file($imageTmp, $imagePath)) {
                    // Check if the username already exists in the database

      // Check if the username already exists in the database
      $check_username = "SELECT username,password FROM admin WHERE username = '$username' and password = '$password'";
      $result = mysqli_query($db, $check_username);

      if (mysqli_num_rows($result) > 0) {
          // If username exists, display error message
          $message = "Username or password already taken. Please choose a different one.";
          ?>

<script type='text/javascript'>
                window.location = '../login.php';
            </script>; 
      <?php
      }
      else {
          // Insert into 'admin' table if username is available
          $query_admin = "INSERT INTO admin (username, password, email, picture) 
                            VALUES ('$username', '$password', '$email', '$image')";

          if (mysqli_query($db, $query_admin)) {
              // Get the last inserted admin_id
              $admin_id = mysqli_insert_id($db);

              // Now insert into 'admin_details' table
              $query_admin_info = "INSERT INTO admin_details (admin_id, first, last, contact) 
                                     VALUES ('$admin_id', '$first', '$last', '$contact')";

              if (mysqli_query($db, $query_admin_info)) {
                  $message = "Registration successful!";
                  header("location: ../login.php");
                  exit();
              } else {
                  $message = "Error: " . mysqli_error($db);
              }
          } else {
              $message = "Error: " . mysqli_error($db);
          }
      }
  }
  else {
                    $message = "Failed to upload image. Please try again.";
                }
            } else {
                $message = "Invalid image type. Please upload a JPG, JPEG, PNG, or GIF image.";
            }
        } else {
            $message = "Image size too large. Please upload an image smaller than 5MB.";
        }
    } else {
        $message = "Error uploading image. Please try again.";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Registration</title>
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

    </style>

    <script>
        function previewImage() {
    var file = document.getElementById("file-input").files[0];
    var reader = new FileReader();

    reader.onload = function(e) {
        var img = document.getElementById("image-preview");
        img.src = e.target.result;
        img.style.display = "block"; // Show the image preview
    };

    if (file) {
        reader.readAsDataURL(file);
    }
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
        </ul>
    </nav>
</header>

<section>
    <div class="box2">
        <strong><h1 style="font-family:cursive ;font-size: 20px;color:black;">REGISTRATION FORM</h1><strong><br>

        <form name="Login" action="" method="post" enctype="multipart/form-data">
            <div class="login">

                  <input type="text" name="first" placeholder="Firstname" required=""><br>
                  <input type="text" name="last" placeholder="Lastname" required=""><br>
                  <input type="text" name="contact" placeholder="Contact" required=""><br>
                  <input type="text" name="username" placeholder="Username" required=""><br>
                  <input type="password" name="password" placeholder="Password" required=""><br>
                  <input type="text" name="email" placeholder="Email" required=""><br>
                  <br>
                   <input type="file" name="picture" accept="image/*" required><br><br>
                  
<br><br>

                <button type="submit" name="submit">Register</button>
            </div>
        </form>
    </div>
</section>

<!-- The Modal -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p id="modal-message"></p>
    </div>
</div>

<script>
// JavaScript to open the modal with a message
window.onload = function() {
    var message = "<?php echo $message; ?>"; // PHP message
    if (message != '') {
        // Show the modal and display the message
        document.getElementById('modal-message').innerText = message;
        document.getElementById('myModal').style.display = "block";
    }

    // Close the modal when the user clicks the "X"
    var span = document.getElementsByClassName("close")[0];
    span.onclick = function() {
        document.getElementById('myModal').style.display = "none";
    }

    // Close the modal if the user clicks anywhere outside of the modal
    window.onclick = function(event) {
        if (event.target == document.getElementById('myModal')) {
            document.getElementById('myModal').style.display = "none";
        }
    }
}
</script>

</body>
</html>
