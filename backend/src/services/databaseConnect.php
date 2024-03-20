<?php

require __DIR__ . '/../../vendor/autoload.php';


$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

// Comment this for backend tests
$allowed_origin = 'http://localhost:5173';
header("Access-Control-Allow-Origin: $allowed_origin");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Specificity, Authorization");
header("Access-Control-Allow-Credentials: true");
//

function dbConnect() {
    try {
        $dbh = new \PDO($_ENV['DSN'], $_ENV['USER']);
        return $dbh;
    } catch (\PDOException $exception) {
        return  'Error in connection' . $exception->getMessage();
    }
}


