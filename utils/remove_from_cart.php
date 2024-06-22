<?php
require_once "../conn.php";
$conn = createConn();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cart_id = $_POST['cart_id'];
    $conn->query("DELETE FROM cart WHERE id = $cart_id");
}
header("Location: cart.php");
?>