<?php

require '../services/sessionHandling.php';

sessionHandling();

var_dump($_SESSION);

unset($_SESSION['cart']);
unset($_SESSION['cart_total']);
unset($_SESSION['cart_id']);
$_SESSION['cart'] = array();
// Send the empty cart back to frontend
echo json_encode($_SESSION);
