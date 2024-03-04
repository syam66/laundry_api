<?php

namespace App\Http\Controllers\Master;

use Illuminate\Validation\Rule;
use App\Http\Controllers\BaseController;
use App\Services\Master\HeadOfficeService;

class HeadOfficeController extends BaseController
{
    function __construct(HeadOfficeService $service)
    {
        $this->service = $service;
    }

    public function beforeCreate($request)
    {
        $rule = [
            'code'      => [
                'required',
                Rule::unique('mhead_offices', 'code')->whereNull('deleted_at')
            ],
            'name'      => 'required',
            'images'      => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'owner'     => 'required',
            'address'   => 'required',
            'city'      => 'required',
            'contact'   => 'required',
            'lead'      => 'required',
        ];

        $messages = [
            'code.required' => 'Kode outlet wajib diisi.',
            'code.unique' => 'Kode outlet sudah digunakan.',
            'name.required' => 'Nama outlet wajib diisi.',
            'images.required' => 'Logo outlet wajib diunggah.',
            'images.image' => 'File logo harus berupa gambar.',
            'images.mimes' => 'File logo harus berformat JPG, JPEG, atau PNG.',
            'images.max' => 'Ukuran file logo tidak boleh lebih dari 2MB.',
            'owner.required' => 'Nama pemilik wajib diisi.',
            'address.required' => 'Alamat wajib diisi.',
            'city.required' => 'Kota wajib diisi.',
            'contact.required' => 'Kontak wajib diisi.',
            'lead.required' => 'Pimpinan wajib diisi.',
        ];

        $request->validate($rule, $messages);

        $request['created_at'] = now()->format('Y-m-d h:i:s');
        $request['created_by'] = auth()->user()->name;

        if($request->hasFile('images'))
        {
            $file = $request->file('images');
            $path = $file->store('ho');
            $request['logo'] = $path;
        }
    }

    public function beforeUpdate($request)
    {
        $rule = [
            'code'      => [
                'required',
                Rule::unique('mhead_offices', 'code')->ignore($request->id)->whereNull('deleted_at')
            ],
            'name'      => 'required',
            // 'logo'      => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'owner'     => 'required',
            'address'   => 'required',
            'city'      => 'required',
            'contact'   => 'required',
            'lead'      => 'required',
        ];

        $messages = [
            'code.required' => 'Kode outlet wajib diisi.',
            'code.unique' => 'Kode outlet sudah digunakan.',
            'name.required' => 'Nama outlet wajib diisi.',
            // 'logo.required' => 'Logo outlet wajib diunggah.',
            'logo.image' => 'File logo harus berupa gambar.',
            'logo.mimes' => 'File logo harus berformat JPG, JPEG, atau PNG.',
            'logo.max' => 'Ukuran file logo tidak boleh lebih dari 2MB.',
            'owner.required' => 'Nama pemilik wajib diisi.',
            'address.required' => 'Alamat wajib diisi.',
            'city.required' => 'Kota wajib diisi.',
            'contact.required' => 'Kontak wajib diisi.',
            'lead.required' => 'Pimpinan wajib diisi.',
        ];

        $request->validate($rule, $messages);

        $request['updated_at'] = now()->format('Y-m-d h:i:s');
        $request['updated_by'] = auth()->user()->name;

        if($request->hasFile('images'))
        {
            $file = $request->file('images');
            $path = $file->store('ho');
            $request['logo'] = $path;
        }
    }
}
