<?php

namespace App\Repositories\Master;

use App\Repositories\BaseRepository;

class HeadOfficeRepository extends BaseRepository
{
    function __construct()
    {
        $this->table = 'mhead_offices';
    }
}
