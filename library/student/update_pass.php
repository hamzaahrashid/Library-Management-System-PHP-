<?php
include "connection.php";
session_start();
?>   

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>
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
        .wrap {
            width: 700px;
            height: 400px;
            margin: 100px auto;
            background-color: skyblue;
            opacity: .7;
            border-radius: 20px;
            position: relative;
        }
        .btn {
            display: block;
            margin: 20px auto; /* Center the button */
            padding: 10px 20px;
            font-size: 16px;
            background-color: white;
            border: none;
            color: skyblue;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .btn:hover {
            background-color: green;
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
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .checkmark {
            font-size: 25px;
            color: green;
            display: none;
            animation: checkmarkAnimation 0.5s ease-in-out forwards;
        }
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
    </style>
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

        // Function to show the modal with the result message
        function showModal(message, isSuccess) {
            var modal = document.getElementById('resultModal');
            var modalContent = document.getElementById('modalContent');
            modalContent.innerHTML = message; // Set the message in the modal
            modal.style.display = "block"; // Show the modal

            if (!isSuccess) {
                modalContent.style.color = "black"; // Change text color for error
            }
        }

        // Function to close the modal
        function closeModal() {
            document.getElementById('resultModal').style.display = "none";
        }
    </script>
</head>
<body>

<header>
    <div class="logo"><img src="book2.png" alt="Library Logo"></div>
</header>

<div class="wrap">
    <h1 style="text-align:center;font-size: 30px;font-family: cursive;margin-top: 30px;"><strong>Change Your Password</strong></h1>

    <form action="" method="post" style="text-align: center; margin-top: 60px;">
        <input type="text" name="username" class="form-control" placeholder="Username" required="" style="margin: 10px 0; padding: 10px;height: 40px; width: 90%; border-radius: 30px;">
        <input type="text" name="email" class="form-control" placeholder="Email" required="" style="margin: 10px 0; padding: 10px;height:40px ; width: 90%; border-radius: 30px;">
        <input type="text" name="password" class="form-control" placeholder="New Password" required="" style="margin: 10px 0; padding: 10px;height: 40px; width: 90%; border-radius: 30px;">
        
        <button type="submit" class="btn" id="submitBtn" name="submit" onclick="transformButton()">Submit</button>

        <!-- Loading Spinner -->
        <div id="spinner" class="loading-spinner" style="display: none;"></div>
        <!-- Green Checkmark -->
        <span id="checkmark" class="checkmark" style="display: none;">&#10003;</span>
    </form>

</div>

<!-- Modal for success/failure message -->
<div id="resultModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <p id="modalContent"></p>
    </div>
</div>

<?php
if(isset($_POST['submit'])) {
    // Sanitize user inputs to avoid SQL injection
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    // Run the SQL query to update the password
    $sql = mysqli_query($db, "UPDATE student SET password='$password' WHERE username='$username' AND email='$email'");

    // Check if any rows were affected by the update query
    if (mysqli_affected_rows($db) > 0) {
        // If the update is successful, trigger success modal
        echo "<script>showModal('Password updated successfully!', true);</script>";
    } else {
        // If no rows were affected, the update failed (mismatch or no such user)
        echo "<script>showModal('Error updating password. Please check your username and email.', false);</script>";
    }
}
?>

<footer></footer>
</body>
</html>
