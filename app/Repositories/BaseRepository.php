<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class BaseRepository implements BaseRepositoryInterface
{
    // model property on class instances
    protected $model;

    // Constructor to bind model to repo
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    // Get all instances of model
    public function all()
    {
        return $this->model->all();
    }

    // Get a record based on primary key
    public function find($id)
    {
        return $this->model->find($id);
    }

    // create a new record in the database
    public function create(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new \Exception($e);
        }
    }

    // update record in the database
    public function update(array $data, $id)
    {
        $record = $this->find($id);

        try {
            return $record->update($data);
        } catch (QueryException $e) {
            throw new \Exception($e);
        }
    }

    // remove record from the database
    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    // show the record with the given id
    public function show($id)
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new \Exception($e);
        }
    }

    // Get the associated model
    public function getModel()
    {
        return $this->model;
    }

    // Set the associated model
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    // Eager load database relationships
    public function with($relations)
    {
        return $this->model->with($relations);
    }
}
