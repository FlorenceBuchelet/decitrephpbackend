<?php

require "../userRoutes/sessionHandling.php";

sessionHandling();

// Unset all session variables
$_SESSION = [];

// Destroy the session
session_destroy();

// Clean tous les aspects du cookie et le détruit en le faisant se terminer dans le passé
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

setcookie(
    'JWT',
    '',
    time() - 42000,
    $params["path"],
    $params["domain"],
    $params["secure"],
    $params["httponly"]
);

echo 'disconnected';
