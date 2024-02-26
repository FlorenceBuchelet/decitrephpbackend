<?php

require '../../databaseConnect.php';

$dbh = dbConnect();

if ($dbh) {
    $email = isset($_GET['email']) ? $_GET['email'] : '';
    // Récupérer la valeur du cookie 'auth'
    $authCookie = isset($_COOKIE['auth']) ? $_COOKIE['auth'] : null;

    // Utiliser la valeur du cookie comme nécessaire
    echo "Contenu du cookie 'auth': " . $authCookie;

    $selectStatement = $dbh->prepare("SELECT * FROM user WHERE email = :email");
    $selectStatement->bindParam(':email', $email);
    $selectStatement->execute();
    // Récupère les résultats sous forme de tableau associatif
    $readOneUser = $selectStatement->fetchAll(\PDO::FETCH_ASSOC);
    echo json_encode($readOneUser);
} else {
    echo "Error during db connexion.";
}
