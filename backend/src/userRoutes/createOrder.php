<?php

require '../services/databaseConnect.php';

$dbh = dbConnect();

if ($dbh) {
    $userId = isset($_POST['user_id']) ? trim($_POST['user_id']) : '';
    $addressLabel = isset($_POST['address_label']) ? trim($_POST['address_label']) : '';

    $insertStatement = $dbh->prepare(
        "SELECT user.email FROM user
        WHERE user.email = :email;"
    );
    $insertStatement->bindParam(':userId', $userId);
    $insertStatement->bindParam(':addressLabel', $addressLabel);

    $insertStatement->execute();
    $readEmail = $selectStatement->fetch(\PDO::FETCH_ASSOC);

    if (empty($readEmail)) {
        $insertUserStatement = $dbh->prepare(
            "INSERT INTO user (gender, firstname, lastname, email) VALUES
            (:gender,:firstname, :lastname, :email);"
        );
        $insertUserStatement->bindParam(':email', $email);
        $insertUserStatement->bindParam(':gender', $gender);
        $insertUserStatement->bindParam(':firstname', $firstname);
        $insertUserStatement->bindParam(':lastname', $lastname);
        $insertUserStatement->execute();

        $insertAuthStatement = $dbh->prepare(
            "INSERT INTO authentication (password, user_id) VALUES
            (:password, LAST_INSERT_ID());"
        );
        $insertAuthStatement->bindParam(':password', $password);
        $insertAuthStatement->execute();
    } else {
        echo 'Email already in use';
    }
} else {
    echo 'Error during db connection';
}