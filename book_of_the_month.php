<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book of the Month - Book Club</title>
    <link rel="stylesheet" href="styles4.css">
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
        <section class="book-month-section">
            <div class="container">
                <h2>Book of the Month</h2>
                <div class="book-grid">
                    <?php
                    // Sample books data - ideally this should come from the database
                    $books = [
                        ["title" => "The Cautious Traveller's Guide to the Wastelands", "image" => "images/book1.jpeg", "details" => "book_details.php?id=1"],
                        ["title" => "Kindling", "image" => "images/book2.jpeg", "details" => "book_details.php?id=2"],
                        ["title" => "Daughter of No Worlds", "image" => "images/book3.jpeg", "details" => "book_details.php?id=3"],
                        ["title" => "The Mercy of Gods", "image" => "images/book4.jpeg", "details" => "book_details.php?id=4"],
                        ["title" => "The Stardust Grail", "image" => "images/book5.jpeg", "details" => "book_details.php?id=5"],
                        ["title" => "The Bright Sword", "image" => "images/book6.jpeg", "details" => "book_details.php?id=6"],
                        ["title" => "Red Sonja: Consumed", "image" => "images/book7.jpeg", "details" => "book_details.php?id=7"],
                        ["title" => "Red Rabbit", "image" => "images/book8.jpeg", "details" => "book_details.php?id=8"],
                        ["title" => "The Great When", "image" => "images/book9.jpeg", "details" => "book_details.php?id=9"],
                        ["title" => "Conan: City of the Dead", "image" => "images/book10.jpeg", "details" => "book_details.php?id=10"],
                        ["title" => "Extremophile", "image" => "images/book11.jpeg", "details" => "book_details.php?id=11"],
                        ["title" => "No One Is Safe!", "image" => "images/book12.jpeg", "details" => "book_details.php?id=12"]
                    ];

                    foreach ($books as $book) {
                        echo "<div class='book-item'>";
                        echo "<a href='" . htmlspecialchars($book['details']) . "'>";
                        echo "<img src='" . htmlspecialchars($book['image']) . "' alt='" . htmlspecialchars($book['title']) . "'>";
                        echo "<h3>" . htmlspecialchars($book['title']) . "</h3>";
                        echo "</a>";
                        echo "</div>";
                    }
                    ?>
                </div>
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
