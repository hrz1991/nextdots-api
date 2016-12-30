<?php

use App\Priority;

use Laravel\Lumen\Testing\DatabaseTransactions;

class PriorityTest extends TestCase
{

    protected $_params;

    public function __construct()
    {
        $this->_params = [
            'email' => 'rhector773@gmail.com',
            'password' => '123456'
        ];
    }

    public function testPostPriority()
    {
        $_response = $this->call('POST', '/auth/login', $this->_params);
        $_json = json_decode($_response->getContent()); 

        $_response = $this->call('POST', 'priorities', [
            "name"    => "Test"
        ], [], [], [
            'HTTP_AUTHORIZATION' => "Bearer ".$_json->token
        ]);

        $this->assertResponseOk();
    }

    public function testPostPriorityWithoutToken()
    {
        $_response = $this->call('POST', 'priorities', [
            "name"    => "Test"
        ], [], [], []);

        $this->assertResponseStatus(401);
    }

    public function testPostPriorityWithoutName()
    {
        $_response = $this->call('POST', '/auth/login', $this->_params);
        $_json = json_decode($_response->getContent()); 

        $_response = $this->call('POST', 'priorities', [], [], [], [
            'HTTP_AUTHORIZATION' => "Bearer ".$_json->token
        ]);

        $this->assertResponseStatus(422);
    }
}
