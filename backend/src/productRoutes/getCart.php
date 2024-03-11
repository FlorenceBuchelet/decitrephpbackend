<?php

require_once '../class/Product.php';
require_once '../factory/ProductFactory.php';
require '../services/sessionHandling.php';

sessionHandling();


// Send the cart to frontend
echo json_encode($_SESSION['cart']);
