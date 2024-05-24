<?php
require_once 'conn.php';
function createDB()
{

    // Initialize database connection
    $conn = new mysqli('localhost', 'root', '');
    $sql = "CREATE DATABASE IF NOT EXISTS bookquest;";
    if ($conn->query($sql) === TRUE) {
        echo "DATABASE CREATED<br>";
    }
    $conn->close();
}
// Function to create user table

function createAllTable()
{
    // Get the database connection
    $conn = createConn();

    // SQL query to create the user table
    $sql = "CREATE TABLE IF NOT EXISTS user (
        username VARCHAR(50) NOT NULL PRIMARY KEY,
        full_name VARCHAR(50) NOT NULL,
        password VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        is_admin BOOLEAN DEFAULT FALSE
    );";

    // Execute the SQL query to create the table
    if ($conn->query($sql) === TRUE) {
        echo "User table created successfully<br>";
    } else {
        echo "Error creating user table: " . $conn->error . "<br>";
    }

    // Check if the admin user already exists
    $checkAdminSql = "SELECT * FROM user WHERE username = 'admin'";
    $result = $conn->query($checkAdminSql);

    if ($result->num_rows == 0) {
        // Insert the admin user if it does not exist
        $pw = password_hash('admin123', PASSWORD_DEFAULT);
        $insertAdminSql = "INSERT INTO user (username, full_name, password, email, is_admin)
                        VALUES ('admin', 'Admin HoMa', '$pw', 'admin@example.com', TRUE);";
        if ($conn->query($insertAdminSql) === TRUE) {
            echo "Admin created successfully<br>";
        } else {
            echo "Error creating admin user: " . $conn->error . "<br>";
        }
    } else {
        echo "Admin user already exists<br>";
    }

    // SQL query to create the book table
    $sql = "CREATE TABLE IF NOT EXISTS book (
        isbn_no INT(10) PRIMARY KEY,
        book_name VARCHAR(50) NOT NULL,
        price INT(10) NOT NULL,
        author VARCHAR(50) NOT NULL,
        book_cover LONGBLOB
    );";

    // Execute the SQL query
    if ($conn->query($sql) === TRUE) {
        echo "Book table created successfully<br>";
    } else {
        echo "Error creating book table: " . $conn->error . "<br>";
    }
    //sql query to create requested book table
    $sql = "CREATE TABLE IF NOT EXISTS requested_book (
        book_name VARCHAR(50) NOT NULL,
        author VARCHAR(50) NOT NULL,
        username VARCHAR(50) NOT NULL
    );";
    if ($conn->query($sql) === TRUE) {
        echo "requested_book table created successfully<br>";
    } else {
        echo "Error creating requested_book table: " . $conn->error . "<br>";
    }



    $conn->close();
}

// Call the function to create the user table
createDB();
createAllTable();
?>
<!-- book -->