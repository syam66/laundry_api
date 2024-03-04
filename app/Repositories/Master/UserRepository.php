<?php

namespace App\Repositories\Master;

use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository
{
    function __construct()
    {
        $this->table = 'users';
    }
}
