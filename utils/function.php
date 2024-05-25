<?php
session_start();

function addToCart($bookId, $bookName, $price)
{
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (isset($_SESSION['cart'][$bookId])) {
        $_SESSION['cart'][$bookId]['quantity'] += 1;
    } else {
        $_SESSION['cart'][$bookId] = [
            'name' => $bookName,
            'price' => $price,
            'quantity' => 1
        ];
    }
}

function getCart()
{
    return isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
}

function clearCart()
{
    $_SESSION['cart'] = [];
}
?>