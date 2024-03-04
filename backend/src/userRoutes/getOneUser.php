<?php
use Firebase\JWT\Key;

if (isset($_COOKIE['PHPSESSID'])) {
    session_id($_COOKIE['PHPSESSID']);
    session_start();
}

require '../../databaseConnect.php';

// var_dump($_COOKIE);
/* 
use Firebase\JWT\JWT;

// Fonction de validation du JWT
function validateJWT($jwt)
{
    $secret_key = $_ENV['SECRET_KEY'];

    try {
        var_dump($jwt);
        $decodedJWT = JWT::decode($jwt, new Key($secret_key, 'HS512'));
        var_dump($decodedJWT);
        return $decodedJWT;
    } catch (Exception $e) {
        // If the JWT is invalid
        echo "Error: " . $e->getMessage();
        return null;
    }
}


if (isset($_COOKIE['JWT'])) {
    $jwt = $_COOKIE['JWT'];
    $decodedJWT = validateJWT($jwt);

    if ($decodedJWT) { */
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
/*         
    } else {
        echo "No valid token found.";
    }
} */