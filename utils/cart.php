<?php
require_once '../conn.php';
$conn = createConn();
$result = $conn->query("SELECT cart.id, book.book_name, book.author, book.price, cart.quantity FROM cart JOIN book ON cart.isbn_no = book.isbn_no");
?>
<!DOCTYPE html>
<html>

<head>
    <title>Cart</title>
</head>

<body>
    <h1>Your Cart</h1>
    <div>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <div>
                <h2><?php echo $row['book_name']; ?></h2>
                <p><?php echo $row['author']; ?></p>
                <p>$<?php echo $row['price']; ?></p>
                <p>Quantity: <?php echo $row['quantity']; ?></p>
                <p>Total: $<?php echo $row['price'] * $row['quantity']; ?></p>
                <form method="post" action="remove_from_cart.php">
                    <input type="hidden" name="cart_id" value="<?php echo $row['id']; ?>">
                    <input type="submit" value="Remove">
                </form>
            </div>
        <?php } ?>
    </div>
    <a href="../index.php">Continue Shopping</a>
    <form method="post" action="buy.php">
        <input type="submit" value="buy">
    </form>

</body>

</html>