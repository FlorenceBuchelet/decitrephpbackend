<?php

require '../services/sessionHandling.php';

sessionHandling();

// Send the total to frontend
echo json_encode($_SESSION['cart']['quantity']);
