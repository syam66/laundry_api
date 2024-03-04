<?php

namespace App\Http\Controllers\Master;

use App\Services\Master\PermissionService;
use App\Http\Controllers\BaseModelController;

class PermissionController extends BaseModelController
{
    protected $service;

    function __construct(PermissionService $service)
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
            'old.required'  => 'Nama permission lama harus diisi',
            'name.required' => 'Nama permission baru harus diisi'
        ];

        $request->validate($roles, $message);
    }
}
