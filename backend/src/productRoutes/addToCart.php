<?php

require '../../databaseConnect.php';
require_once '../class/Product.php';
require_once '../factory/ProductFactory.php';

use Products\Product;
use Products\ProductFactory;

if (isset($_COOKIE['PHPSESSID'])) {
    session_id($_COOKIE['PHPSESSID']);
    session_start();
}


$dbh = dbConnect();

if ($dbh) {
    var_dump($_GET);
    $productId = isset($_GET['productId']) ? $_GET['productId'] : '';
    $quantity = isset($_GET['quantity']) ? $_GET['quantity'] : -1;

    $selectStatement = $dbh->prepare("SELECT * FROM product WHERE product_id = :productId");
    $selectStatement->bindParam(':productId', $productId);
    $selectStatement->execute();
    $readOneProduct = $selectStatement->fetch(\PDO::FETCH_ASSOC);
    if ($readOneProduct) {
        $newProduct = ProductFactory::createProductFromDatabase(
            $readOneProduct['product_id'],
            $readOneProduct['ean'],
            $readOneProduct['title'],
            $readOneProduct['image'],
            $readOneProduct['author'],
            $readOneProduct['price'],
            $readOneProduct['promo_price']
        );
    }
    $newProductId = $newProduct->getProductId();

    if (isset($_SESSION['cart'][$newProductId])) {
        $_SESSION['cart'][$newProductId]['quantity'] += $quantity;
    } else {
        $_SESSION['cart'][$newProductId] =
            [
                'product' => $newProduct,
                'quantity' => $quantity,
            ];
    }

    if ($_SESSION['cart'][$newProductId]['quantity'] === 0) {
        unset($_SESSION['cart'][$newProductId]);
    }

    var_dump($_SESSION['cart']); // réponse front pour vérification
} else {
    echo "Error during db connection.";
}
