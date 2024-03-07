<?php

require '../services/databaseConnect.php';
require '../services/JwtHandler.php';
require "../services/userRoutes/sessionHandling.php";

sessionHandling();

$dbh = dbConnect();

if ($dbh) {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    $selectStatement = $dbh->prepare(
        "SELECT user.email, authentication.password FROM user
        JOIN authentication ON user.user_id = authentication.user_id
        WHERE user.email = :email AND authentication.password = :password;"
    );
    $selectStatement->bindParam(':email', $email);
    $selectStatement->bindParam(':password', $password);
    $selectStatement->execute();
    $readAuth = $selectStatement->fetchAll(\PDO::FETCH_ASSOC);

    if (isset($readAuth) && !empty($readAuth)) {
        // Add JWT
        $jwt = new JwtHandler();
        $payload = $readAuth[0]['email'];
        $token = $jwt->encode("http://decitrephpbackend/backend/", $payload);
        setcookie("JWT", $token, [
            'SameSite' => 'Lax',
        ]);
        // Populate session
        $_SESSION['email'] = $readAuth[0]['email'];
    } else {
        echo 'No matching account';
    }
} else {
    echo 'Error during db connection';
}
