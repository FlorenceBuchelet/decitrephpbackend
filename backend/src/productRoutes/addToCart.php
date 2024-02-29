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
    $productId = isset($_GET['productId']) ? $_GET['productId'] : '';

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

    $_SESSION['cart'][] = $newProduct;
    // $_SESSION['cart'] = []; // clean the cart
    var_dump($_SESSION['cart']); // réponse front pour vérification
} else {
    echo "Error during db connection.";
}

// if (produit) {$_SESSION['cart']['produit']['quantity'] = $_SESSION['cart']['produit']['quantity'] + 1};
// if (!produit) {$_SESSION['cart'][] = $newProduct;} + gérer quantité;
// dans le panier : bouton + et - => $_SESSION['cart']['produit'] +/-1 si 0 => delete
// C'est ici (enfin en back) que j'utilise la factory pour ajouter directement le produit en entier avec toutes ses caractéristiques ?
