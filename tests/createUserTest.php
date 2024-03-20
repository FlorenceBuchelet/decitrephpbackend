<?php

use PHPUnit\Framework\TestCase;

// This test checks if the "Email already in use" message is sent
// it needs CORS headers disabled in databaseConnect to run
class CreateUserTest extends TestCase {
    public function testCreateUserRoute() {
        // POST request
        $_POST['email'] = 'fbuchelet@decitre.fr';

        // Tested file
        require_once __DIR__ . '/../backend/src/userRoutes/createUser.php';

        // Expected output
        $this->expectOutputString('Email already in use');
    }
}
