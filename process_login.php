<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch the user from the database
    $sql = "SELECT * FROM Users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify the password
        if (password_verify($password, $row['password'])) {
            // Set the session with user ID after successful login
            $_SESSION['user_id'] = $row['user_id'];
            
            // Redirect to the Book Review page
            header("Location: book_review.php");
            exit();
        } else {
            echo "Incorrect password. <a href='login.html'>Try Again</a>";
        }
    } else {
        echo "No user found with that username. <a href='signup.html'>Sign Up Here</a>";
    }

    $conn->close();
}
?>
