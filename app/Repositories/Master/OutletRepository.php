<?php

namespace App\Repositories\Master;

use App\Repositories\BaseRepository;

class OutletRepository extends BaseRepository
{
    function __construct()
    {
        $this->table = 'moutlets';
    }
}
