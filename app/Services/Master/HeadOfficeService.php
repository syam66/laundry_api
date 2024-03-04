<?php

namespace App\Services\Master;

use App\Services\BaseService;
use App\Repositories\Master\HeadOfficeRepository;

class HeadOfficeService extends BaseService
{
    function __construct(HeadOfficeRepository $repo)
    {
        $this->repo = $repo;
    }
}
