<?php

require '../services/databaseConnect.php';

$dbh = dbConnect();

if ($dbh) {
    // Créer une fonction d'autocomplétion
    $userSearch = isset($_GET['search']) ? $_GET['search'] : '';

    $selectStatement = $dbh->prepare(
        "SELECT * FROM research WHERE research_value LIKE CONCAT('%', :userSearch, '%') ORDER BY nbr_research DESC;"
    );
    $selectStatement->bindParam(':userSearch', $userSearch);
    // Exécute la requête préparée
    $selectStatement->execute();
    // Récupère les résultats sous forme de tableau associatif
    $autocomplete = $selectStatement->fetchAll(\PDO::FETCH_ASSOC);
    echo json_encode($autocomplete);
} else {
    echo "Error during db connection.";
}
