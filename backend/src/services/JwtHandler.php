<?php
// This is JwtHandler.php
require "../../vendor/autoload.php";

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtHandler
{
    protected $secret;
    protected $issuedAt;
    protected $expire;

    function __construct()
    {
        // set default time-zone
        date_default_timezone_set('Europe/Paris');
        $this->issuedAt = time();
        // Token Validity (3600 second = 1hr)
        $this->expire = $this->issuedAt + 3600;
        $this->secret = $_ENV['SECRET_KEY'];
    }

    public function encode($iss, $data)
    {
        $token = array(
            "iss" => $iss, // Issuer of the token
            "aud" => $iss, // Audience
            "iat" => $this->issuedAt, // Token issuance timestamp
            "exp" => $this->expire, // Token expiration timestamp
            "data" => $data // Payload
        );
        return JWT::encode($token, $this->secret, 'HS256');
    }

    public function decode($token)
    {
        try {
            $decode = JWT::decode($token, new Key($this->secret, 'HS256'));
            return $decode->data;
        } catch (Exception $e) {
            // If decoding fails
            return $e->getMessage();
        }
    }
}