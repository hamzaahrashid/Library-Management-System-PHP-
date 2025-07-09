<?php
include "connection.php"; // Ensure this file is correctly connecting to the database
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
    <title>Book Request</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        table {
            width: calc(90% - 90px);
            margin: 20px auto;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
            padding: 0 20px;
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
        .table-bordered th, .table-bordered td {
            border: 1px solid #ddd;
        }
        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }
        .search {
            margin-top: 10px;
            text-align: right;
            margin-right: 20px;
        }
        .welcome {
            flex-grow: 1;
            text-align: center;
            font-family: cursive;
            color: black;
        }
        .profile_img {
            border-radius: 20%;
            object-fit: cover;
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
            width: 70px;
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
            display: none;
        }
        #sidebar a:hover {
            background-color: skyblue;
            color: white;
        }
        #sidebar:hover {
            width: 250px;
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
            width: 40px;
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
        .search-button {
            background-color: #87CEEB;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        .search-button:hover {
            background-color: #7EC8E3;
        }
        #demo {
            position: absolute;
            left: 68%;
            transform: translate(-50%, -50%);
            font-size: 30px;
            color: skyblue;
            margin-bottom: -450px;
            margin-top: 10px;
            border: skyblue;
            padding: 10px;
            border-radius: 8px;
            background-color: #ffffff;
            box-shadow: 0px 4px 8px rgba(30, 144, 255, 0.5);
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

    <?php
    if (isset($_SESSION['login_user'])) {
        $b = mysqli_query($db, "SELECT * FROM issue_book WHERE username='$_SESSION[login_user]' AND approve='approve' ORDER BY retrn ASC LIMIT 0,1;");
        $bid = mysqli_fetch_assoc($b);
        $rest = null;
        if ($bid) {
            $t = mysqli_query($db, "SELECT * FROM timer WHERE name='$_SESSION[login_user]' AND bid='$bid[bookid]';");
            $rest = mysqli_fetch_assoc($t);
        }
    }
    ?>

    <header>
        <div class="logo"><img src="book2.png" alt="Library Logo"></div>
        <nav>
            <ul>
                <li><a style="font-family:cursive;" href="index.php">HOME</a></li>
                <li><a style="font-family:cursive;" href="feedback.php">FEEDBACK</a></li>
                <?php if (isset($_SESSION['login_user'])) { ?>
                    <li><a style="font-family: cursive;" href="logout.php">LOGOUT</a></li>
                    <li><a style="font-family: cursive;" href="profile.php">PROFILE</a></li>
                <?php } else { ?>
                    <li><a style="font-family: cursive;" href="../login.php">LOGIN</a></li>
                    <li><a style="font-family: cursive;" href="registration.php">SIGNUP</a></li>
                <?php } ?>
            </ul>
        </nav>
        <p id="demo"></p>
        <?php if (isset($_SESSION['login_user'])) { ?>
            <div class="welcome-messages" style="text-align: center;font-family: cursive;padding: 60px;font-size: 20px;">
                <?php
                echo "<a href='profile.php'><img class='img-circle profile_img' height=50 width=50 src='images/" . $_SESSION['pic'] . "'></a>";
                echo "  " . $_SESSION['login_user'];
                ?>
            </div>
        <?php } ?>
    </header>

    <script>
        <?php if ($rest && isset($rest['tm'])) { ?>
            var countDownDate = new Date("<?php echo $rest['tm']; ?>").getTime();
        <?php } else { ?>
            var countDownDate = null;
        <?php } ?>
        if (countDownDate) {
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

    <div class="search">
        <!-- Search Form -->
        <form class="navbar-form" method="post" name="search_form">
            <input class="form-control" type="text" name="search" placeholder="Search books..."><br>
            <button style="width:100px; height:35px; background-color:#87CEEB;color: white;border: none;border-radius: 5px;font-size: 14px;" class="search-button" type="submit" name="submit_search">Search</button>
        </form><br>
        <!-- Return Book Form -->
        <form method="post" name="return_form">
            <input class="form-control" type="text" name="return_book_name" placeholder="Enter Book Name to Return" required><br>
            <button style="width:100px; height:35px; background-color:#87CEEB;color: white;border: none;border-radius: 5px;font-size: 14px;" class="search-button" type="submit" name="return_book_btn">Return</button>
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
            <a href="books.php"><i class="fas fa-book"></i><span> Books </span></a>
            <a href="aboutus.php"><i class="fas fa-info-circle"></i><span> About Us</span></a>
            <a href="request.php"><i class="fas fa-paper-plane"></i><span> Request Books</span></a>
            <a href="expired.php"><i class="fas fa-clock"></i><span> Expired Books</span></a>
            <a href="fine.php"><i class="fas fa-dollar-sign"></i><span>Fine</span></a>
            <a href="gallery.php"><i class="fas fa-images"></i><span>Books Gallery</span></a>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i><span> Logout</span></a>
        <?php } else { ?>
            <a href="../login.php"><i class="fas fa-sign-in-alt"></i><span> Login</span></a>
            <a href="registration.php"><i class="fas fa-user-plus"></i><span> Sign Up</span></a>
        <?php } ?>
    </div>

    <div id="main-content">
        <?php
        if (isset($_SESSION['login_user'])) {
            $q = mysqli_query($db, "SELECT i.issue_id, b.bookid, b.title, i.approve, i.issue, i.retrn 
                                    FROM issue_book i, books b 
                                    WHERE i.bookid = b.bookid AND i.username = '$_SESSION[login_user]'");

            if (mysqli_num_rows($q) == 0) {
                echo "<p class='no-req'>There's no pending request.</p>";
            } else {
                echo "<table class='table table-bordered table-hover'>";
                echo "<tr>";
                echo "<th>Issue-ID</th>";
                echo "<th>Book ID</th>";
                echo "<th>Book Name</th>";
                echo "<th>Approve Status</th>";
                echo "<th>Issue Date</th>";
                echo "<th>Return Date</th>";
                echo "</tr>";

                while ($row = mysqli_fetch_assoc($q)) {
                    echo "<tr>";
                    echo "<td>" . $row['issue_id'] . "</td>";
                    echo "<td>" . $row['bookid'] . "</td>";
                    echo "<td>" . $row['title'] . "</td>";
                    echo "<td>" . $row['approve'] . "</td>";
                    echo "<td>" . $row['issue'] . "</td>";
                    echo "<td>" . $row['retrn'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
        }

      // Handle Book Return
if (isset($_POST['return_book_btn']) && isset($_SESSION['login_user'])) {
    $book_name = mysqli_real_escape_string($db, $_POST['return_book_name']);
    
    // Fetch bookid from books table
    $book_query = mysqli_query($db, "SELECT bookid FROM books WHERE title = '$book_name'");
    if (mysqli_num_rows($book_query) > 0) {
        $book_row = mysqli_fetch_assoc($book_query);
        $bookid = $book_row['bookid'];

        // Check if the book is issued to the user and not already returned
        $check_query = mysqli_query($db, "SELECT * FROM issue_book WHERE username = '$_SESSION[login_user]' AND bookid = '$bookid' AND approve != '<p style=\"color:white;background-color:green\">RETURNED</p>'");
        if (mysqli_num_rows($check_query) > 0) {
            // Get current date for retrn column (format: YYYY-MM-DD)
            $return_date = date('Y-m-d');
            
            // Update issue_book to mark as returned and set return date
            $var1 = '<p style="color:white;background-color:green">RETURNED</p>';
            $query = "UPDATE issue_book SET approve = ?, retrn = ? WHERE username = ? AND bookid = ?";
            $stmt = mysqli_prepare($db, $query);
            mysqli_stmt_bind_param($stmt, "ssss", $var1, $return_date, $_SESSION['login_user'], $bookid);
            if (mysqli_stmt_execute($stmt)) {
                echo "<script>alert('Book returned successfully!');</script>";
            } else {
                echo "<script>alert('Error returning book: " . mysqli_error($db) . "');</script>";
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "<script>alert('Book not issued to you or already returned!');</script>";
        }
    } else {
        echo "<script>alert('Book not found!');</script>";
    }
}
        ?>
    </div>
</body>
</html>