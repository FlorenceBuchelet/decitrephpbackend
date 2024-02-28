<?php

if (isset($_COOKIE['PHPSESSID'])) {
    session_id($_COOKIE['PHPSESSID']);
    session_start();
}
require '../../databaseConnect.php';

$dbh = dbConnect();

if ($dbh) {
    session_destroy();
    echo 'disconnected';
} else {
    echo 'Error during db connection';
}
;
