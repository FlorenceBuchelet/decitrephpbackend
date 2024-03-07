<?php

require '../services/databaseConnect.php';

$dbh = dbConnect();

if ($dbh) {
    // Créer une fonction de récupération de products : retour des informations au format JSON
    $query = "SELECT * FROM product";
    $selectStatement = $dbh->query($query);
    // ::FETCH_BOTH default, associatif et numérique, ::FETCH_ASSOC, associatif only
    $readAllProducts = $selectStatement->fetchAll(\PDO::FETCH_ASSOC);
    echo json_encode($readAllProducts);
} else {
    echo "Error during db connection.";
}
