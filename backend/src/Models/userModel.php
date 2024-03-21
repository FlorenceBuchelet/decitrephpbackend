<?php

require '../services/databaseConnect.php';
require "../services/JwtHandler.php";
require "../services/sessionHandling.php";

sessionHandling();

function getOneUser()
{
    $token = $_COOKIE['JWT'];
    $jwt = new JwtHandler();
    $data = $jwt->decode($token);

    try {
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

    } catch (Exception $e) {
        die ('Error: ' . $e->getMessage());
    }
}

