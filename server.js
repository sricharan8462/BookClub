const express = require('express');
const mysql = require('mysql2');
const bodyParser = require('body-parser');
const bcrypt = require('bcrypt');

const app = express();
const port = 3000;

// Create MySQL connection with XAMPP database
const db = mysql.createConnection({
    host: 'localhost',
    user: 'root',  // Default username for XAMPP MySQL
    password: '',  // Default password is empty for XAMPP MySQL
    database: 'book_review_db'
});

// Connect to the database
db.connect((err) => {
    if (err) {
        console.error('Error connecting to database:', err);
        return;
    }
    console.log('Connected to MySQL database');
});

// Middleware to parse request body
app.use(bodyParser.json());
app.use(express.json());
app.use(express.static('public')); // Serve static files from 'public' folder

// Signup Endpoint - Handles user registration
app.post('/signup', (req, res) => {
    const { username, password } = req.body;

    // Log the incoming request to verify data
    console.log("Signup request received:", req.body);

    if (!username || !password) {
        return res.status(400).json({ success: false, message: 'Username and password are required' });
    }

    // Hash the password before storing it in the database
    const saltRounds = 10;
    bcrypt.hash(password, saltRounds, (err, hashedPassword) => {
        if (err) {
            console.error('Error hashing password:', err);
            return res.status(500).json({ success: false, message: 'Error hashing password' });
        }

        // Insert new user into the Users table
        const query = `INSERT INTO Users (username, password) VALUES (?, ?)`;
        db.query(query, [username, hashedPassword], (err, result) => {
            if (err) {
                if (err.code === 'ER_DUP_ENTRY') {
                    return res.status(409).json({ success: false, message: 'Username already exists' });
                }
                console.error('Error inserting data:', err);
                return res.status(500).json({ success: false, message: 'Database error: ' + err.message });
            }
            console.log('User successfully registered:', result);
            res.json({ success: true, message: 'User registered successfully!' });
        });
    });
});

// Start the server
app.listen(port, () => {
    console.log(`Server running at http://localhost:${port}`);
});
