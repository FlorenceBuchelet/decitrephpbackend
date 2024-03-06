<?php

require '../../databaseConnect.php';
require "../../JwtHandler.php";
require "../userRoutes/sessionHandling.php";

sessionHandling();

$token = $_COOKIE['JWT'];
$jwt = new JwtHandler();
$data = $jwt->decode($token);


if ($data === $_SESSION['email']) {
    $dbh = dbConnect();

    if ($dbh) {
        $email = $_SESSION['email'];

        $selectStatement = $dbh->prepare("SELECT * FROM user WHERE email = :email");
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
