<?php

namespace App\Services\Master;

use App\Repositories\Master\UserRepository;
use App\Services\BaseService;

class UserService extends BaseService
{
    function __construct(UserRepository $repo)
    {
        $this->repo = $repo;
    }
}
