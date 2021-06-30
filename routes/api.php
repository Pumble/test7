<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Models\Category;
use App\Http\Controllers\TemplateController;
use App\Models\Template;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\GroupController;
use App\Models\Product;
use App\Http\Controllers\ProductController;
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

    Route::prefix('templates')->group(function () {
        Route::get('/', [TemplateController::class, 'search'])->name('api.admin.templates.get');
        Route::get('/{category:id}', [TemplateController::class, 'get'])->name('api.admin.templates.get');
        Route::post('/', [TemplateController::class, 'post'])->name('api.admin.templates.post');
        Route::put('/', [TemplateController::class, 'put'])->name('api.admin.templates.put');
        Route::delete('/{category:id}', [TemplateController::class, 'delete'])->name('api.admin.templates.delete');
    });

    Route::prefix('attributes')->group(function () {
        Route::get('/', [AttributeController::class, 'search'])->name('api.admin.attributes.get');
    });

    Route::prefix('groups')->group(function () {
        Route::get('/', [GroupController::class, 'search'])->name('api.admin.groups.get');
    });

    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'search'])->name('api.admin.products.get');
        Route::get('/{product:id}', [ProductController::class, 'get'])->name('api.admin.products.get');
        Route::post('/', [ProductController::class, 'post'])->name('api.admin.products.post');
        Route::put('/', [ProductController::class, 'put'])->name('api.admin.products.put');
        Route::delete('/{product:id}', [ProductController::class, 'delete'])->name('api.admin.products.delete');
    });
});
