<?php

require_once '../class/Product.php';
require_once '../factory/ProductFactory.php';
require '../userRoutes/sessionHandling.php';

sessionHandling();

// Send the cart to frontend
echo json_encode($_SESSION['cart']);
