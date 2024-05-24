<!DOCTYPE html>
<html lang="en">



<body>

    <body class=" flex justify-center flex-col">
        <div
            class="navbar sticky w-full top-0 z-50 flex justify-center items-center text-white bg-slate-500  mb-3 py-2">
            <div class='flex gap-3 text-lg '>

                <a class="hover:text-slate-200" href="../index.php">Home</a>

                <?php echo '<a href="' . $navbar_link . '">' . $navbar_text . '</a>'; ?>
            </div>
        </div>
        <h2>Delete Book</h2>
        <?php
        // If ISBN is provided in the URL, display the delete confirmation form
        if (isset($_GET['isbn'])) {
            $isbn = $_GET['isbn'];
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="hidden" name="isbn" value="<?php echo $isbn; ?>">
                <p>Are you sure you want to delete this book?</p>
                <input type="submit" value="Delete">
            </form>
            <?php
        } else {
            // echo "ISBN number is not provided.";
        }
        ?>
    </body>

</html>
<?php
// Include the database connection file
require_once '../conn.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['isbn'])) {
    // Get ISBN from the form
    $isbn = $_POST['isbn'];

    // Get the database connection
    $conn = createConn();

    // SQL query to delete the book from the database
    $delete_sql = "DELETE FROM book WHERE isbn_no=?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $isbn);

    // Execute the SQL query
    if ($stmt->execute()) {
        header("location: show.php");
        echo "Book deleted successfully<br>";
    } else {
        echo "Error deleting book: " . $conn->error . "<br>";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>