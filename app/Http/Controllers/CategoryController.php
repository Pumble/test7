<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /* === API === */
    function search(Request $request)
    {
        if ($request->ajax()) {
            $SQL = Category::select([
                'id',
                'category_id',
                'name'
            ]);
            if ($request->father == "true") {
                $SQL->with([
                    'father:id,category_id,name'
                ]);
            }
            $Categories = $SQL->get();
            return response()->json($Categories);
        }
    }

    function get(Category $category, Request $request)
    {
        if ($request->ajax()) {
            $category->load('father:id,category_id,name');
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
