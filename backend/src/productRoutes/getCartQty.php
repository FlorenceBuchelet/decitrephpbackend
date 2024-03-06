<?php

require_once '../class/Product.php';
require_once '../factory/ProductFactory.php';
require '../userRoutes/sessionHandling.php';

sessionHandling();

$qty = 0;
$cart = $_SESSION['cart'];

if (!empty($_SESSION['cart'])) {
    foreach ($cart as $item) {
        $qty += (int)$item['quantity'];
    };
}

// Send the total to frontend
echo json_encode($qty);
