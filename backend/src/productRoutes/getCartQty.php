<?php

require '../services/sessionHandling.php';

sessionHandling();

// Send the total to frontend
if (!isset($_SESSION['cart']['quantity'])) {
    echo '0';
} else {
    echo $_SESSION['cart']['quantity'];
}
