<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BaseModelService;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class BaseModelController
{
    protected $service;

    function __construct(BaseModelService $service)
    {
        $this->service = $service;
    }

    public function index($id = null)
    {
        if($id)
        {
            $data = $this->service->findById($id);
        } else {
            $data = $this->service->all();
        }

        return response()->json([
            'code' => 1,
            'message' => 'Success',
            'data' => $data
        ]);
    }

    public function beforeCreate($request){}
    public function afterCreate($data){}

    public function create(Request $request)
    {
        DB::beginTransaction();

        try {
            $this->beforeCreate($request);

            $data = $this->service->create($request->name);

            DB::commit();

            $this->afterCreate($data);
            return response()->json(['message' => 'Data successfully created', 'data' => $data], 200);
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

    public function update(Request $request)
    {
        DB::beginTransaction();

        try
        {
            $this->beforeUpdate($request);
            $this->service->update($request->old, $request->name);

            DB::commit();

            $data = $this->service->find($request->name);
            $this->afterUpdate($data);
            return response()->json(['message' => 'Data successfully updated', 'data' => $data], 200);
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
        $name = $this->service->findById($id);
        $this->service->delete($name);

        return response()->json(['message' => 'Data successfully deleted']);
    }
}
