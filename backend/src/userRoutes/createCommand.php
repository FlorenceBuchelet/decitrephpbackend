<?php

require '../services/databaseConnect.php';
require "../services/sessionHandling.php";

sessionHandling();

$dbh = dbConnect();

if ($dbh) {
    $userId = isset($_POST['user_id']) ? trim($_POST['user_id']) : '';
    $addressLabel = isset($_POST['address_label']) ? trim($_POST['address_label']) : '';

    // 1 SELECT la bonne adresse
    $selectStatement = $dbh->prepare('SELECT * FROM address WHERE user_id = :userId AND address_label = :addressLabel');
    $selectStatement->bindParam(':userId', $userId);
    $selectStatement->bindParam(':addressLabel', $addressLabel);
    $selectStatement->execute();
    $readAddress = $selectStatement->fetch(\PDO::FETCH_ASSOC);

    // 2 Clone cette adresse dans command_address
    if (isset($readAddress) && !empty($readAddress)) {
        $insertStatement = $dbh->prepare('INSERT INTO command_address (command_fullname, address, address_details, city, region, country, phone)
            VALUES (:fullname, :address, :addressDetails, :city, :region, :country, :phone);');
        $insertStatement->bindParam(':fullname', $readAddress['address_fullname']);
        $insertStatement->bindParam(':address', $readAddress['address']);
        $insertStatement->bindParam(':addressDetails', $readAddress['address_details']);
        $insertStatement->bindParam(':city', $readAddress['city']);
        $insertStatement->bindParam(':region', $readAddress['region']);
        $insertStatement->bindParam(':country', $readAddress['country']);
        $insertStatement->bindParam(':phone', $readAddress['phone']);
        $insertStatement->execute();
    }

    // 3 Crée la command et update la command avec toutes les infos (INSERT ?)
    if ($insertStatement->rowCount() > 0) {
        // Insertion réussie
        $lastInsertId = $dbh->lastInsertId();

        $insertStatement = $dbh->prepare('INSERT INTO command (user_id, cart_id, command_total, command_address_id)
            VALUES (:userId, :cartId, :commandTotal, :commandAddressId);');
        $insertStatement->bindParam(':userId', $_SESSION['user_id']);
        $insertStatement->bindParam(':cartId', $_SESSION['cart_id']['cart_id']);
        $insertStatement->bindParam(':commandTotal', $_SESSION['cart_total'], \PDO::PARAM_STR);
        $insertStatement->bindParam(':commandAddressId', $lastInsertId);
        $insertStatement->execute();
        // 4 Retourner confirmation
        if ($insertStatement->rowCount() > 0) {
            echo "Nouvelle commande créée.";
        } else {
            echo "Erreur lors de la création de commande.";
        }
    } else {
        // Aucune ligne n'a été affectée, insertion échouée
        echo "Erreur lors de la création de l'adresse de commande.";
    }

} else {
    echo 'Error during db connection';
}