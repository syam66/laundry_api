<?php

namespace App\Repositories\Master;

use App\Repositories\BaseModelRepository;
use Spatie\Permission\Models\Role;

class RoleRepository extends BaseModelRepository
{
    function __construct(Role $model)
    {
        $this->model = $model;
    }
}
