<?php

use Laravel\Lumen\Testing\DatabaseTransactions;

class AuthTest extends TestCase
{
    public function testLoginSuccess()
    {
        $params = [
            'email' => 'rhector773@gmail.com',
            'password' => '123456'
        ];

        $response = $this->call('POST', '/auth/login', $params);
        $this->assertResponseOk();
    }

    public function testLoginFailedWhenPasswdOrEmailAreNull()
    {
        $params = [
            'email' => 'rhector773@gmail.com'
        ];

        $response = $this->call('POST', '/auth/login', $params);
        $this->assertResponseStatus(422);

        $params = [
            'password' => '123456'
        ];

        $response = $this->call('POST', '/auth/login', $params);
        $this->assertResponseStatus(422);
    }
}
