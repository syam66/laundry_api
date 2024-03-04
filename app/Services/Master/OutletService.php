<?php

namespace App\Services\Master;

use App\Repositories\Master\OutletRepository;
use App\Services\BaseService;

class OutletService extends BaseService
{
    function __construct(OutletRepository $repo)
    {
        $this->repo = $repo;
    }
}
