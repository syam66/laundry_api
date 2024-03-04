<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\BaseModelController;
use App\Services\Master\RoleService;

class RoleController extends BaseModelController
{
    protected $service;

    function __construct(RoleService $service)
    {
        $this->service = $service;
    }

    public function beforeCreate($request)
    {
        $roles = [
            'name' => 'required',
        ];

        $message = [
            'name.required' => 'Nama role harus diisi'
        ];

        $request->validate($roles, $message);
    }

    public function beforeUpdate($request)
    {
        $roles = [
            'old'   => 'required',
            'name'  => 'required',
        ];

        $message = [
            'old.required'  => 'Nama role lama harus diisi',
            'name.required' => 'Nama role baru harus diisi'
        ];

        $request->validate($roles, $message);
    }
}
