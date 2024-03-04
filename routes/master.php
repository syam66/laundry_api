<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Master\UserController;
use App\Http\Controllers\Master\OutletController;
use App\Http\Controllers\Master\HeadOfficeController;
use App\Http\Controllers\Master\PermissionController;

Route::group(['prefix' => 'master'], function(){

    # Head Office
    Route::group(['prefix' => 'ho'], function (){
        Route::get('/', [HeadOfficeController::class, 'index']);
        Route::get('/{id}', [HeadOfficeController::class, 'index']);
        Route::post('/create', [HeadOfficeController::class, 'create']);
        Route::post('/{id}/update', [HeadOfficeController::class, 'update']);
        Route::post('/{id}/delete', [HeadOfficeController::class, 'delete']);
    });

    # Outlet Office
    Route::group(['prefix' => 'outlet'], function (){
        Route::get('/', [OutletController::class, 'index']);
        Route::get('/{id}', [OutletController::class, 'index']);
        Route::post('/create', [OutletController::class, 'create']);
        Route::post('/{id}/update', [OutletController::class, 'update']);
        Route::post('/{id}/delete', [OutletController::class, 'delete']);
    });
});
