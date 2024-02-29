<?php

if (isset($_COOKIE['PHPSESSID'])) {
    session_id($_COOKIE['PHPSESSID']);
    session_start();
}

require '../../databaseConnect.php';

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
