<?php

require '../services/JwtHandler.php';
require "../services/sessionHandling.php";
require "../services/cartHandling.php";
require_once "../class/User.php";
require_once "../factory/UserFactory.php";

use Products\UserFactory;

sessionHandling();
cartHandling();

$dbh = dbConnect();

if ($dbh) {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    $selectStatement = $dbh->prepare(
        "SELECT user.*, authentication.password FROM user
        JOIN authentication ON user.user_id = authentication.user_id
        WHERE user.email = :email AND authentication.password = :password;"
    );
    $selectStatement->bindParam(':email', $email);
    $selectStatement->bindParam(':password', $password);
    $selectStatement->execute();
    $readAuth = $selectStatement->fetchAll(\PDO::FETCH_ASSOC);

    // why doesn't the if under this comment work?
    if ($readAuth) {
        $oneUser = $readAuth[0];
        $newUser = UserFactory::createUserFromDatabase(
            (int) $oneUser['user_id'],
            (string) $oneUser['gender'],
            (string) $oneUser['firstname'],
            (string) $oneUser['lastname'],
            (string) $oneUser['email'],
        );
    }

    var_dump($newUser->getEmail());
    if (isset($readAuth) && !empty($readAuth)) {
        // Add JWT
        $jwt = new JwtHandler();
        $payload = $newUser->getEmail();
        $token = $jwt->encode("http://decitrephpbackend/backend/", $payload);
        setcookie("JWT", $token);
        // Populate session
        $_SESSION['email'] = $newUser->getEmail();
        $_SESSION['user_id'] = $newUser->getUserId();

        // Associate cart_id and user_id in database
        $insertStatement = $dbh->prepare(
            "UPDATE cart SET user_id = :userId WHERE cart_id = :cartId"
        );
        $newUserId = $newUser->getUserId();
        $insertStatement->bindParam(':userId', $newUserId);
        $insertStatement->bindParam(':cartId', $_SESSION['cart_id']['cart_id']);
        $insertStatement->execute();
        echo 'Redirect to cart';
    } else {
        echo 'No matching account';
    }
} else {
    echo 'Error during db connection';
}
