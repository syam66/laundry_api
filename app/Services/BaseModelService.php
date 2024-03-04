<?php

namespace App\Services;

use App\Repositories\BaseModelRepository;

class BaseModelService
{
    protected $repo;

    function __construct(BaseModelRepository $repo)
    {
        $this->repo = $repo;
    }

    public function all()
    {
        return $this->repo->all();
    }

    public function findById($id)
    {
        return $this->repo->findById($id);
    }

    public function find($role)
    {
        return $this->repo->find($role);
    }

    public function create($role)
    {
        return $this->repo->create($role);
    }

    public function update($role, $name)
    {
        $data = $this->find($role);
        return $this->repo->update($data, $name);
    }

    public function delete($name)
    {
        return $this->repo->delete($name);
    }
}
