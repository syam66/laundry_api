<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Repositories\BaseRepository;
use Illuminate\Validation\ValidationException;

class BaseService
{
    protected $repo;

    function __construct(BaseRepository $repo)
    {
        $this->repo = $repo;
    }

    public function all()
    {
        return $this->repo->all();
    }

    public function find($id)
    {
        return $this->repo->find($id);
    }

    public function create($data)
    {
        return $this->repo->create($data);

    }

    public function update($id, $data)
    {
        return $this->repo->update($id, $data);
    }

    public function delete($id)
    {
        return $this->repo->delete($id);
    }
}
