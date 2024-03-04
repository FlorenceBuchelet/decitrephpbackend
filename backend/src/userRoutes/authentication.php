<?php
use Firebase\JWT\JWT;
session_start();

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
        // Add JWT
        $secret_key = $_ENV['SECRET_KEY'];
        $date = new DateTimeImmutable();
        $expire_at = $date->modify('+6 minutes')->getTimestamp();
        $domainName = "http://localhost:5173/";
        $userEmail = $readAuth[0]['email'];
        $payload = [
            'iat' => $date->getTimestamp(),
            'iss' => $domainName,
            'nbf' => $date->getTimestamp(),
            'exp' => $expire_at,
            'userEmail' => $userEmail,
        ];
        $JWT = JWT::encode($payload, $secret_key, 'HS512');
        setcookie("JWT", $JWT, [
            'expires' => $expire_at,
            'path' => '/',
            'domain' => $domainName,
            'secure' => false,
            'httponly' => false,
            'samesite' => 'Lax',
        ]);
        // Populate session
        $_SESSION['email'] = $readAuth[0]['email'];
        $_SESSION['cart'] = array();
        $_SESSION['cartTotalPrice'] = 0;
    } else {
        echo 'No matching account';
    }
} else {
    echo 'Error during db connection';
}
