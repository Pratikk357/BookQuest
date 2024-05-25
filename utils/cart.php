<div class="p-3">
    <h2 class="font-bold text-xl">View All Books</h2>
    <table class="w-full  border border-slate-500 ">
        <tr class="border">
            <th class="border border-slate-500 ">ISBN</th>
            <th class="border border-slate-500 ">Book Name</th>
            <th class="border border-slate-500 ">Price</th>
            <th class="border border-slate-500 ">Author</th>
            <th class="border border-slate-500 ">Book Cover</th>
        </tr>

        <?php
        // Include the database connection file
        require_once '../conn.php';

        // Get the database connection
        $conn = createConn();

        // SQL query to fetch all books
        $sql = "SELECT isbn_no, book_name, price, author, book_cover FROM book WHERE isbn = '?' ";
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