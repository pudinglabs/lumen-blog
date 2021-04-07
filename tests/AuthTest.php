<?php

use Faker\Generator;
use Illuminate\Container\Container;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use MongoDB\BSON\ObjectID as MongoId;

class AuthTest extends TestCase
{
    public function testRegister()
    {
        $faker = Container::getInstance()->make(Generator::class);
        $password = env('INITIAL_USER_PASSWORD');

        $this->post('/api/register', [
            'name' => $faker->name,
            'email' => $faker->unique()->safeEmail,
            'password' => $password,
            'password_confirmation' => $password,
        ])->seeStatusCode(201)->seeJson(['message' => 'Created']);
    }

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

    /**
     * @depends testLogin
     */
    public function testCheck($token)
    {
        $this->post('/api/check', [], ['Authorization' => 'Bearer '.$token])->seeStatusCode(200)->seeJson(['message' => 'Ok']);
    }

    /**
     * @depends testLogin
     */
    public function testRefresh($token)
    {
        $this->post('/api/refresh', [], ['Authorization' => 'Bearer '.$token])->seeStatusCode(200)->seeJsonStructure([
            'message', 'data',
        ]);
    }
}
