<?php
// THIS IS THE OPEN CLASSROOM TRY
declare(strict_types=1);
use Firebase\JWT\JWT;
require_once('../vendor/autoload.php');

function generateJWT($user_id) {
    $key = '1234567890'; 
    $payload = array(
        "user_id" => $user_id,
        "exp" => time() + 3600  // Temps d'expiration du token (1 heure dans cet exemple)
    );
    return JWT::encode($payload, $key);
}
