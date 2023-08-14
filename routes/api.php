<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\TagsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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



Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::put('edit/{id}', 'edit');
});

Route::controller(CategoriesController::class)->group(function () {
    Route::get('Categories', 'index');
    Route::post('Category_store', 'store');
    Route::put('Category_update/{id}', 'update');
    Route::delete('Category_delete/{id}', 'destroy');
});
Route::controller(TagsController::class)->group(function () {
    Route::get('Tags', 'index');
    Route::post('Tag_store', 'store');
    Route::put('Tag_update/{id}', 'update');
    Route::delete('Tag_delete/{id}', 'destroy');
});
