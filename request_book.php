<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Book</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="flex flex-col border items-center p-4">
        <h2 class="font-bold text-lg">Request Book</h2>
        <form class="border p-4" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
            enctype="multipart/form-data">
            <label for="book_name">Book Name:</label><br>
            <input class="border px-3 py-1 shadow" type="text" id="book_name" name="book_name"
                placeholder="Enter book name" required><br><br>
            <label for="author_name">Author Name:</label><br>
            <input class="border px-3 py-1 shadow" type="text" id="author" name="author_name"
                placeholder="Enter author name" required><br><br>
            <label for="username">Username:</label><br>
            <input class="border px-3 py-1 shadow" type="text" id="username" name="username"
                placeholder="Enter your username" required><br><br>
            <input class="bg-green-500 px-3 py-1 rounded border border-black text-white shadow" type="submit"
                name="submit" value="Submit">
        </form>
    </div>


    <?php
    require_once './conn.php';
    // Inserting book and author names into the database
    if (isset($_POST['submit'])) {
        $bookName = $_POST['book_name'];
        $authorName = $_POST['author_name'];
        $username = $_POST['username'];

        $conn = createConn();

        $sql = "INSERT INTO requested_book (book_name, author, username) VALUES ('$bookName', '$authorName', '$username')";

        if ($conn->query($sql) === TRUE) {
            echo "Book requested sucessfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Close database connection
    $conn->close();

    ?>
</body>

</html>