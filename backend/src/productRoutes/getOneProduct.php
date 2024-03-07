<?php

require '../services/databaseConnect.php';

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
} else {
    echo "Error during db connection.";
}
