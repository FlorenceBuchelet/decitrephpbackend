<?php

require_once '../class/CartProduct.php';
require_once '../factory/CartProductFactory.php';
require "../services/sessionHandling.php";
require "../services/cartHandling.php";

use Products\CartProductFactory;

sessionHandling();
cartHandling();

$dbh = dbConnect();

if ($dbh) {
    (int) $productId = isset($_GET['productId']) ? $_GET['productId'] : '';
    (int) $quantity = isset($_GET['quantity']) ? $_GET['quantity'] : -1;

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
        if ($quantity > 0) {
            $insertStatement = $dbh->prepare(
                "INSERT INTO cart_product (ean, title, author, image, price, promo_price, category_id, cart_id) 
            VALUES (:ean, :title, :author, :image, :price, :promoPrice, :categoryId, :cartId);"
            );
            $newProductEan = $newProduct->getEan();
            $newProductTitle = $newProduct->getTitle();
            $newProductAuthor = $newProduct->getAuthor();
            $newProductImage = $newProduct->getImage();
            $newProductPromoPrice = $newProduct->getPromoPrice();
            $newProductPrice = $newProduct->getPrice();
            $newProductCategoryId = $newProduct->getCategoryId();

            $insertStatement->bindParam(':ean', $newProductEan);
            $insertStatement->bindParam(':title', $newProductTitle);
            $insertStatement->bindParam(':author', $newProductAuthor);
            $insertStatement->bindParam(':image', $newProductImage);
            $insertStatement->bindParam(':promoPrice', $newProductPromoPrice);
            $insertStatement->bindParam(':price', $newProductPrice);
            $insertStatement->bindParam(':categoryId', $newProductCategoryId);
            $insertStatement->bindParam(':cartId', $_SESSION['cart_id']['cart_id']);
            $insertStatement->execute();
        } else {
            $selectStatement = $dbh->prepare("SELECT cart_product.cart_product_id
                FROM cart_product 
                JOIN cart ON cart_product.cart_id = cart.cart_id
                WHERE cart_product.ean = :ean AND cart.cart_id = :cartId
                ");
            $selectStatement->bindParam(':cartId', $_SESSION['cart_id']['cart_id']);
            $selectStatement->bindParam(':ean', $readOneProduct['ean']);
            $selectStatement->execute();
            $readOneProductQuantity = $selectStatement->fetch(\PDO::FETCH_ASSOC);
            $deleteStatement = $dbh->prepare('DELETE cart_product.* FROM cart_product WHERE cart_product_id = :cartProductId');
            $deleteStatement->bindParam(':cartProductId', $readOneProductQuantity['cart_product_id']);
            $deleteStatement->execute(); 
        }
    }

    isset($_SESSION['cart']['quantity'])
        ? $_SESSION['cart']['quantity'] += $quantity
        : $_SESSION['cart'] = ['quantity' => $quantity];


    var_dump($_SESSION);

} else {
    echo "Error during db connection.";
}
