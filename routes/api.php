<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Models\Category;

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

Route::prefix('admin')->group(function () {
    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'search'])->name('api.admin.categories.get');
        Route::get('/{category:id}', [CategoryController::class, 'get'])->name('api.admin.categories.get');
        Route::post('/', [CategoryController::class, 'post'])->name('api.admin.categories.post');
        Route::put('/', [CategoryController::class, 'put'])->name('api.admin.categories.put');
        Route::delete('/{category:id}', [CategoryController::class, 'delete'])->name('api.admin.categories.delete');
    });
});
