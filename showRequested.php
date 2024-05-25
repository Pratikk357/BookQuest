<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Requested Books</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="p-3">
    <div class="navbar sticky w-full top-0 z-50 flex justify-center items-center text-white bg-slate-500  mb-3 py-2">
        <div class='flex gap-3 text-lg '>

            <a class="hover:text-slate-200" href="index.php">Home</a>
            <a class="hover:text-slate-200" href="./admin_panel/dashboard.php">Dashboard</a>


            <?php echo '<a href="' . $navbar_link . '">' . $navbar_text . '</a>'; ?>
        </div>
    </div>
    <h2 class="text-xl font-bold">Requested Books</h2>

    <?php
    require_once './conn.php';
    $conn = createConn();

    // Fetch data from the requested_book table
    $sql = "SELECT * FROM requested_book";
    $result = $conn->query($sql);

    // Display fetched data
    if ($result->num_rows > 0) {
        echo "<table class='border border-slate-500'>";
        echo "<tr class='border border-slate-500'><th class='border border-slate-500'>Book Name</th><th class='border border-slate-500'>Author Name</th><th class='border border-slate-500'>Username</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr class='border border-slate-500'><td class='border border-slate-500'>" . $row["book_name"] . "</td><td class='border border-slate-500'>" . $row["author"] . "</td><td class='border border-slate-500'>" . $row["username"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "No requested books found";
    }


    // Close database connection
    $conn->close();
    ?>
</body>

</html>