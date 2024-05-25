<?php
session_start();
include 'header.php';

$cart = isset($_POST['cart']) ? json_decode($_POST['cart'], true) : [];
$total = 0;
?>
<script src="https://cdn.tailwindcss.com"></script>

<div class="container mt-5">
    <h1 class="text-3xl font-bold mb-4">Your Cart</h1>
    <?php if (count($cart) > 0) { ?>
        <table class="min-w-full bg-white border">
            <thead>
                <tr>
                    <th class="py-2 border">Book Name</th>
                    <th class="py-2 border">Price</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cart as $item) {
                    $total += $item['price'];
                    ?>
                    <tr>
                        <td class="py-2 border"><?php echo htmlspecialchars($item['name']); ?></td>
                        <td class="py-2 border">Rs. <?php echo number_format($item['price'], 2); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <p class="mt-4 font-bold">Total: Rs. <?php echo number_format($total, 2); ?></p>
    <?php } else { ?>
        <p>Your cart is empty.</p>
    <?php } ?>
</div>

<script>
    // Function to send cart data to the server
    function sendCartData() {
        const cart = localStorage.getItem('cart');
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = 'cart.php';

        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'cart';
        input.value = cart;

        form.appendChild(input);
        document.body.appendChild(form);
        form.submit();
    }

    // Send cart data when the page loads
    // window.onload = sendCartData;`
</script>

<?php include 'footer.php'; ?>