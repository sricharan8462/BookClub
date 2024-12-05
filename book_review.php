<?php
session_start();
include 'db.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    die("Access denied. Please log in first. <a href='login.html'>Login Here</a>");
}

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle the review form submission
    $book_name = $_POST['book_name'];
    $author = $_POST['author'];
    $publisher = $_POST['publisher'];
    $genre = $_POST['genre'];
    $book_length = $_POST['book_length'];
    $rating = $_POST['rating'];
    $review = $_POST['review'];

    // Insert the review into the Reviews table
    $sql = "INSERT INTO Reviews (user_id, book_name, author, publisher, genre, book_length, rating, review)
            VALUES ('$user_id', '$book_name', '$author', '$publisher', '$genre', '$book_length', '$rating', '$review')";

    if ($conn->query($sql) === TRUE) {
        // Review successfully inserted, display next action options
        echo "<p>Review submitted successfully!</p>";
        echo "<a href='book_review.php'>Submit Another Review</a> | <a href='my_reviews.php'>View My Reviews</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    // Display the review form if the request method is GET
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Book Review - Book Club</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <header class="header">
            <div class="container">
                <h1 class="logo">Book Club</h1>
                <nav class="nav">
                    <ul>
                        <li><a href="my_reviews.php">My Reviews</a></li>
                        <li><a href="book_of_the_month.php">Trending Books</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </nav>
            </div>
        </header>

        <main>
            <section class="review-section">
                <div class="container">
                    <h2>Submit a Book Review</h2>
                    <form action="book_review.php" method="POST">
                        <div class="form-group">
                            <label for="book_name">Book Name:</label>
                            <input type="text" id="book_name" name="book_name" required>
                        </div>
                        <div class="form-group">
                            <label for="author">Author:</label>
                            <input type="text" id="author" name="author" required>
                        </div>
                        <div class="form-group">
                            <label for="publisher">Publisher:</label>
                            <input type="text" id="publisher" name="publisher">
                        </div>
                        <div class="form-group">
                            <label for="genre">Genre:</label>
                            <input type="text" id="genre" name="genre">
                        </div>
                        <div class="form-group">
                            <label for="book_length">Length (Pages):</label>
                            <input type="number" id="book_length" name="book_length">
                        </div>
                        <div class="form-group">
                            <label for="rating">Rating (1-5):</label>
                            <input type="number" id="rating" name="rating" min="1" max="5" required>
                        </div>
                        <div class="form-group">
                            <label for="review">Review:</label>
                            <textarea id="review" name="review" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="cta-button">Submit Review</button>
                    </form>
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
    <?php
}
$conn->close();
?>
