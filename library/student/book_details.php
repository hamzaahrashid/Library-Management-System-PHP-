<?php
// Include database connection
include('db_connection.php');

// Check if the book ID is passed via URL
if (isset($_GET['bookid'])) {
    $bookid = $_GET['bookid'];

    // Prepare the SQL query to fetch the book details based on the bookid
    $detailsQuery = "SELECT b.bookid, b.title, b.edition, b.status, b.quantity, b.pic, ba.author_name 
                     FROM books b 
                     JOIN book_authors ba ON b.bookid = ba.bookid 
                     WHERE b.bookid = ?";
    $stmt = $db->prepare($detailsQuery);

    if (!$stmt) {
        die("Error preparing statement: " . $db->error);
    }

    // Bind the bookid to the query
    $stmt->bind_param("i", $bookid);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the details of the book
        $book = $result->fetch_assoc();
?>
            <h2>Book Details</h2>
            <table>
                <tr>
                    <th>Title</th>
                    <td><?php echo htmlspecialchars($book['title']); ?></td>
                </tr>
                <tr>
                    <th>Edition</th>
                    <td><?php echo htmlspecialchars($book['edition']); ?></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td><?php echo htmlspecialchars($book['status']); ?></td>
                </tr>
                <tr>
                    <th>Quantity</th>
                    <td><?php echo htmlspecialchars($book['quantity']); ?></td>
                </tr>
                <tr>
                    <th>Author</th>
                    <td><?php echo htmlspecialchars($book['author_name']); ?></td>
                </tr>
            </table>
            <img src="images/<?php echo htmlspecialchars($book['pic']); ?>" alt="<?php echo htmlspecialchars($book['title']); ?>" style="width: 100%; margin-top: 20px;">
<?php
    } else {
        echo "<p>Book details not found.</p>";
    }
} else {
    echo "<p>No book ID specified.</p>";
}
?>
