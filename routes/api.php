<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertiesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::resource('properties',App\Http\Controllers\PropertiesController::class)->only(['index','store','show','update','destroy']);
Route::get('lists/{id?}',[PropertiesController::class, 'lists'])->name('lists');
Route::post('create',[PropertiesController::class, 'create'])->name('lists_create');
Route::post('update/{id}',[PropertiesController::class, 'update'])->name('lists_update');
Route::delete('delete/{id}',[PropertiesController::class, 'delete'])->name('lists_delete');
