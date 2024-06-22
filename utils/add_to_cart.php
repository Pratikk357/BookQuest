<?php
require_once '../conn.php';

$conn = createConn();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $isbn_no = $_POST['isbn_no'];
    $quantity = $_POST['quantity'];

    // Check if the book is already in the cart
    $result = $conn->query("SELECT * FROM cart WHERE isbn_no = $isbn_no");
    if ($result->num_rows > 0) {
        // Update the quantity
        $conn->query("UPDATE cart SET quantity = quantity + $quantity WHERE isbn_no = $isbn_no");
    } else {
        // Insert new record
        $conn->query("INSERT INTO cart (isbn_no, quantity) VALUES ($isbn_no, $quantity)");
    }
}
header("Location: ../index.php");

?>