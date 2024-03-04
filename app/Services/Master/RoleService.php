<?php

namespace App\Services\Master;

use App\Repositories\Master\RoleRepository;
use App\Services\BaseModelService;

class RoleService extends BaseModelService
{
    protected $repo;

    function __construct(RoleRepository $repo)
    {
        $this->repo = $repo;
    }
}
