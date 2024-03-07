<?php

require '../services/databaseConnect.php';

$dbh = dbConnect();

if ($dbh) {
    // Créer une fonction de récuperation dans la table research : retour des informations au format JSON
    $query = "SELECT * FROM research";
    $selectStatement = $dbh->query($query);
    $readAllSearch = $selectStatement->fetchAll(\PDO::FETCH_ASSOC);
    echo json_encode($readAllSearch);
} else {
    echo "Error during db connection.";
}