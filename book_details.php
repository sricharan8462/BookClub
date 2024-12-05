<?php
session_start();
include 'db.php';

// Get book ID from URL
$book_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Example book details (replace this with a database query)
$book_details = [
    1 => ["title" => "The Cautious Traveller's Guide to the Wastelands", "author" => "Sarah Brooks", "description" => "A debut steampunk fantasy set on the Great Trans-Siberian Express, blending adventure with supernatural perils.", "image" => "images/book1.jpeg"],
    2 => ["title" => "No One Is Safe!", "author" => "Traci Chee", "description" => "Focuses on grief and the effects of war in a fantastical setting.", "image" => "images/book2.jpeg"],
    // Add more book details here as needed
];

// Fetch the book details based on the ID
$book = isset($book_details[$book_id]) ? $book_details[$book_id] : null;

if (!$book) {
    echo "Book not found. <a href='book_of_the_month.php'>Go back</a>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($book['title']); ?> - Book Details</title>
    <link rel="stylesheet" href="styles3.css">
</head>
<body>
    <header class="header">
        <div class="container">
            <h1 class="logo">Book Club</h1>
            <nav class="nav">
                <ul>
                    <li><a href="book_review.php">Submit a Review</a></li>
                    <li><a href="my_reviews.php">My Reviews</a></li>
                    <li><a href="book_of_the_month.php">Trending Books</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <section class="book-details-section">
            <div class="container">
                <h2><?php echo htmlspecialchars($book['title']); ?></h2>
                <img src="<?php echo htmlspecialchars($book['image']); ?>" alt="<?php echo htmlspecialchars($book['title']); ?>" class="book-cover">
                <p><strong>Author:</strong> <?php echo htmlspecialchars($book['author']); ?></p>
                <p><?php echo htmlspecialchars($book['description']); ?></p>
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
