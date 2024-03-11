<?php

require '../services/databaseConnect.php';
require_once '../class/CartProduct.php';
require_once '../factory/CartProductFactory.php';
require "../services/sessionHandling.php";

use Products\CartProduct;
use Products\CartProductFactory;

sessionHandling();

$dbh = dbConnect();

if ($dbh) {
    $productId = isset($_GET['productId']) ? $_GET['productId'] : '';
    $quantity = isset($_GET['quantity']) ? $_GET['quantity'] : -1;

    $selectStatement = $dbh->prepare("SELECT * FROM product WHERE product_id = :productId");
    $selectStatement->bindParam(':productId', $productId);
    $selectStatement->execute();
    $readOneProduct = $selectStatement->fetch(\PDO::FETCH_ASSOC);
    if ($readOneProduct) {
        $newProduct = CartProductFactory::createCartProductFromDatabase(
            $readOneProduct['product_id'],
            $readOneProduct['ean'],
            $readOneProduct['title'],
            $readOneProduct['author'],
            $readOneProduct['image'],
            $readOneProduct['price'],
            $readOneProduct['promo_price'],
            $readOneProduct['category_id'],
            $_SESSION['cart_id']['cart_id'],
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

    var_dump($newProduct);

} else {
    echo "Error during db connection.";
}
