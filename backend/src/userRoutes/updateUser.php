<?php

require '../../databaseConnect.php';

$dbh = dbConnect();

if ($dbh) {
    $userId = isset($_POST['userId']) ? trim($_POST['userId']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $firstname = isset($_POST['firstname']) ? trim($_POST['firstname']) : '';
    $lastname = isset($_POST['lastname']) ? trim($_POST['lastname']) : '';
    $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';    
    $address = isset($_POST['address']) ? trim($_POST['address']) : '';

    $insertStatement = $dbh->prepare("UPDATE user SET email = :email, firstname = :firstname, lastname = :lastname, phone = :phone, address = :address WHERE user_id = :userId;");
    $insertStatement->bindParam(':userId', $userId);
    $insertStatement->bindParam(':email', $email);
    $insertStatement->bindParam(':firstname', $firstname);
    $insertStatement->bindParam(':lastname', $lastname);
    $insertStatement->bindParam(':phone', $phone);
    $insertStatement->bindParam(':address', $address);

    $insertStatement->execute();
} else {
    echo "Error during db connection.";
}