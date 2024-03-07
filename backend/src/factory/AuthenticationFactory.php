<?php

namespace Products;

use Products\Authentication;

class AuthenticationFactory
{
    public static function createAuthenticationFromDatabase(
        int $userId,
        string $password,
    ): Authentication {
        $authentication = new Authentication();
        $authentication->setUserId($userId);
        $authentication->setPassword($password);
        return $authentication;
    }
}
