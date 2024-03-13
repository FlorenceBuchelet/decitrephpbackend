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
        $email = $_SESSION['email'];

        $selectStatement = $dbh->prepare("SELECT address.*, user.* FROM user 
            LEFT JOIN address ON user.user_id = address.user_id 
            WHERE user.email = :email");
        $selectStatement->bindParam(':email', $email);
        $selectStatement->execute();
        $readOneUser = $selectStatement->fetchAll(\PDO::FETCH_ASSOC);
        echo json_encode($readOneUser);

    } else {
        echo "Error during db connection.";
    }

} else {
    echo "No valid token found.";
}
