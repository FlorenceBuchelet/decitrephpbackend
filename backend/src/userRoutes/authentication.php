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

    if (isset($readAuth)) {
        session_start();
        // echo json_encode($readAuth);
/*         $_SESSION['email'] = '$readAuth[0]['email']';
        setcookie('auth', $_SESSION['email'], time() + 300, '/'); // 5min
 */    } else {
        echo 'No matching account';
    }
} else {
    echo 'Error during db connexion';
}