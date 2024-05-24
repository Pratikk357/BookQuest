<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <style>
        /* CSS for navigation bar */
        .navbar {
            overflow: hidden;
            background-color: #333;
        }

        .navbar a {
            float: right;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        /* CSS for book listing */
        .book-list {
            margin-top: 20px;
            text-align: center;
        }

        .book {
            display: inline-block;
            width: 200px;
            margin: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .book img {
            width: 100px;
            height: 150px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <script src="https://cdn.tailwindcss.com"></script>
    <div class="navbar">
        <?php
        // Start session
        session_start();

        // Check if the user is logged in
        if (isset($_SESSION['username'])) {
            $navbar_text = "Logout";
            $navbar_link = "logout.php"; // Assuming logout logic is in logout.php
        } else {
            $navbar_text = "Login";
            $navbar_link = "login.php"; // Assuming login form is in login.php
        }
        echo '<a href="' . $navbar_link . '">' . $navbar_text . '</a>';
        echo '<a href="#cart">Cart</a>';
        ?>
        <a href="../index.php">Home</a>
    </div>

    <div class="book-list">
        <h2>Search Results</h2>
        <?php
        // Database connection
        require_once '../conn.php';
        $conn = createConn();

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Retrieve search query
        $search = isset($_GET['search']) ? $_GET['search'] : '';

        // Query to search for books
        $sql = "SELECT * FROM book WHERE isbn_no LIKE '%$search%' OR book_name LIKE '%$search%' OR author LIKE '%$search%'";
        $result = $conn->query($sql);

        // Display search results
        if ($result === FALSE) {
            echo "Error: " . $conn->error;
        } elseif ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="book">';
                echo '<img src="data:image/jpeg;base64,' . base64_encode($row['book_cover']) . '" alt="' . $row['book_name'] . '">';
                echo '<p><strong>ISBN:</strong> ' . $row['isbn_no'] . '</p>';
                echo '<p><strong>Title:</strong> ' . $row['book_name'] . '</p>';
                echo '<p><strong>Price:</strong> ' . $row['price'] . '</p>';
                echo '<p><strong>Author:</strong> ' . $row['author'] . '</p>';
                echo '<button class="bg-green-300 px-3 py-1 rounded">Add to cart</button>';
                echo '</div>';
            }
        } else {
            echo '<p>No books found.</p>';
        }

        // Close connection
        $conn->close();
        ?>
    </div>

</body>

</html>