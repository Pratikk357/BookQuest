<?php
session_start();
include 'header.php';
?>

<div class="navbar sticky top-0 z-50 flex justify-center items-center text-white bg-slate-500 mb-3 py-2">
    <div class='flex gap-3 text-lg'>
        <a class="hover:text-slate-200" href="#home">Home</a>
        <a class="hover:text-slate-200" href="#about">About</a>
        <a class="hover:text-slate-200" href="#services">Services</a>
        <?php
        if (isset($_SESSION['username'])) {
            $navbar_text = "Logout";
            $navbar_link = "authentication/logout.php";
            echo '<a class="hover:text-slate-200" href="./utils/cart.php">Cart</a>';
            echo '<div><span id="cartCount">0</span></div>';
            echo '<a class="hover:text-slate-200" href="request_book.php">Request Book</a>';
            echo '<a href="' . $navbar_link . '">' . $navbar_text . '</a>';
        } else {
            $navbar_text = "Login";
            $navbar_link = "authentication/login.php";
            echo '<a href="' . $navbar_link . '">' . $navbar_text . '</a>';
        }
        ?>
    </div>
</div>

<div class="search-container flex justify-end">
    <form action="utils/result.php" method="GET">
        <input class='border border-black rounded px-3 py-1' type="text" placeholder="Search for books" name="search">
        <button class='btn bg-blue-500 px-3 py-1 hover:bg-blue-300' type="submit">Search</button>
    </form>
</div>

<div class="wrapper">
    <h1 class="text-3xl font-bold ml-3">BEST SELLER</h1>
    <div class="container mt-3 flex gap-5 flex-wrap justify-center">
        <?php
        require_once 'conn.php';
        $conn = createConn();

        $sql = "SELECT isbn_no, book_name, price, author, book_cover FROM book";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="p-3 book border flex flex-col relative items-center">';
                echo '<img src="data:image/jpeg;base64,' . base64_encode($row["book_cover"]) . '" alt="Book Cover">';
                echo '<p class="font-bold text-lg mt-3">' . $row["book_name"] . '</p>';
                echo '<button class="bg-green-300 px-3 py-1 rounded" onclick="addToCart(' . $row['isbn_no'] . ', \'' . addslashes($row['book_name']) . '\', ' . $row['price'] . ')">Add to cart</button>';
                echo '<p class="absolute top-2 right-2 bg-slate-900 text-white rounded px-1">Price: Rs.' . $row["price"] . '</p>';
                echo '</div>';
            }
        } else {
            echo "<tr><td colspan='6'>No books found</td></tr>";
        }
        $conn->close();
        ?>
    </div>
</div>

<script>
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    function addToCart(isbn, name, price) {
        cart.push({ isbn, name, price });
        localStorage.setItem('cart', JSON.stringify(cart));
        document.getElementById('cartCount').innerText = cart.length;
    }

    function loadCartCount() {
        document.getElementById('cartCount').innerText = cart.length;
    }

    window.onload = loadCartCount;
</script>

<?php include 'footer.php'; ?>