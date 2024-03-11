<?php

require '../services/databaseConnect.php';
require_once '../class/CartProduct.php';
require_once '../factory/CartProductFactory.php';
require '../services/sessionHandling.php';

sessionHandling();

$dbh = dbConnect();

if ($dbh) {
    // fetch le cart en fonction du cart_id
    $selectStatement = $dbh->prepare("SELECT cart_product.*, product.product_id, COUNT(*) AS quantity
        FROM cart_product 
        JOIN product on cart_product.ean = product.ean
        JOIN cart ON cart_product.cart_id = cart.cart_id
        WHERE cart.cart_id = :cartId
        GROUP BY cart_product.ean;");
    $selectStatement->bindParam(':cartId', $_SESSION['cart_id']['cart_id']);
    $selectStatement->execute();
    $readCart = $selectStatement->fetchAll(\PDO::FETCH_ASSOC);
    echo json_encode($readCart);
} else {
    echo "Error during db connection.";
}
