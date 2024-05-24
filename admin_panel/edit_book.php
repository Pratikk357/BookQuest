<?php
// Include the database connection file
require_once '../conn.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $isbn = $_POST['isbn'];
    $book_name = $_POST['book_name'];
    $price = $_POST['price'];
    $author = $_POST['author'];

    // Get the database connection
    $conn = createConn();

    // SQL query to update book in the database based on ISBN number
    $sql = "UPDATE book SET `book_name`=?, price=?, author=? WHERE isbn_no=?";

    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdsi", $book_name, $price, $author, $isbn);

    // Execute the SQL query
    if ($stmt->execute()) {
        echo "Book updated successfully<br>";
    } else {
        echo "Error updating book: " . $conn->error . "<br>";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    // If form is not submitted, redirect or display form for editing
    if (isset($_GET['isbn'])) {
        // Get the ISBN number from the URL
        $isbn = $_GET['isbn'];

        // Get the database connection
        $conn = createConn();

        // SQL query to fetch book details by ISBN number
        $sql = "SELECT * FROM book WHERE isbn_no=?";

        // Prepare and bind parameter
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $isbn);

        // Execute the SQL query
        $stmt->execute();

        // Get result
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Fetch book details
            $row = $result->fetch_assoc();
            $book_name = $row['book_name'];
            $price = $row['price'];
            $author = $row['author'];

            // Display form for editing
            ?>
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Edit Book</title>
                <script src="https://cdn.tailwindcss.com"></script>

            </head>

            <body class="flex justify-center class='border px-3 py-1 shadow'">
                <div class="flex flex-col border p-3">

                    <h2 class="font-bold text-lg">Edit Book</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <input class='border px-3 py-1 shadow' type="hidden" name="isbn" value="<?php echo $isbn; ?>">
                        <label for="book_name">Book Name:</label><br>
                        <input class='border px-3 py-1 shadow' type="text" id="book_name" name="book_name"
                            value="<?php echo $book_name; ?>" required><br><br>

                        <label for="price">Price:</label><br>
                        <input class='border px-3 py-1 shadow' type="text" id="price" name="price" value="<?php echo $price; ?>"
                            required><br><br>

                        <label for="author">Author:</label><br>
                        <input class='border px-3 py-1 shadow' type="text" id="author" name="author" value="<?php echo $author; ?>"
                            required><br><br>

                        <input class="bg-green-500 text-white px-3 py-1 border-black border rounded" type="submit"
                            value="Update Book">
                    </form>
                </div>
            </body>

            </html>
            <?php
        } else {
            echo "No book found with ISBN: $isbn";
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    } else {
        echo "ISBN number is not provided.";
    }
}
?>