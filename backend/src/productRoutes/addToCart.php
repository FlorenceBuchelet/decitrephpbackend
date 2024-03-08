<?php

require '../services/databaseConnect.php';
require_once '../class/Product.php';
require_once '../factory/ProductFactory.php';
require "../services/sessionHandling.php";

use Products\Product;
use Products\ProductFactory;

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
        $newProduct = ProductFactory::createProductFromDatabase(
            $readOneProduct['product_id'],
            $readOneProduct['ean'],
            $readOneProduct['title'],
            $readOneProduct['image'],
            $readOneProduct['author'],
            $readOneProduct['price'],
            $readOneProduct['promo_price'],
            $readOneProduct['category_id'],
            $readOneProduct['quantity'],
        );
        $addToCartTotalPrice = $readOneProduct['promo_price'] || $readOneProduct['price'];
    }
    $newProductId = $newProduct->getProductId();

    // Insert new product in cart_product
    $insertStatement = $dbh->prepare(
        "INSERT INTO cart_product (ean, title, author, image, price, category_id, cart_id) 
        VALUES (:ean, :title, :author, :image, :price, :categoryId, :cartId);"
    );
    $newProductEan = $newProduct->getEan();
    $newProductTitle = $newProduct->getTitle();
    $newProductAuthor = $newProduct->getAuthor();
    $newProductImage = $newProduct->getImage();
    $newProductPrice = $newProduct->getPrice();
    $newProductPromoPrice = $newProduct->getPromoPrice();
    $newProductCategoryId = $newProduct->getCategoryId();

    $insertStatement->bindParam(':ean', $newProductEan);
    $insertStatement->bindParam(':title', $newProductTitle);
    $insertStatement->bindParam(':author', $newProductAuthor);
    $insertStatement->bindParam(':image', $newProductImage);
    if (!empty($newProductPromoPrice)) {
        $insertStatement->bindParam(':price', $newProductPromoPrice);
    } else {
        $insertStatement->bindParam(':price', $newProductPrice);
    }
    $insertStatement->bindParam(':categoryId', $newProduct);
    $insertStatement->bindParam(':cartId', $_SESSION['cart_id']);
    $insertStatement->execute();

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

    var_dump($_SESSION);

} else {
    echo "Error during db connection.";
}
