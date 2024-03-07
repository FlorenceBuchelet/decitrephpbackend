<?php

namespace Products;

use Products\User;

class UserFactory
{
    public static function createUserFromDatabase(
        int $userId,
        string $gender,
        string $firstname,
        string $lastname,
        string $email,
    ): User {
        $user = new User();
        $user->setUserId($userId);
        $user->setGender($gender);
        $user->setFirstname($firstname);
        $user->setLastname($lastname);
        $user->setEmail($email);
        return $user;
    }
}
