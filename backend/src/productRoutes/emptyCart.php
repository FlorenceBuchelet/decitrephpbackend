<?php

require '../services/sessionHandling.php';

sessionHandling();

unset($_SESSION['cart']);
$_SESSION['cart'] = array();
// Send the empty cart back to frontend
echo json_encode($_SESSION['cart']);
