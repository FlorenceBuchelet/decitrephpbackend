<?php

require '../services/databaseConnect.php';
require "../services/sessionHandling.php";

sessionHandling();

$dbh = dbConnect();

if ($dbh) {
    $label = isset($_POST['label']) ? trim($_POST['label']) : '';
    $gender = "Mme";
    $firstname = isset($_POST['firstname']) ? trim($_POST['firstname']) : '';
    $lastname = isset($_POST['lastname']) ? trim($_POST['lastname']) : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    $addressDetails = isset($_POST['addressDetails']) ? $_POST['addressDetails'] : '';
    $city = isset($_POST['city']) ? $_POST['city'] : '';
    $region = isset($_POST['region']) ? $_POST['region'] : '';
    $country = isset($_POST['country']) ? $_POST['country'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $userId = $_SESSION['user_id'];
    $fullname = "$gender $firstname $lastname";

    $insertStatement = $dbh->prepare(
        "INSERT INTO address 
        (user_id, address_label, address_fullname, address, address_details, city, region, country, phone) 
        VALUES 
        (:userId, :label, :fullname, :address, :addressDetails, :city, :region, :country, :phone);"
    );
    $insertStatement->bindParam(':label', $label);
    $insertStatement->bindParam(':fullname', $fullname);
    $insertStatement->bindParam(':address', $address);
    $insertStatement->bindParam(':addressDetails', $addressDetails);
    $insertStatement->bindParam(':city', $city);
    $insertStatement->bindParam(':region', $region);
    $insertStatement->bindParam(':country', $country);
    $insertStatement->bindParam(':phone', $phone);
    $insertStatement->bindParam(':userId', $userId);
    $insertStatement->execute();

    // Vérifie si l'insertion s'est bien déroulée
    if ($insertStatement->rowCount() > 0) {
        // Insertion réussie
        echo "Nouvelle adresse créée.";
    } else {
        // Aucune ligne n'a été affectée, insertion échouée
        echo "Erreur lors de la création.";
    }

} else {
    echo 'Error during db connection';
}