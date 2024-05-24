<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>


<div class="flex flex-col border items-center p-4">

    <body class=" flex justify-center flex-col">
        <div
            class="navbar sticky w-full top-0 z-50 flex justify-center items-center text-white bg-slate-500  mb-3 py-2">
            <div class='flex gap-3 text-lg '>

                <a class="hover:text-slate-200" href="../index.php">Home</a>

                <?php echo '<a href="' . $navbar_link . '">' . $navbar_text . '</a>'; ?>
            </div>
        </div>
        <h2 class="font-bold text-lg">Add Book</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
            enctype="multipart/form-data">
            <label for="isbn">ISBN Number:</label><br>
            <input class="border px-3 py-1 shadow" type="text" id="isbn" name="isbn" required><br><br>

            <label for="book_name">Book Name:</label><br>
            <input class="border px-3 py- shadow" type="text" id="book_name" name="book_name" required><br><br>

            <label for="price">Price:</label><br>
            <input class="border px-3 py-1 shadow" type="text" id="price" name="price" required><br><br>

            <label for="author">Author:</label><br>
            <input class="border px-3 py-1 shadow" type="text" id="author" name="author" required><br><br>

            <label for="book_cover">Book Cover:</label><br>
            <input type="file" id="book_cover" name="book_cover" accept="image/*" required><br><br>

            <input type="submit" class="bg-green-500 px-3 py-1 rounded border border-black text-white shadow"
                value="Add Book">
        </form>
</div>

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

    // File upload handling
    $target_file = $_FILES["book_cover"]["tmp_name"];
    $file_content = file_get_contents($target_file);

    // Get the database connection
    $conn = createConn();

    // SQL query to insert book into database
    $stmt = $conn->prepare("INSERT INTO book (isbn_no, `book_name`, price, author, book_cover) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $isbn, $book_name, $price, $author, $file_content);

    // Execute the SQL query
    if ($stmt->execute()) {
        echo "Book added successfully<br>";
    } else {
        echo "Error adding book: " . $conn->error . "<br>";
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}
?>


</body>

</html>