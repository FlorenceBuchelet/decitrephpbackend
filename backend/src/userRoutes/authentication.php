<?php

require '../../databaseConnect.php';

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
        ini_set('session.cookie_lifetime', 3600); // Durée de vie de 1 heure (en secondes)
        session_start();
        $_SESSION['email'] = $readAuth[0]['email'];
        $_SESSION['cart'] = [];
        
        // print_r($_SESSION);
    } else {
        echo 'No matching account';
    }
} else {
    echo 'Error during db connection';
}
