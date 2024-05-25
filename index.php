<?php
session_start();
include 'header.php' ?>
<div class="navbar sticky top-0 z-50 flex justify-center items-center text-white bg-slate-500  mb-3 py-2">
    <div class='flex gap-3 text-lg '>

        <a class="hover:text-slate-200" href="#home">Home</a>
        <a class="hover:text-slate-200" href="#about">About</a>
        <a class="hover:text-slate-200" href="#services">Services</a>
        <?php

        // Check if the user is logged in
        if (isset($_SESSION['username'])) {
            $navbar_text = "Logout";
            $navbar_link = "authentication/logout.php"; // Assuming logout logic is in logout.php
            echo '<a class="hover:text-slate-200" href="#ervices"></a>';
            echo '<div>
            Cart <span id="cartCount"></span>
            </div>';
            echo '<a class="hover:text-slate-200" href="request_book.php">Request Book</a>';
            echo '<a href="' . $navbar_link . '">' . $navbar_text . '</a>';
        } else {
            $navbar_text = "Login";
            $navbar_link = "authentication/login.php"; // Assuming login form is in login.php
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

    <h1 class="text-3xl font-bold ml-3 ">BEST SELLER</h1>
    <div class="container mt-3 flex gap-5 flex-wrap justify-center">
        <?php
        require_once 'conn.php';
        $conn = createConn();

        // SQL query to fetch all books
        $sql = "SELECT isbn_no, book_name, price, author, book_cover FROM book";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo '<div class="p-3 book border flex flex-col relative items-center">';
                echo '<img src="data:image/jpeg;base64,' . base64_encode($row["book_cover"]) . '" alt="Book Cover">';
                echo '<p class="font-bold text-lg mt-3">' . $row["book_name"] . '</p>';
                echo '<button class="bg-green-300 px-3 py-1 rounded" id = "cartCount" onclick="addToCart()">Add to cart</button>';
                echo '<p class="absolute top-2 right-2 bg-slate-900 text-white rounded px-1">Price: Rs.' . $row["price"] . '</p>';
                echo '</div>';


            }
        } else {
            echo "<tr><td colspan='6'>No books found</td></tr>";
        }
        $conn->close();
        ?>

        <!-- <div class="wrapper">

            <h1 class="text-3xl font-bold ml-3 ">NEW ARRIVALS</h1>
            <div class="container mt-3 flex gap-5 flex-wrap justify-center">

                <div class="p-3 book border flex flex-col relative items-center">
                    <img src='./images/firfire.jpeg'>
                    <p class="font-bold text-lg mt-3">Firfire</p>
                    <button class='bg-green-300 px-3 py-1 rounded '>Add to cart</button>
                    <p class="absolute top-2 right-2 bg-slate-900 text-white rounded px-1">Price: Rs. 1000</p>
                </div>

                <div class="p-3 book border flex flex-col relative items-center">
                    <img src='./images/posm.jpg'>
                    <p class="font-bold text-lg mt-3">Power of subconscious Mind</p>
                    <button class='bg-green-300 px-3 py-1 rounded '>Add to cart</button>
                    <p class="absolute top-2 right-2 bg-slate-900 text-white rounded px-1">Price: Rs.775</p>

                </div>

                <div class="p-3 book border flex flex-col relative items-center">
                    <img src='./images/atomichabits.jpg'>
                    <p class="font-bold text-lg mt-3">Atomic Habits</p>
                    <button class='bg-green-300 px-3 py-1 rounded '>Add to cart</button>
                    <p class="absolute top-2 right-2 bg-slate-900 text-white rounded px-1">Price: Rs.820</p>

                </div>

                <div class="p-3 book border flex flex-col relative items-center">
                    <img src='./images/karnaliblues.jpeg'>
                    <p class="font-bold text-lg mt-3">karnali Blues</p>
                    <button class='bg-green-300 px-3 py-1 rounded '>Add to cart</button>
                    <p class="absolute top-2 right-2 bg-slate-900 text-white rounded px-1">Price: Rs.645</p>

                </div>

                <div class="p-3 book border flex flex-col relative items-center">
                    <img src='./images/munamadman.jpeg'>
                    <p class="font-bold text-lg mt-3">Muna madan</p>
                    <button class='bg-green-300 px-3 py-1 rounded '>Add to cart</button>
                    <p class="absolute top-2 right-2 bg-slate-900 text-white rounded px-1">Price: Rs.455</p>

                </div>
            </div>
        </div> -->
        <script>
            let cartCount = 0;
            function addToCart() {
                cartCount++;
                document.getElementById('cartCount').innerText = cartCount;
            }

        </script>
        <?php include 'footer.php' ?>