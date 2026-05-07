<?php

use App\Http\Controllers\API\projectcontroller;
use App\Http\Controllers\API\taskcontroller;
use App\Http\Controllers\API\testcontroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('test', [testcontroller::class, 'index']);

route::apiResource('projects', projectcontroller::class);

route::apiResource('tasks', taskcontroller::class);