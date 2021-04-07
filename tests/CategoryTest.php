<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use MongoDB\BSON\ObjectID as MongoId;

class CategoryTest extends TestCase
{
    protected $token;
    protected $mId = '51b14c2de8e185801f000006';

    protected function setUp(): void
    {
        parent::setUp();

        $email = env('INITIAL_USER_EMAIL');
        $password = env('INITIAL_USER_PASSWORD');

        $this->post('/api/login', ['email' => $email, 'password' => $password]);
        $decodedResponse = json_decode($this->response->getContent(), true);
        $this->token = $decodedResponse['token'];
    }

    public function testIndex()
    {
        $this->get('/api/categories', ['Authorization' => 'Bearer '.$this->token]);
        $this->assertTrue(is_array(json_decode($this->response->getContent(), true)));
        $this->assertEquals(200, $this->response->getStatusCode());
    }

    public function testRequiredFieldsForCreate()
    {
        $this->post('/api/categories', [], ['Authorization' => 'Bearer '.$this->token])->seeJson(['name' => ['The name field is required.']]);
    }

    public function testCreate()
    {
        $id = new MongoId($this->mId);
        $this->post('/api/categories', ['_id' => $id, 'name' => 'Steve Rogers'], ['Authorization' => 'Bearer '.$this->token])->seeJson(['Category successfully created!']);
    }

    public function testRequiredFieldsForUpdate()
    {
        $id = new MongoId($this->mId);
        $this->put('/api/categories/'.$id, [], ['Authorization' => 'Bearer '.$this->token])->seeJson(['name' => ['The name field is required.']]);
    }

    public function testUpdate()
    {
        $id = new MongoId($this->mId);
        $this->put('/api/categories/'.$id, ['name' => 'Sam Wilson'], ['Authorization' => 'Bearer '.$this->token])->seeJson(['Category successfully updated!']);
    }

    public function testDelete()
    {
        $id = new MongoId($this->mId);
        $this->delete('/api/categories/'.$id, [], ['Authorization' => 'Bearer '.$this->token])->seeJson(['Category sucessfully deleted!']);
    }

    protected function tearDown(): void
    {
        $this->post('/api/logout', [], ['Authorization' => 'Bearer '.$this->token]);
        $this->token = null;
        parent::tearDown();
    }
}
