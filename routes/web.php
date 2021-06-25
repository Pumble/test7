<?php

use App\Http\Controllers\AttributeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Models\Product;
use App\Models\Attribute;

/*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | contains the "web" middleware group. Now create something great!
    |
*/

Route::get('/', function () {
    return view('layout.layout');

    /*
    // OBTENER LOS ATRIBUTOS DE UNA CATEGORIA
    $Categories = Category::select([
        'id',
        'name'
    ])
        ->with([
            'attributes:id,name'
        ])->get();
    // dd($Categories->toArray());

    $Products = Product::select([
        'id',
        'name'
    ])->with([
        'templates:id,category_id,attribute_id,type',
        'templates.attribute:id,group_id,name',
        'templates.attribute.group:id,name'
    ])->get();
    // dd($Products->toArray());

    // OBTENER ATRIBUTOS DE UN PRODUCTO
    $Attributes = Attribute::select([
        'attributes.id',
        'attributes.group_id',
        'attributes.name',
        'templates.type',
        'template_values.value'
    ])->with([
        'group:id,name'
    ])->join('templates', 'attributes.id', '=', 'templates.attribute_id')
        ->join('template_values', 'templates.id', '=', 'template_values.template_id')
        ->join('products', 'template_values.product_id', '=', 'products.id')
        ->where('products.id', 1)
        ->get();
    // dd($Attributes->toArray());

    // CATEGORIAS Y SUB-CATEGORIAS
    $Categories = Category::select([
        'id',
        'category_id',
        'name'
    ])->with([
        'father:id,category_id,name'
    ])->get();
    // dd($Categories->toArray());

    // PRODUCTOS X CATEGORIA, CON SUB CATEGORIA
    $ProductsByCategory = Category::select([
        'id',
        'category_id',
        'name'
    ])->with([
        'subCategories:id,category_id,name',
        'subCategories.products:id,category_id,name',
        'products:id,category_id,name'
    ])->whereNull('category_id')
        ->get();
    dd($ProductsByCategory->toArray());

    */
});
/*
    Route::prefix('admin')->group(function () {
        Route::prefix('attributes')->group(function () {
            Route::get('/', [AttributeController::class, 'index'])->name('admin.attributes.index');
        });

        Route::prefix('categories')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('admin.categories.index');
            Route::get('/{id}', [CategoryController::class, 'detail'])->name('admin.categories.detail');
            Route::post('edit/{id}', [CategoryController::class, 'edit'])->name('admin.categories.edit');
        });

        Route::prefix('groups')->group(function () {
            Route::get('/', [GroupController::class, 'index'])->name('admin.groups.index');
        });

        Route::prefix('menus')->group(function () {
            Route::get('/', [MenuController::class, 'index'])->name('admin.menus.index');
            Route::get('/{id}', [MenuController::class, 'detail'])->name('admin.menus.detail');
            Route::post('edit/{id}', [MenuController::class, 'edit'])->name('admin.menus.edit');
        });

        Route::prefix('products')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('admin.products.index');
        });

        Route::prefix('templates')->group(function () {
            Route::get('/', [TemplateController::class, 'index'])->name('admin.templates.index');
        });

        Route::prefix('users')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('admin.users.index');
        });
    });
*/