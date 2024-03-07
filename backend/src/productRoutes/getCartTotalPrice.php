<?php

require_once '../class/Product.php';
require "../services/sessionHandling.php";

sessionHandling();

$totalPrice = 0;
$cart = $_SESSION['cart'];

foreach ($cart as $item) {
    (float)$promoPrice = $item['product']->getPromoPrice();
    (float)$price = $item['product']->getPrice();
    $promoPrice
        ? $totalPrice += (float)$promoPrice * (int)$item['quantity']
        : $totalPrice += (float)$price * (int)$item['quantity'];
};

// Send the cart to frontend
echo json_encode(number_format($totalPrice, 2, ',', ' '));
