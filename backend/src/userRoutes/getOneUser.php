<?php

require '../../databaseConnect.php';

$dbh = dbConnect();

if ($dbh) {
    // print_r($_SESSION);

    if (isset($_GET['id'])) {
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $selectStatement = $dbh->prepare("SELECT * FROM user WHERE user_id = :id");
        $selectStatement->bindParam(':id', $id);
        $selectStatement->execute();
        $readOneUser = $selectStatement->fetchAll(\PDO::FETCH_ASSOC);
        echo json_encode($readOneUser);
    }

    if (isset($_SESSION) && !empty($_SESSION)) {
        session_start();
        $email = $_SESSION['email'];

        $selectStatement = $dbh->prepare("SELECT * FROM user WHERE email = :email");
        $selectStatement->bindParam(':email', $email);
        $selectStatement->execute();
        $readOneUser = $selectStatement->fetchAll(\PDO::FETCH_ASSOC);
        echo json_encode($readOneUser);
    } /* else {
    echo 'chips';
}
// Check if the cookie is received in the request
if (isset($_SERVER['HTTP_COOKIE'])) {
    // Get the value of the cookie
    $cookieValue = $_SERVER['HTTP_COOKIE'];
    // Output the received cookie value
    echo "Received cookie value: " . $cookieValue;
} else {
    echo "No cookie received in the request.";
}  */
} else {
    echo "Error during db connection.";
}
