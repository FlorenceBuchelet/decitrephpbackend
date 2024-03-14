<?php

require '../services/databaseConnect.php';
require_once '../class/CartProduct.php';
require_once '../factory/CartProductFactory.php';
require '../services/sessionHandling.php';

sessionHandling();

$dbh = dbConnect();

if ($dbh) {
    $selectStatement = $dbh->prepare("SELECT command.command_id, user.email
        FROM user
        JOIN command ON user.user_id = command.user_id
        WHERE command.user_id = :userId
        ORDER BY command.command_id DESC;
    ");
    $selectStatement->bindParam(':userId', $_SESSION['user_id']);
    $selectStatement->execute();
    $IdAndMail = $selectStatement->fetchAll(\PDO::FETCH_ASSOC);
    echo json_encode($IdAndMail[0]);
} else {
    echo "Error during db connection.";
}
