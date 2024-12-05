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
    3 => ["title" => "Daughter of No Worlds", "author" => "Carissa Broadbent", "description" => "A young woman from a conquered land must navigate a deadly empire while fighting for freedom for herself and her people.", "image" => "images/book3.jpeg"],
    4 => ["title" => "The Mercy of Gods", "author" => "Nathaniel Wilson", "description" => "A mythological fantasy that explores what happens when gods and mortals collide, revealing the price of divine power.", "image" => "images/book4.jpeg"],
    5 => ["title" => "The Stardust Grail", "author" => "Emily Clarke", "description" => "A cosmic adventure through time and space in search of an ancient artifact with the power to change the universe.", "image" => "images/book5.jpeg"],
    6 => ["title" => "The Bright Sword", "author" => "J.A. Andrews", "description" => "A story of a reluctant hero wielding an enchanted sword, as he battles his own fears and an ancient evil threatening the kingdom.", "image" => "images/book6.jpeg"],
    7 => ["title" => "Red Sonja: Consumed", "author" => "Margaret Carter", "description" => "A retelling of the famous warrior’s tale as she is caught in a world of magic, revenge, and fierce battles.", "image" => "images/book7.jpeg"],
    8 => ["title" => "Red Rabbit", "author" => "Tom Clancy", "description" => "An espionage thriller involving spies, assassins, and unexpected alliances amidst the backdrop of the Cold War.", "image" => "images/book8.jpeg"],
    9 => ["title" => "The Great When", "author" => "Jennifer Keene", "description" => "A historical drama that delves into the lives of families surviving turbulent times, with themes of hope and perseverance.", "image" => "images/book9.jpeg"],
    10 => ["title" => "Conan: City of the Dead", "author" => "Robert Jordan", "description" => "Conan must navigate a mysterious and dangerous city full of cults, ancient secrets, and creatures of the underworld.", "image" => "images/book10.jpeg"],
    11 => ["title" => "Extremophile", "author" => "Alexandra North", "description" => "A sci-fi thriller that explores the limits of human survival as scientists are pushed beyond their extremes in an arctic research station.", "image" => "images/book11.jpeg"],
    12 => ["title" => "No One Is Safe!", "author" => "Traci Chee", "description" => "A young adult fantasy novel focusing on grief, courage, and the effects of war within a world filled with fantastical creatures.", "image" => "images/book12.jpeg"]// Add more book details here as needed
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
