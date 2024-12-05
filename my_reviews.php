<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    die("Access denied. Please log in first. <a href='login.html'>Login Here</a>");
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM Reviews WHERE user_id = '$user_id' ORDER BY created_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Reviews - Book Club</title>
    <link rel="stylesheet" href="styles.css">
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
                <?php if ($result->num_rows > 0): ?>
                    <ul class="review-list">
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <li class="review-item">
                                <h3><?php echo htmlspecialchars($row['book_name']); ?></h3>
                                <p><strong>Author:</strong> <?php echo htmlspecialchars($row['author']); ?></p>
                                <p><strong>Publisher:</strong> <?php echo htmlspecialchars($row['publisher']); ?></p>
                                <p><strong>Genre:</strong> <?php echo htmlspecialchars($row['genre']); ?></p>
                                <p><strong>Length:</strong> <?php echo htmlspecialchars($row['book_length']); ?> pages</p>
                                <p><strong>Rating:</strong> <?php echo htmlspecialchars($row['rating']); ?>/5</p>
                                <p><strong>Review:</strong> <?php echo htmlspecialchars($row['review']); ?></p>
                                <p><em>Reviewed on: <?php echo htmlspecialchars($row['created_at']); ?></em></p>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php else: ?>
                    <p>You haven't submitted any reviews yet.</p>
                <?php endif; ?>
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
$conn->close();
?>
