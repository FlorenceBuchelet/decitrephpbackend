<?php

require '../services/databaseConnect.php';

function cartHandling()
{
    $dbh = dbConnect();
    if ($dbh) {
        if (!isset($_SESSION['cart_id'])) {
            $insertStatement = $dbh->prepare("INSERT INTO cart VALUES ();");
            $insertStatement->execute();
            $selectStatement = $dbh->prepare("SELECT cart_id FROM cart WHERE cart_id = LAST_INSERT_ID();");
            $selectStatement->execute();
            $readCartId = $selectStatement->fetchAll(\PDO::FETCH_ASSOC);
            $_SESSION["cart_id"] = $readCartId[0];
            var_dump($_SESSION);
        } else {
            var_dump($_SESSION);
            echo "Error in cart handling.";
        }
    } else {
        echo "Error during db connection.";
    }
}
