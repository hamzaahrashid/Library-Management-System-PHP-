<?php
include "connection.php";
session_start();
if (!isset($_SESSION['login_user'])) {
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BOOKS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            left: 200px;
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
        #demo {
            position: absolute;
            left: 69%;
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
        .search select {
            padding: 5px;
            margin-right: 10px;
            border: 1px solid skyblue;
            border-radius: 4px;
            font-family: cursive;
            
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
                <?php
                if (isset($_SESSION['login_user'])) { ?>
                    <li><a style="font-family: cursive;" href="logout.php">LOGOUT</a></li>
                    <li><a style="font-family: cursive;" href="profile.php">PROFILE</a></li>
                <?php } else { ?>
                    <li><a style="font-family: cursive;" href="../login.php">LOGIN</a></li>
                    <li><a style="font-family: cursive;" href="registration.php">SIGNUP</a></li>
                <?php } ?>
            </ul>
        </nav>
        <?php if (isset($_SESSION['login_user'])) { ?>
            <p id="demo" aria-live="polite"></p>
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
                    document.getElementById("demo").style.color = "skyblue";
                } else {
                    clearInterval(x);
                    document.getElementById("demo").innerHTML = "EXPIRED";
                    document.getElementById("demo").style.color = "red";
                }
            }, 1000);
        } else {
            document.getElementById("demo").innerHTML = "No timer data";
            document.getElementById("demo").style.color = "skyblue";
        }
    </script>

    <br><br>
    <h2 style="font-family:cursive;font-size: 25px;margin-left:150px;"><strong>LIST OF BOOKS</strong></h2>
    <div class="search">
        <form class="navbar-form" method="post" name="form1">
            <select name="filter_type">
                <option value="all">All</option>
                <option value="title">Title</option>
                <option value="author">Author</option>
                <option value="department">Department</option>
            </select>
            <input class="form-control" type="text" name="search" placeholder="Search books...">
            <button style="width:100px; height: 30px;background-color: skyblue;" type="submit" name="submit" class="btn btn-default">Search</button>
        </form>
    </div>
    <br>
    <div class="search">
        <form method="post" name="request_form">
            <input class="form-control" type="text" name="bookname" placeholder="Enter Book Name" required>
            <button style="width:100px; height: 30px; background-color: skyblue;" type="submit" name="submit1" class="btn btn-default">Request</button>
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
            <a href="aboutus.php"><i class="fas fa-info-circle"></i><span> About Us</span></a>
            <a href="request.php"><i class="fas fa-paper-plane"></i><span> Request Books</span></a>
            <a href="expired.php"><i class="fas fa-clock"></i><span> Expired Books</span></a>
            <a href="fine.php"><i class="fas fa-dollar-sign"></i><span> Fine</span></a>
            <a href="gallery.php"><i class="fas fa-images"></i><span>Books Gallery</span></a>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i><span> Logout</span></a>
        <?php } else { ?>
            <a href="../login.php"><i class="fas fa-sign-in-alt"></i><span> Login</span></a>
            <a href="registration.php"><i class="fas fa-user-plus"></i><span> Sign Up</span></a>
        <?php } ?>
    </div>

    <div id="main-content">
        <?php
        if (isset($_POST['submit']) && !empty($_POST['search'])) {
            $search = '%' . mysqli_real_escape_string($db, $_POST['search']) . '%';
            $filter_type = isset($_POST['filter_type']) ? $_POST['filter_type'] : 'all';

            $base_query = "SELECT b.bookid, b.title, b.edition, b.status, ba.author_name, bd.dept_name 
                           FROM books b 
                           LEFT JOIN book_authors ba ON b.bookid = ba.bookid 
                           LEFT JOIN book_department bd ON b.bookid = bd.bookid";
            
            if ($filter_type === 'title') {
                $query = $base_query . " WHERE b.title LIKE ?";
                $stmt = mysqli_prepare($db, $query);
                mysqli_stmt_bind_param($stmt, "s", $search);
            } elseif ($filter_type === 'author') {
                $query = $base_query . " WHERE ba.author_name LIKE ?";
                $stmt = mysqli_prepare($db, $query);
                mysqli_stmt_bind_param($stmt, "s", $search);
            } elseif ($filter_type === 'department') {
                $query = $base_query . " WHERE bd.dept_name LIKE ?";
                $stmt = mysqli_prepare($db, $query);
                mysqli_stmt_bind_param($stmt, "s", $search);
            } else {
                $query = $base_query . " WHERE b.title LIKE ? OR ba.author_name LIKE ? OR bd.dept_name LIKE ?";
                $stmt = mysqli_prepare($db, $query);
                mysqli_stmt_bind_param($stmt, "sss", $search, $search, $search);
            }

            mysqli_stmt_execute($stmt);
            $q = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($q) == 0) {
                echo "Sorry! No books found. Try searching for a different term.";
            } else {
                echo "<table class='table table-bordered table-hover'>";
                echo "<tr>";
                echo "<th>BookId</th>";
                echo "<th>Book-Name</th>";
                echo "<th>Edition</th>";
                echo "<th>Status</th>";
                echo "<th>Author Name</th>";
                echo "<th>Department Name</th>";
                echo "</tr>";

                while ($row = mysqli_fetch_assoc($q)) {
                    echo "<tr>";
                    echo "<td>" . $row['bookid'] . "</td>";
                    echo "<td>" . $row['title'] . "</td>";
                    echo "<td>" . $row['edition'] . "</td>";
                    echo "<td>" . $row['status'] . "</td>";
                    echo "<td>" . ($row['author_name'] ?? 'N/A') . "</td>";
                    echo "<td>" . ($row['dept_name'] ?? 'N/A') . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
            mysqli_stmt_close($stmt);
        } else {
            $res = mysqli_query($db, "
                SELECT 
                    b.bookid, 
                    b.title, 
                    b.edition, 
                    b.status, 
                    ba.author_name, 
                    bd.dept_name
                FROM 
                    books b
                LEFT JOIN 
                    book_authors ba ON b.bookid = ba.bookid
                LEFT JOIN 
                    book_department bd ON b.bookid = bd.bookid
            ");

            echo "<table class='table table-bordered table-hover'>";
            echo "<tr>";
            echo "<th>BookId</th>";
            echo "<th>Book-Name</th>";
            echo "<th>Edition</th>";
            echo "<th>Status</th>";
            echo "<th>Author Name</th>";
            echo "<th>Department Name</th>";
            echo "</tr>";

            while ($row = mysqli_fetch_assoc($res)) {
                echo "<tr>";
                echo "<td>" . $row['bookid'] . "</td>";
                echo "<td>" . $row['title'] . "</td>";
                echo "<td>" . $row['edition'] . "</td>";
                echo "<td>" . $row['status'] . "</td>";
                echo "<td>" . ($row['author_name'] ?? 'N/A') . "</td>";
                echo "<td>" . ($row['dept_name'] ?? 'N/A') . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }

        if (isset($_POST['submit1'])) {
            if (isset($_SESSION['login_user'])) {
                $bookname = mysqli_real_escape_string($db, $_POST['bookname']);
                
                // Query to find the bookid based on the book name
                $query = "SELECT bookid FROM books WHERE title = ?";
                $stmt = mysqli_prepare($db, $query);
                mysqli_stmt_bind_param($stmt, "s", $bookname);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                
                $num_rows = mysqli_num_rows($result);
                
                if ($num_rows == 0) {
                    echo "<script>alert('No book found with the name: " . htmlspecialchars($bookname) . "');</script>";
                } elseif ($num_rows > 1) {
                    echo "<script>alert('Multiple books found with the name: " . htmlspecialchars($bookname) . ". Please be more specific (e.g., include edition or author).');</script>";
                } else {
                    // Exactly one book found, proceed with checking existing requests
                    $row = mysqli_fetch_assoc($result);
                    $bookid = $row['bookid'];
                    
                    // Check for existing active requests for this book by this user
                    $check_query = "SELECT * FROM issue_book WHERE username = ? AND bookid = ? AND (retrn = '' OR approve = '' OR approve = 'pending')";
                    $check_stmt = mysqli_prepare($db, $check_query);
                    mysqli_stmt_bind_param($check_stmt, "ss", $_SESSION['login_user'], $bookid);
                    mysqli_stmt_execute($check_stmt);
                    $check_result = mysqli_stmt_get_result($check_stmt);
                    
                    if (mysqli_num_rows($check_result) > 0) {
                        // User has an active request for this book
                        echo "<script>alert('You have already requested this book: " . htmlspecialchars($bookname) . ". Please wait for the current request to be processed or returned before requesting again.');</script>";
                    } else {
                        // No active request, proceed with inserting the new request
                        $insert_query = "INSERT INTO issue_book (username, bookid, approve, issue, retrn) VALUES (?, ?, '', '', '')";
                        $insert_stmt = mysqli_prepare($db, $insert_query);
                        mysqli_stmt_bind_param($insert_stmt, "ss", $_SESSION['login_user'], $bookid);
                        if (mysqli_stmt_execute($insert_stmt)) {
                            echo "<script>alert('Book request submitted successfully!'); window.location='request.php';</script>";
                        } else {
                            echo "<script>alert('Error submitting request: " . mysqli_error($db) . "');</script>";
                        }
                        mysqli_stmt_close($insert_stmt);
                    }
                    mysqli_stmt_close($check_stmt);
                }
                mysqli_stmt_close($stmt);
            } else {
                echo "<script>alert('You must login to request a book');</script>";
            }
        }
        ?>
    </div>
</body>
</html>