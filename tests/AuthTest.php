<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use MongoDB\BSON\ObjectID as MongoId;

class AuthTest extends TestCase
{
    public function testLogin()
    {
        $email = env('INITIAL_USER_EMAIL');
        $password = env('INITIAL_USER_PASSWORD');

        $this->post('/api/login', ['email' => $email, 'password' => $password])->seeStatusCode(200)->seeJsonStructure([
            'token', 'token_type', 'expires_in',
        ]);

        $decodedResponse = json_decode($this->response->getContent(), true);

        return $decodedResponse['token'];
    }

    /**
     * @depends testLogin
     */
    public function testLogout($token)
    {
        $this->post('/api/logout', [], ['Authorization' => 'Bearer '.$token])->seeStatusCode(200)->seeJson(['message' => 'Logged off successfully!']);
    }
}
