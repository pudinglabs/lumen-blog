<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use MongoDB\BSON\ObjectID as MongoId;

class CategoryTest extends TestCase
{
    protected $mId = '51b14c2de8e185801f000006';

    public function testIndex()
    {
        $this->get('/api/category');
        $this->assertTrue(is_array(json_decode($this->response->getContent(), true)));
        $this->assertEquals(200, $this->response->getStatusCode());
    }

    public function testRequiredFieldsForCreate()
    {
        $this->post('/api/category', [])->seeJson(['name' => ['The name field is required.']]);
    }

    public function testCreate()
    {
        $id = new MongoId($this->mId);
        $this->post('/api/category', ['_id' => $id, 'name' => 'Steve Rogers'])->seeJson(['Category successfully created!']);
    }

    public function testRequiredFieldsForUpdate()
    {
        $id = new MongoId($this->mId);
        $this->put('/api/category/'.$id, [])->seeJson(['name' => ['The name field is required.']]);
    }

    public function testUpdate()
    {
        $id = new MongoId($this->mId);
        $this->put('/api/category/'.$id, ['name' => 'Sam Wilson'])->seeJson(['Category successfully updated!']);
    }

    public function testDelete()
    {
        $id = new MongoId($this->mId);
        $this->delete('/api/category/'.$id)->seeJson(['Category sucessfully deleted!']);
    }
}
