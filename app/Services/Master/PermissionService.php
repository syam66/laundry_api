<?php

namespace App\Services\Master;

use App\Services\BaseModelService;
use App\Repositories\Master\PermissionRepository;

class PermissionService extends BaseModelService
{
    protected $repo;

    function __construct(PermissionRepository $repo)
    {
        $this->repo = $repo;
    }
}
