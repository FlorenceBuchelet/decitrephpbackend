<?php

require '../../databaseConnect.php';
require "../userRoutes/sessionHandling.php";

sessionHandling();

$productId = isset($_GET['productId']) ? $_GET['productId'] : '';

unset($_SESSION['cart'][$productId]);
