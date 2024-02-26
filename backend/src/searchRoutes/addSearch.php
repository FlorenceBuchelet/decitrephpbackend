<?php

require '../../databaseConnect.php';

$dbh = dbConnect();

if ($dbh) {
    // Créer une fonction d'insertion dans la table research
    // Vérifie si $_POST['research'] est défini avant d'utiliser trim() pour éviter l'erreur trim(null)
    $research = isset($_POST['research']) ? trim($_POST['research']) : '';
    $nbr_research = $_POST['nbr_research'];
    // Requêtes préparées
    if ($_SERVER['HTTP_SPECIFICITY'] === 'addSearch') {
        $insertStatement = $dbh->prepare("INSERT INTO research (research, nbr_research) VALUES (:research, :nbr_research)");
    }
    if ($_SERVER['HTTP_SPECIFICITY'] === 'updateSearch') {
        $insertStatement = $dbh->prepare("UPDATE research SET nbr_research = :nbr_research WHERE research = :research");
    }
    $insertStatement->bindParam(':research', $research);
    $insertStatement->bindParam(':nbr_research', $nbr_research);

    $insertStatement->execute();
} else {
    echo "Error during db connexion.";
}