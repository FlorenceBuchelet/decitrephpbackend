<?php

require '../services/databaseConnect.php';
require "../services/JwtHandler.php";
require "../services/sessionHandling.php";

sessionHandling();

$token = $_COOKIE['JWT'];
$jwt = new JwtHandler();
$data = $jwt->decode($token);

if ($data === $_SESSION['email']) {
    $dbh = dbConnect();

    if ($dbh) {
        $userId = $_SESSION['user_id'];

        $selectStatement = $dbh->prepare("SELECT * FROM address WHERE user_id = :userId");
        $selectStatement->bindParam(':userId', $userId);
        $selectStatement->execute();
        $readOneUserAddresses = $selectStatement->fetchAll(\PDO::FETCH_ASSOC);
        echo json_encode($readOneUserAddresses);

    } else {
        echo "Error during db connection.";
    }

} else {
    echo "No valid token found.";
}
