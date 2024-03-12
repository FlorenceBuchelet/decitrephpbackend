<?php

require '../services/databaseConnect.php';
require_once '../class/CartProduct.php';
require_once '../factory/CartProductFactory.php';
require '../services/sessionHandling.php';

sessionHandling();

$dbh = dbConnect();

if ($dbh) {
    // fetch le cart en fonction du cart_id
    $selectStatement = $dbh->prepare("SELECT 
        SUM(CASE 
        WHEN cart_product.promo_price IS NOT NULL 
        THEN cart_product.promo_price
        ELSE cart_product.price
        END) AS total
    FROM cart_product
    WHERE cart_product.cart_id = :cartId;
    ");
    $selectStatement->bindParam(':cartId', $_SESSION['cart_id']['cart_id']);
    $selectStatement->execute();
    $readTotal = $selectStatement->fetchAll(\PDO::FETCH_ASSOC);
    echo json_encode(number_format($readTotal[0]['total'], 2, ',', ' '));
} else {
    echo "Error during db connection.";
}

