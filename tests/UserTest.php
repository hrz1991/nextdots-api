<?php

use Laravel\Lumen\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExistsAdminUser()
    {
        $this->seeInDatabase('users', ['email' => 'rhector773@gmail.com']);
    }
}
