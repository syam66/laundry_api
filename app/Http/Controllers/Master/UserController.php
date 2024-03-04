<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\BaseController;
use App\Services\BaseService;

class UserController extends BaseController
{
    function __construct(BaseService $service)
    {
        $this->service = $service;
    }

    public function beforeCreate($request)
    {
        $request->validate([
            'name'      => 'required',
            'username'  => 'required|unique:users,username',
            'password'  => 'required|confirmed',
        ], [
            'name.required'                     => 'Nama harus diisi',
            'username.required'                 => 'Username harus diisi',
            'username.unique:users,username'    => 'Username sudah digunakan',
            'password.required'                 => 'Password harus diisi',
            'password confirmed'                => 'Password tidak sama'
        ]);

        $request->created_at = now()->format('Y-m-d h:i:s');
        $request->created_by = auth()->user()->name;
    }

    public function beforeUpdate($request)
    {
        $request->validate([
            'name'      => 'required',
            'username'  => 'required|unique:users,username,' . $request->id,
            'password'  => 'required|confirmed',
        ], [
            'name.required'                                     => 'Nama harus diisi',
            'username.required'                                 => 'Username harus diisi',
            'username.unique:users,username,' . $request->id    => 'Username sudah digunakan',
            'password.required'                                 => 'Password harus diisi',
            'password confirmed'                                => 'Password tidak sama'
        ]);

        $request->updated_at = now()->format('Y-m-d h:i:s');
        $request->updated_by = auth()->user()->name;
    }
}
