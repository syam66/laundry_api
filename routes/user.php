<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Master\RoleController;
use App\Http\Controllers\Master\UserController;
use App\Http\Controllers\Master\PermissionController;

Route::group(['prefix' => 'users'], function(){
    Route::get('/', [UserController::class, 'index']);

    Route::group(['prefix' => 'role'], function (){
        Route::get('/', [RoleController::class, 'index']);
        Route::get('/{id}', [RoleController::class, 'index']);
        Route::post('/create', [RoleController::class, 'create']);
        Route::post('/update', [RoleController::class, 'update']);
        Route::post('/{id}/delete', [RoleController::class, 'delete']);
    });

    Route::group(['prefix' => 'permission'], function (){
        Route::get('/', [PermissionController::class, 'index']);
        Route::get('/{id}', [PermissionController::class, 'index']);
        Route::post('/create', [PermissionController::class, 'create']);
        Route::post('/update', [PermissionController::class, 'update']);
        Route::post('/{id}/delete', [PermissionController::class, 'delete']);
    });
});
