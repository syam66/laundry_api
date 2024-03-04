<?php

namespace App\Repositories;

class BaseModelRepository
{
    protected $model;

    function __construct()
    {
        $this->model = '';
    }

    public function all()
    {
        return $this->model::all();
    }

    public function create($name)
    {
        return $this->model::create(['name' => $name]);
    }

    public function findById($id)
    {
        return $this->model::findById($id);
    }

    public function find($name)
    {
        return $this->model::findByName($name);
    }

    public function update($old, $name)
    {
        return $old->update(['name' => $name]);
    }

    public function delete($name)
    {
        return $name->delete();
    }
}
