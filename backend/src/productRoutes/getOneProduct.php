<?php

require '../services/databaseConnect.php';
require_once '../factory/ProductFactory.php';
require_once "../class/Product.php";

use Products\ProductFactory;

$dbh = dbConnect();

if ($dbh) {
    // Créer une fonction de récupération de products : retour des informations au format JSON
    $productId = isset($_GET['productId']) ? $_GET['productId'] : '';

    $selectStatement = $dbh->prepare("SELECT * FROM product WHERE product_id = :productId");
    $selectStatement->bindParam(':productId', $productId);
    // Exécute la requête préparée
    $selectStatement->execute();
    // Récupère les résultats sous forme de tableau associatif
    $readOneProduct = $selectStatement->fetchAll(\PDO::FETCH_ASSOC);
    echo json_encode($readOneProduct);

    // POO inutile pour s'entrainer 
    if ($readOneProduct) {
        $newProduct = ProductFactory::createProductFromDatabase(
            $readOneProduct['product_id'],
            $readOneProduct['ean'],
            $readOneProduct['title'],
            $readOneProduct['author'],
            $readOneProduct['image'],
            $readOneProduct['price'],
            $readOneProduct['promo_price'],
            $readOneProduct['category_id'],
            $readOneProduct['$quantity'],
        );
    }
} else {
    echo "Error during db connection.";
}
