<?php

namespace App\Repositories\Master;

use App\Repositories\BaseModelRepository;
use Spatie\Permission\Models\Permission;

class PermissionRepository extends BaseModelRepository
{
    function __construct(Permission $model)
    {
        $this->model = $model;
    }
}
