<?php
session_start();  // Start the session

// Enable error reporting to catch potential issues
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database connection file
include 'db.php';

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    die("Access denied. Please log in first. <a href='login.php'>Login Here</a>");
}

$user_id = $_SESSION['user_id']; // Get the user ID from the session

// Handle Delete Request
if (isset($_GET['delete_book_name']) && isset($_GET['delete_created_at'])) {
    $delete_book_name = $conn->real_escape_string($_GET['delete_book_name']);
    $delete_created_at = $conn->real_escape_string($_GET['delete_created_at']);
    
    $delete_sql = "DELETE FROM Reviews WHERE user_id = '$user_id' AND book_name = '$delete_book_name' AND created_at = '$delete_created_at'";
    if ($conn->query($delete_sql) === TRUE) {
        header("Location: my_reviews.php");
        exit();
    } else {
        echo "Error deleting review: " . $conn->error;
    }
}

// Handle Update Request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_book_name']) && isset($_POST['update_created_at'])) {
    $update_book_name = $conn->real_escape_string($_POST['update_book_name']);
    $update_created_at = $conn->real_escape_string($_POST['update_created_at']);
    $book_name = $_POST['book_name'];
    $author = $_POST['author'];
    $publisher = $_POST['publisher'];
    $genre = $_POST['genre'];
    $book_length = $_POST['book_length'];
    $rating = $_POST['rating'];
    $review = $_POST['review'];

    $update_sql = "UPDATE Reviews SET book_name='$book_name', author='$author', publisher='$publisher', genre='$genre', book_length='$book_length', rating='$rating', review='$review' WHERE user_id='$user_id' AND book_name='$update_book_name' AND created_at='$update_created_at'";
    if ($conn->query($update_sql) === TRUE) {
        header("Location: my_reviews.php");
        exit();
    } else {
        echo "Error updating review: " . $conn->error;
    }
}

// Fetch All Reviews
$sql = "SELECT * FROM Reviews WHERE user_id = '$user_id' ORDER BY created_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Reviews - Book Club</title>
    <link rel="stylesheet" href="styles3.css">
</head>
<body>
    <header class="header">
        <div class="container">
            <h1 class="logo">Book Club</h1>
            <nav class="nav">
                <ul>
                    <li><a href="book_review.php">Submit a Review</a></li>
                    <li><a href="book_of_the_month.php">Trending Books</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <section class="reviews-section">
            <div class="container">
                <h2>My Book Reviews</h2>
                <?php if ($result && $result->num_rows > 0): ?>
                    <ul class="review-list">
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <li class="review-item">
                                <h3><?php echo htmlspecialchars($row['book_name'] ?? ''); ?></h3>
                                <p><strong>Author:</strong> <?php echo htmlspecialchars($row['author'] ?? ''); ?></p>
                                <p><strong>Publisher:</strong> <?php echo htmlspecialchars($row['publisher'] ?? ''); ?></p>
                                <p><strong>Genre:</strong> <?php echo htmlspecialchars($row['genre'] ?? ''); ?></p>
                                <p><strong>Length:</strong> <?php echo htmlspecialchars($row['book_length'] ?? ''); ?> pages</p>
                                <p><strong>Rating:</strong> <?php echo htmlspecialchars($row['rating'] ?? ''); ?>/5</p>
                                <p><strong>Review:</strong> <?php echo htmlspecialchars($row['review'] ?? ''); ?></p>
                                <p><em>Reviewed on: <?php echo htmlspecialchars($row['created_at'] ?? ''); ?></em></p>
                                
                                <!-- Delete and Edit buttons using composite keys (book_name and created_at) -->
                                <a href="my_reviews.php?delete_book_name=<?php echo urlencode($row['book_name']); ?>&delete_created_at=<?php echo urlencode($row['created_at']); ?>" class="cta-button delete-button">Delete</a>
                                <a href="my_reviews.php?edit_book_name=<?php echo urlencode($row['book_name']); ?>&edit_created_at=<?php echo urlencode($row['created_at']); ?>" class="cta-button edit-button">Edit</a>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php else: ?>
                    <p>You haven't submitted any reviews yet.</p>
                <?php endif; ?>

                <!-- Edit Form -->
                <?php if (isset($_GET['edit_book_name']) && isset($_GET['edit_created_at'])): 
                    $edit_book_name = $conn->real_escape_string($_GET['edit_book_name']);
                    $edit_created_at = $conn->real_escape_string($_GET['edit_created_at']);
                    $edit_sql = "SELECT * FROM Reviews WHERE user_id='$user_id' AND book_name='$edit_book_name' AND created_at='$edit_created_at'";
                    $edit_result = $conn->query($edit_sql);
                    $edit_row = $edit_result->fetch_assoc();
                    if ($edit_row):
                ?>
                <div class="edit-form">
                    <h2>Edit Review</h2>
                    <form action="my_reviews.php" method="POST">
                        <input type="hidden" name="update_book_name" value="<?php echo htmlspecialchars($edit_row['book_name'] ?? ''); ?>">
                        <input type="hidden" name="update_created_at" value="<?php echo htmlspecialchars($edit_row['created_at'] ?? ''); ?>">
                        <div class="form-group">
                            <label for="book_name">Book Name:</label>
                            <input type="text" id="book_name" name="book_name" value="<?php echo htmlspecialchars($edit_row['book_name'] ?? ''); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="author">Author:</label>
                            <input type="text" id="author" name="author" value="<?php echo htmlspecialchars($edit_row['author'] ?? ''); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="publisher">Publisher:</label>
                            <input type="text" id="publisher" name="publisher" value="<?php echo htmlspecialchars($edit_row['publisher'] ?? ''); ?>">
                        </div>
                        <div class="form-group">
                            <label for="genre">Genre:</label>
                            <input type="text" id="genre" name="genre" value="<?php echo htmlspecialchars($edit_row['genre'] ?? ''); ?>">
                        </div>
                        <div class="form-group">
                            <label for="book_length">Length (Pages):</label>
                            <input type="number" id="book_length" name="book_length" value="<?php echo htmlspecialchars($edit_row['book_length'] ?? ''); ?>">
                        </div>
                        <div class="form-group">
                            <label for="rating">Rating (1-5):</label>
                            <input type="number" id="rating" name="rating" min="1" max="5" value="<?php echo htmlspecialchars($edit_row['rating'] ?? ''); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="review">Review:</label>
                            <textarea id="review" name="review" rows="4" required><?php echo htmlspecialchars($edit_row['review'] ?? ''); ?></textarea>
                        </div>
                        <button type="submit" class="cta-button">Update Review</button>
                    </form>
                </div>
                <?php endif; endif; ?>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 Book Club. All Rights Reserved.</p>
        </div>
    </footer>
</body>
</html>
<?php $conn->close(); ?>
