<?php

require '../../databaseConnect.php';

$dbh = dbConnect();

if ($dbh) {
    session_start();
    session_destroy();
    echo 'disconnected';
} else {
    echo 'Error during db connection';
}
;
