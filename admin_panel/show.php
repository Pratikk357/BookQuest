<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View All Books</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

    <body class=" flex justify-center flex-col">
        <div
            class="navbar sticky w-full top-0 z-50 flex justify-center items-center text-white bg-slate-500  mb-3 py-2">
            <div class='flex gap-3 text-lg '>

                <a class="hover:text-slate-200" href="../index.php">Home</a>

                <?php echo '<a href="' . $navbar_link . '">' . $navbar_text . '</a>'; ?>
            </div>
        </div>
        <div class="p-3">
            <h2 class="font-bold text-xl">View All Books</h2>
            <table class="w-full  border border-slate-500 ">
                <tr class="border">
                    <th class="border border-slate-500 ">ISBN</th>
                    <th class="border border-slate-500 ">Book Name</th>
                    <th class="border border-slate-500 ">Price</th>
                    <th class="border border-slate-500 ">Author</th>
                    <th class="border border-slate-500 ">Book Cover</th>
                    <th class="border border-slate-500 ">Actions</th>
                </tr>

                <?php
                // Include the database connection file
                require_once '../conn.php';

                // Get the database connection
                $conn = createConn();

                // SQL query to fetch all books
                $sql = "SELECT isbn_no, book_name, price, author, book_cover FROM book";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr class='border'>";
                        echo "<td class='border border-slate-500 '>" . $row["isbn_no"] . "</td>";
                        echo "<td class='border border-slate-500 '>" . $row["book_name"] . "</td>";
                        echo "<td class='border border-slate-500 '>" . $row["price"] . "</td>";
                        echo "<td class='border border-slate-500 '>" . $row["author"] . "</td>";
                        echo "<td class='border border-slate-500 '><img src='data:image/jpeg;base64," . base64_encode($row["book_cover"]) . "' alt='Book Cover' style='width:100px;height:100px;'></td>";
                        echo "<td class='border border-slate-500 '>";
                        echo "<a class='bg-green-400 px-3 py-1' href='edit_book.php?isbn=" . $row["isbn_no"] . "'>Edit</a>  ";
                        echo "<a class='bg-red-500 px-3 py-1' href='delete_book.php?isbn=" . $row["isbn_no"] . "' onclick=\"return confirm('Are you sure you want to delete this book?');\">Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No books found</td></tr>";
                }
                $conn->close();
                ?>
            </table>
        </div>
    </body>

</html>