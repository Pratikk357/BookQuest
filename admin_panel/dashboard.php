<?php require_once '../conn.php';
$conn = createConn(); // SQL query to count the number of items in the table
$table_name = "requested_book";
$sql = "SELECT COUNT(*) as count FROM $table_name"; // Execute the query
$result = $conn->query($sql);

if (!$result) {

    die("Query failed: " . $conn->error);
}

$requesteBbook_count = 0;
if ($row = $result->fetch_assoc()) {
    $requestedBook_count = $row['count'];
} else {
    echo "0 results";
}

// Free result set
$result->free();


$table_name = "book";
$sql = "SELECT COUNT(*) as books_count FROM $table_name";

// Execute the query
$result = $conn->query($sql);

if (!$result) {

    die("Query failed: " . $conn->error);
}

$book_count = 0;
if ($row = $result->fetch_assoc()) {
    $book_count = $row['books_count'];
} else {
    echo "0 results";
}

// Free result set
$result->free();


$table_name = "user";
$sql = "SELECT COUNT(*) as users_count FROM $table_name";

// Execute the query
$result = $conn->query($sql);

if (!$result) {

    die("Query failed: " . $conn->error);
}

$user_count = 0;
if ($row = $result->fetch_assoc()) {
    $user_count = $row['users_count'];
} else {
    echo "0 results";
}

// Free result set
$result->free();

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="navbar sticky w-full top-0 z-50 flex justify-center items-center text-white bg-slate-500  mb-3 py-2">
        <div class='flex gap-3 text-lg '>

            <a class="hover:text-slate-200" href="../index.php">Home</a>

            <?php echo '<a href="' . $navbar_link . '">' . $navbar_text . '</a>'; ?>
        </div>
    </div>
    <div class="p-3 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
        <div class="border p-4 ">
            <p class="p-4 flex flex-col items-center text-3xl">Total Requested
                Books<br>
            <p class="flex flex-col items-center text-2xl font-bold"><?php echo $requestedBook_count; ?>
            </p>
        </div>
        <div class="border p-4 ">
            <p class="p-4 flex flex-col items-center text-3xl">Total
                Books<br>
            <p class="flex flex-col items-center text-2xl font-bold"><?php echo $book_count; ?>
            </p>
        </div>
        <div class="border p-4 ">
            <p class="p-4 flex flex-col items-center text-3xl">Total Users<br>
            <p class="flex flex-col items-center text-2xl font-bold"><?php echo $user_count; ?>
            </p>
        </div>
    </div>
    <div class="p-3 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
        <div class="border p-4 flex flex-col items-center">
            <p class="text-lg font-bold mb-2 text-xl">View Requested books</p>
            <img src="../images/ViewReq.jpg" alt="Add book image" class="mb-2">
            <a href="../showRequested.php">
                <button class="bg-green-300 px-3 py-1 rounded border border-black" type="button">View Requested
                    Books</button>
            </a>
        </div>
        <div class="border p-4 flex flex-col items-center">
            <p class="text-lg font-bold mb-2 text-xl">Manage books</p>
            <img src="../images/show.jpg" alt="Add book image" class="mb-2">
            <a href="show.php">
                <button class="bg-green-300 px-3 py-1 rounded border border-black" type="button">Manage Books</button>
            </a>
        </div>
        <div class="border p-4 flex flex-col items-center">
            <p class="text-lg font-bold mb-2 text-xl">Add Books</p>
            <img src="../images/addB.jpg" alt="Add book image" class="mb-2">
            <a href="insert.php">
                <button class="bg-green-300 px-3 py-1 rounded border border-black" type="button">Add Books</button>
            </a>
        </div>
    </div>
</body>

</html>