<?php
$conn = new mysqli("localhost", "root", "", "library"); // Change if needed

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $book_name = $_POST['book_name'];

    // Example: Assume 'book_issue_info' table stores issued books
    $sql = "UPDATE book_issue_info SET return_date = CURDATE() WHERE book_name = ? AND return_date IS NULL";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $book_name);
    
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo "Book marked as returned successfully.";
        } else {
            echo "No issued book found with that name or already returned.";
        }
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
$conn->close();
?>
