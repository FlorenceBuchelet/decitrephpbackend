<?php

// FIXME: update route
require './services/databaseConnect.php';
require './src/Models/userModel.php';

$dbh = dbConnect();


$URI = getOneUser();

