<?php
// Include the connection file
include "connection.php";
session_start();

// Pagination settings
$booksPerPage = 10; // Increased to 10 to match the search section
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$startIndex = ($currentPage - 1) * $booksPerPage;

// Default query for gallery view (without search)
$booksQuery = "SELECT b.bookid, b.title, b.edition, b.status, b.quantity, b.pic, ba.author_name, bd.dept_name 
               FROM books b 
               LEFT JOIN book_authors ba ON b.bookid = ba.bookid 
               LEFT JOIN book_department bd ON b.bookid = bd.bookid 
               LIMIT ?, ?";
$stmt = $db->prepare($booksQuery);

if (!$stmt) {
    die("Error preparing statement: " . $db->error);
}

$stmt->bind_param("ii", $startIndex, $booksPerPage);
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    die("Error executing query: " . $db->error);
}

// Total book count for pagination (without search)
$totalBooksResult = $db->query("SELECT COUNT(*) AS total FROM books");
$totalBooks = $totalBooksResult->fetch_assoc()['total'];
$totalPages = ceil($totalBooks / $booksPerPage);

// Check if a book ID is passed for details
if (isset($_GET['id'])) {
    $bookId = $_GET['id'];
    $detailsQuery = "SELECT b.bookid, b.title, b.edition, b.status, b.quantity, b.pic, ba.author_name, bd.dept_name 
                     FROM books b 
                     LEFT JOIN book_authors ba ON b.bookid = ba.bookid 
                     LEFT JOIN book_department bd ON b.bookid = bd.bookid 
                     WHERE b.bookid = ?";
    $detailsStmt = $db->prepare($detailsQuery);

    if (!$detailsStmt) {
        die("Error preparing details statement: " . $db->error);
    }

    $detailsStmt->bind_param("i", $bookId);
    $detailsStmt->execute();
    $bookDetails = $detailsStmt->get_result()->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <title>Library Book Gallery</title>
    <style>
        body {
            min-height: 100%;
            display: flex;
            flex-direction: column;
            margin: 0;
            font-family: cursive;
        }

        /* Header styles */
        header {
            background-color: skyblue;
            width: 100%;
        }
        .logo img {
            height: 100px;
            margin-left: 40px;
        }

        .gallery-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
        }

        .book-box {
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: white;
            text-align: center;
            overflow: hidden;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .book-box img {
            width: 100%;
            height: 420px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .book-box h3 {
            margin: 10px 0;
            font-size: 16px;
        }

        .book-box:hover img {
            transform: scale(1.1);
        }

        .pagination {
            text-align: center;
            margin: 20px 0;
        }

        .pagination a {
            text-decoration: none;
            padding: 10px 15px;
            margin: 0 5px;
            background-color: skyblue;
            color: white;
            border-radius: 5px;
        }

        .pagination a.disabled {
            background-color: #ccc;
            pointer-events: none;
        }

        .book-details {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 10px;
        }

        .book-details table {
            width: 100%;
            border-collapse: collapse;
        }

        .book-details table th, .book-details table td {
            border: 1px solid #ddd;
            padding: 10px;
        }

        .book-details table th {
            background-color: #f2f2f2;
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

        .search {
            text-align: right;
            margin-top: 15px;
            margin-right: 20px;
            border: none;
        }

        button {
            margin-top: 6px;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #007 Pineapple;
        }

        .no-books {
            text-align: center;
            font-size: 18px;
            color: #555;
            margin-top: 20px;
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
    <header>
        <div class="logo"><img src="book2.png" alt="Library Logo"></div>
    </header>

    <div class="search">
        <form class="navbar-form" method="GET" action="" name="form1">
            <select name="filter_type">
                <option value="all" <?php echo (isset($_GET['filter_type']) && $_GET['filter_type'] === 'all') ? 'selected' : ''; ?>>All</option>
                <option value="title" <?php echo (isset($_GET['filter_type']) && $_GET['filter_type'] === 'title') ? 'selected' : ''; ?>>Title</option>
 lundi                <option value="author" <?php echo (isset($_GET['filter_type']) && $_GET['filter_type'] === 'author') ? 'selected' : ''; ?>>Author</option>
                <option value="department" <?php echo (isset($_GET['filter_type']) && $_GET['filter_type'] === 'department') ? 'selected' : ''; ?>>Department</option>
            </select>
            <input 
                class="form-control" 
                type="text" 
                name="search" 
                placeholder="Search books..." 
                value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>"
                style="height: 30px; border: 1px solid #ccc; border-radius: 4px; padding: 5px;">
            <button 
                style="width: 100px; height: 30px; background-color: skyblue;" 
                type="submit" 
                name="submit3" 
                class="btn btn-default">Search</button>
        </form>
    </div>

    <div class="search">
        <form method="post" name="form1">
            <input class="form-control" type="text" name="bookname" placeholder="Enter Book Name" style="height: 30px; border: 1px solid #ccc; border-radius: 4px; padding: 5px;" required>
            <button style="width:100px; height: 30px; background-color: skyblue;" type="submit" name="submit4" class="btn btn-default">Request</button>
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
        <?php if (isset($bookDetails)): ?>
            <!-- Book Details Section -->
            <div class="book-details">
                <h2>Book Details</h2>
                <table>
                    <tr>
                        <th>Book Id</th>
                        <td><?php echo htmlspecialchars($bookDetails['bookid']); ?></td>
                    </tr>
                    <tr>
                        <th>Title</th>
                        <td><?php echo htmlspecialchars($bookDetails['title']); ?></td>
                    </tr>
                    <tr>
                        <th>Edition</th>
                        <td><?php echo htmlspecialchars($bookDetails['edition']); ?></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td><?php echo htmlspecialchars($bookDetails['status']); ?></td>
                    </tr>
                    <tr>
                        <th>Quantity</th>
                        <td><?php echo htmlspecialchars($bookDetails['quantity']); ?></td>
                    </tr>
                    <tr>
                        <th>Author</th>
                        <td><?php echo htmlspecialchars($bookDetails['author_name'] ?? 'N/A'); ?></td>
                    </tr>
                    <tr>
                        <th>Department</th>
                        <td><?php echo htmlspecialchars($bookDetails['dept_name'] ?? 'N/A'); ?></td>
                    </tr>
                </table>
                <img src="images/<?php echo htmlspecialchars($bookDetails['pic']); ?>" alt="<?php echo htmlspecialchars($bookDetails['title']); ?>" style="width: 100%; margin-top: 20px;">
            </div>
        <?php else: ?>
            <?php
            // Search logic with advanced filtering
            if (isset($db) && isset($_GET['submit3']) && !empty($_GET['search'])) {
                $resultsPerPage = 10;
                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $search = $_GET['search'];
                $filter_type = isset($_GET['filter_type']) ? $_GET['filter_type'] : 'all';
                $offset = ($page - 1) * $resultsPerPage;

                $baseQuery = "SELECT b.bookid, b.title, b.edition, b.status, b.quantity, b.pic, ba.author_name, bd.dept_name 
                              FROM books b 
                              LEFT JOIN book_authors ba ON b.bookid = ba.bookid 
                              LEFT JOIN book_department bd ON b.bookid = bd.bookid";

                if ($filter_type === 'title') {
                    $searchQuery = $baseQuery . " WHERE b.title LIKE ? LIMIT ? OFFSET ?";
                    $stmt = $db->prepare($searchQuery);
                    $searchTerm = "%" . $search . "%";
                    $stmt->bind_param("sii", $searchTerm, $resultsPerPage, $offset);
                } elseif ($filter_type === 'author') {
                    $searchQuery = $baseQuery . " WHERE ba.author_name LIKE ? LIMIT ? OFFSET ?";
                    $stmt = $db->prepare($searchQuery);
                    $searchTerm = "%" . $search . "%";
                    $stmt->bind_param("sii", $searchTerm, $resultsPerPage, $offset);
                } elseif ($filter_type === 'department') {
                    $searchQuery = $baseQuery . " WHERE bd.dept_name LIKE ? LIMIT ? OFFSET ?";
                    $stmt = $db->prepare($searchQuery);
                    $searchTerm = "%" . $search . "%";
                    $stmt->bind_param("sii", $searchTerm, $resultsPerPage, $offset);
                } else {
                    // Default to 'all'
                    $searchQuery = $baseQuery . " WHERE b.title LIKE ? OR ba.author_name LIKE ? OR bd.dept_name LIKE ? LIMIT ? OFFSET ?";
                    $stmt = $db->prepare($searchQuery);
                    $searchTerm = "%" . $search . "%";
                    $stmt->bind_param("sssii", $searchTerm, $searchTerm, $searchTerm, $resultsPerPage, $offset);
                }

                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    echo '<div class="gallery-container">';
                    while ($book = $result->fetch_assoc()) {
                        $imagePath = 'images/' . htmlspecialchars($book['pic']);
                        ?>
                        <div class="book-box">
                            <a href="gallery.php?id=<?php echo $book['bookid']; ?>">
                                <img src="<?php echo $imagePath; ?>" alt="<?php echo htmlspecialchars($book['title']); ?>">
                            </a>
                            <h3><?php echo htmlspecialchars($book['title']); ?></h3>
                        </div>
                        <?php
                    }
                    echo '</div>';

                    // Query to get the total number of books matching the search term
                    $totalQuery = "SELECT COUNT(DISTINCT b.bookid) AS total 
                                   FROM books b 
                                   LEFT JOIN book_authors ba ON b.bookid = ba.bookid 
                                   LEFT JOIN book_department bd ON b.bookid = bd.bookid 
                                   WHERE b.title LIKE ? OR ba.author_name LIKE ? OR bd.dept_name LIKE ?";
                    if ($filter_type === 'title') {
                        $totalQuery = "SELECT COUNT(*) AS total FROM books WHERE title LIKE ?";
                        $totalStmt = $db->prepare($totalQuery);
                        $totalStmt->bind_param("s", $searchTerm);
                    } elseif ($filter_type === 'author') {
                        $totalQuery = "SELECT COUNT(DISTINCT b.bookid) AS total 
                                       FROM books b 
                                       LEFT JOIN book_authors ba ON b.bookid = ba.bookid 
                                       WHERE ba.author_name LIKE ?";
                        $totalStmt = $db->prepare($totalQuery);
                        $totalStmt->bind_param("s", $searchTerm);
                    } elseif ($filter_type === 'department') {
                        $totalQuery = "SELECT COUNT(DISTINCT b.bookid) AS total 
                                       FROM books b 
                                       LEFT JOIN book_department bd ON b.bookid = bd.bookid 
                                       WHERE bd.dept_name LIKE ?";
                        $totalStmt = $db->prepare($totalQuery);
                        $totalStmt->bind_param("s", $searchTerm);
                    } else {
                        $totalStmt = $db->prepare($totalQuery);
                        $totalStmt->bind_param("sss", $searchTerm, $searchTerm, $searchTerm);
                    }

                    $totalStmt->execute();
                    $totalResult = $totalStmt->get_result();
                    $totalRow = $totalResult->fetch_assoc();
                    $totalBooks = $totalRow['total'];
                    $totalPages = ceil($totalBooks / $resultsPerPage);

                    if ($totalPages > 1) {
                        echo "<div class='pagination'>";
                        if ($page > 1) {
                            echo "<a href='?page=" . ($page - 1) . "&search=" . urlencode($search) . "&filter_type=" . urlencode($filter_type) . "&submit3=Search'>Previous</a>";
                        }
                        for ($i = 1; $i <= $totalPages; $i++) {
                            $activeClass = $i == $page ? 'disabled' : '';
                            echo "<a href='?page=$i&search=" . urlencode($search) . "&filter_type=" . urlencode($filter_type) . "&submit3=Search' class='$activeClass'>$i</a>";
                        }
                        if ($page < $totalPages) {
                            echo "<a href='?page=" . ($page + 1) . "&search=" . urlencode($search) . "&filter_type=" . urlencode($filter_type) . "&submit3=Search'>Next</a>";
                        }
                        echo "</div>";
                    }
                } else {
                    echo "<p class='no-books'>No books found matching your search term.</p>";
                }
            } else {
                // Default gallery view (already queried at the top)
                ?>
                <div class="gallery-container">
                    <?php while ($book = $result->fetch_assoc()): ?>
                        <div class="book-box">
                            <a href="gallery.php?id=<?php echo $book['bookid']; ?>">
                                <?php
                                $imagePath = 'images/' . htmlspecialchars($book['pic']);
                                ?>
                                <img src="<?php echo $imagePath; ?>" alt="<?php echo htmlspecialchars($book['title']); ?>">
                            </a>
                            <h3><?php echo htmlspecialchars($book['title']); ?></h3>
                        </div>
                    <?php endwhile; ?>
                </div>

                <!-- Pagination for default view -->
                <div class="pagination">
                    <a href="gallery.php?page=<?php echo $currentPage - 1; ?>" class="<?php echo $currentPage == 1 ? 'disabled' : ''; ?>">Previous</a>
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <a href="gallery.php?page=<?php echo $i; ?>" class="<?php echo $i == $currentPage ? 'disabled' : ''; ?>"><?php echo $i; ?></a>
                    <?php endfor; ?>
                    <a href="gallery.php?page=<?php echo $currentPage + 1; ?>" class="<?php echo $currentPage == $totalPages ? 'disabled' : ''; ?>">Next</a>
                </div>
            <?php } ?>
        <?php endif; ?>
    </div>

    <?php
    // Book request logic with prepared statement
    if (isset($_POST['submit4'])) {
        if (isset($_SESSION['login_user'])) {
            $bookname = $_POST['bookname'];
            
            // Query to get bookid from bookname
            $bookIdQuery = "SELECT bookid FROM books WHERE title = ?";
            $bookIdStmt = $db->prepare($bookIdQuery);
            
            if (!$bookIdStmt) {
                die("Error preparing book ID statement: " . $db->error);
            }
            
            $bookIdStmt->bind_param("s", $bookname);
            $bookIdStmt->execute();
            $bookIdResult = $bookIdStmt->get_result();
            
            if ($bookIdResult->num_rows > 0) {
                $bookid = $bookIdResult->fetch_assoc()['bookid'];
                
                // Insert request into issue_book table
                $query = "INSERT INTO issue_book (username, bookid, approve, issue, retrn) VALUES (?, ?, '', '', '')";
                $stmt = $db->prepare($query);

                if (!$stmt) {
                    die("Error preparing statement: " . $db->error);
                }

                $stmt->bind_param("ss", $_SESSION['login_user'], $bookid);
                if ($stmt->execute()) {
                    echo "<script>alert('Book request submitted successfully!'); window.location='request.php';</script>";
                } else {
                    echo "<script>alert('Error submitting request: " . $db->error . "');</script>";
                }
                $stmt->close();
            } else {
                echo "<script>alert('Book not found! Please enter a valid book name.');</script>";
            }
            $bookIdStmt->close();
        } else {
            echo "<script>alert('You must login to request a book');</script>";
        }
    }
    ?>
</body>
</html>