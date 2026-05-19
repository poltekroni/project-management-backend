<?php

use App\Http\Controllers\API\authcontroller;
use App\Http\Controllers\API\projectcontroller;
use App\Http\Controllers\API\taskcontroller;
use App\Http\Controllers\API\testcontroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('test', [testcontroller::class, 'index']);

route::apiResource('projects', projectcontroller::class)->middleware('auth:sanctum');
route::apiResource('tasks', taskcontroller::class)->middleware('auth:sanctum');


Route::post('/register',[authcontroller::class, 'register']);// register API
Route::post('/login',[authcontroller::class, 'login']); //  login API
Route::post('/logout',[authcontroller::class, 'logout'])->middleware('auth:sanctum'); //  logout API