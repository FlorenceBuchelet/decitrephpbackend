<?php

// CORS
$allowed_origin = 'http://localhost:5173';
header("Access-Control-Allow-Origin: $allowed_origin");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Specificity, Authorization");
header("Access-Control-Allow-Credentials: true");

function sessionHandling()
{
    // Continue la session de l'utilisateur logué
    if (isset($_COOKIE['PHPSESSID'])) {
        session_id($_COOKIE['PHPSESSID']);
        session_start();
    } else {
        // Start session
        session_start();
        // Populate session
        $_SESSION['cart'] = array();
    }

}