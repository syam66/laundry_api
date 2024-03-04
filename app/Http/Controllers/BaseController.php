<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Exists;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Validation\ValidatesRequests;

class BaseController
{
    use ValidatesRequests;

    protected $service;

    function __construct(BaseService $service)
    {
        $this->service = $service;
    }

    public function index($id = null)
    {
        if($id)
        {
            $data = $this->service->find($id);
        } else {
            $data = $this->service->all();
        }

        if($data === null)
        {
            return [
                'code' => 0,
                'message' => 'Data not found.'
            ];
        }

        return [
            'code' => 1,
            'message' => 'Succcess get all data',
            'data' => $data,
        ];
    }

    public function beforeCreate($request){}
    public function afterCreate($data){}

    public function create(Request $request)
    {
        DB::beginTransaction();

        try
        {
            $this->beforeCreate($request);

            $data = $this->service->create($request->all());

            DB::commit();

            $this->afterCreate($data);
            return response()->json(['message' => 'Data successfully created', 'data' => $this->service->find($data)], 200);
        } catch (ValidationException $e) {
            DB::rollBack();
            return response()->json(['message' => 'Validation failed', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to create data', 'error' => $e->getMessage()], 500);
        }

    }

    public function beforeUpdate($request){}
    public function afterUpdate($data){}

    public function update($id, Request $request)
    {
        DB::beginTransaction();

        try
        {
            $this->beforeUpdate($request);
            $data = $this->service->update($id, $request->all());

            DB::commit();

            $this->afterUpdate($data);
            return response()->json(['message' => 'Data successfully updated', 'data' => $this->service->find($id)], 200);
        } catch (ValidationException $e) {
            DB::rollBack();
            return response()->json(['message' => 'Validation failed', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to create data', 'error' => $e->getMessage()], 500);
        }
    }

    public function delete($id)
    {
        $data = $this->service->delete($id);
        return response()->json([
            'code' => 1,
            'message' => 'Data successfully deleted'
        ]);
    }

}
