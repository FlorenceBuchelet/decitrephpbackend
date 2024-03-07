<?php

require '../services/databaseConnect.php';
require "../services/sessionHandling.php";

sessionHandling();

$productId = isset($_GET['productId']) ? $_GET['productId'] : '';

unset($_SESSION['cart'][$productId]);
