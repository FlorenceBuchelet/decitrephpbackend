<?php

require_once '../class/Product.php';
require_once '../factory/ProductFactory.php';

use Products\Product;
use Products\ProductFactory;

// Continue la session de l'utilisateur logué
if (isset($_COOKIE['PHPSESSID'])) {
    session_id($_COOKIE['PHPSESSID']);
    session_start();
}

$allowed_origin = 'http://localhost:5173';
header("Access-Control-Allow-Origin: $allowed_origin");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Specificity, Authorization");
header("Access-Control-Allow-Credentials: true");

// Send the cart to frontend
echo json_encode(number_format($_SESSION['cartTotalPrice'], 2, ',', ' '));


    // if (produit) {$_SESSION['cart']['produit']['quantity'] = $_SESSION['cart']['produit']['quantity'] + 1};
    // if (!produit) {$_SESSION['cart'][] = $newProduct;} + gérer quantité;
    // dans le panier : bouton + et - => $_SESSION['cart']['produit'] +/-1 si 0 => delete
