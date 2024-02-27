<?php

require '../../databaseConnect.php';

$dbh = dbConnect();

if ($dbh) {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $gender = "Mme";
    $firstname = isset($_POST['firstname']) ? trim($_POST['firstname']) : '';
    $lastname = isset($_POST['lastname']) ? trim($_POST['lastname']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    print_r($gender);
    $selectStatement = $dbh->prepare(
        "SELECT user.email FROM user
        WHERE user.email = :email;"
    );
    $selectStatement->bindParam(':email', $email);
    $selectStatement->execute();
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