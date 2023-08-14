<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\PostsController;
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
#Request must be from User who has Admin role only
Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::controller(CategoriesController::class)->group(function () {
        Route::get('Categories', 'index');
        Route::post('Category_store', 'store');
        Route::put('Category_update/{id}', 'update');
        Route::delete('Category_delete/{id}', 'destroy');
    });
    Route::controller(PostsController::class)->group(function () {
        Route::get('Posts', 'index');
        Route::get('Posts/{id}', 'show');
    });

    Route::delete('Tag_delete/{id}', [TagsController::class, 'destroy']);
});

#Request must be from User who has Author role only
Route::group(['middleware' => ['auth', 'author']], function () {
    Route::post('Post_store', [PostsController::class, 'store']);
    Route::delete('Post_delete/{id}', [PostsController::class, 'destroy']);
    Route::put('Post_update/{id}', [PostsController::class, 'update']);
    Route::post('Tag_store', [TagsController::class, 'store']);
    Route::put('Tag_update/{id}', [TagsController::class, 'update']);
});

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::put('edit/{id}', 'edit');
});


Route::get('Tags', [TagsController::class, 'index']);
