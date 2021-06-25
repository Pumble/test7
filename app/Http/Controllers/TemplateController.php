<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class TemplateController extends Controller
{
    /*
        Route::get('/', [TemplateController::class, 'search'])->name('api.admin.templates.get');
        Route::get('/{category:id}', [TemplateController::class, 'get'])->name('api.admin.templates.get');
        Route::post('/', [TemplateController::class, 'post'])->name('api.admin.templates.post');
        Route::put('/', [TemplateController::class, 'put'])->name('api.admin.templates.put');
        Route::delete('/{category:id}', [TemplateController::class, 'delete'])->name('api.admin.templates.delete');
    */

    /* === API === */
    function search(Request $request)
    {
        if ($request->ajax()) {
            $Categories = Category::select([
                'id',
                'category_id',
                'name'
            ])->with([
                'templates:id,category_id,attribute_id,type'
            ])->where('name', 'like', "%$request->search%")
                ->get();
            return response()->json($Categories);
        }
    }

    function get(Category $category, Request $request)
    {
        if ($request->ajax()) {
            $category->load([
                'templates:id,category_id,attribute_id,type',
                'templates.attribute:id,name'
            ]);
            return response()->json($category);
        }
    }

    function post(Request $request)
    {
        if ($request->ajax()) {
            $request->validate([
                'category_id' => ['nullable', 'numeric', 'exists:categories,id'],
                'name' => ['string', 'required']
            ]);
            $Category = new Category;
            $Category->name = $request->name;
            $Category->category_id = $request->category_id;
            $Category->save();
        }
    }

    function put(Request $request)
    {
        if ($request->ajax()) {
            $request->validate([
                'id' => ['numeric', 'required'],
                'category_id' => ['nullable', 'numeric', 'exists:categories,id'],
                'name' => ['string', 'required']
            ]);
            $Category = Category::findOrFail($request->id);
            $Category->name = $request->name;
            $Category->category_id = $request->category_id;
            $Category->save();
        }
    }

    function delete(Category $category, Request $request)
    {
        if ($request->ajax()) {
            $category->delete();
        }
    }
}
