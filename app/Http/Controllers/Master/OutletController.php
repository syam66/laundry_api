<?php

namespace App\Http\Controllers\Master;

use Illuminate\Validation\Rule;
use App\Services\Master\OutletService;
use App\Http\Controllers\BaseController;

class OutletController extends BaseController
{
    function __construct(OutletService $service)
    {
        $this->service = $service;
    }

    public function beforeCreate($request)
    {
        $rules = [
            'code'      => [
                'required',
                Rule::unique('moutlets', 'code')->whereNull('deleted_at')
            ],
            'name'      => 'required',
        ];

        $message = [
            'code.required' => 'Kode outlet wajib diisi.',
            'code.unique' => 'Kode outlet sudah digunakan.',
            'name.required' => 'Nama outlet wajib diisi.',
        ];

        $request->validate($rules, $message);

        $request['created_at'] = now()->format('Y-m-d h:i:s');
        $request['created_by'] = auth()->user()->name;
    }

    public function beforeUpdate($request)
    {
        $rule = [
            'code'      => [
                'required',
                Rule::unique('moutlets', 'code')->ignore($request->id)->whereNull('deleted_at')
            ],
            'name'      => 'required',
        ];

        $messages = [
            'code.required' => 'Kode outlet wajib diisi.',
            'code.unique' => 'Kode outlet sudah digunakan.',
            'name.required' => 'Nama outlet wajib diisi.',
        ];

        $request->validate($rule, $messages);

        $request['updated_at'] = now()->format('Y-m-d h:i:s');
        $request['updated_by'] = auth()->user()->name;
    }
}
