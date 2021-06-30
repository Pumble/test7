<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\TemplateValue;

class ProductController extends Controller
{
    /* === API === */
    function search(Request $request)
    {
        if ($request->ajax()) {
            $SQL = Product::select([
                'id',
                'category_id',
                'name'
            ]);
            if ($request->category == "true") {
                $SQL->with([
                    'category:id,name'
                ]);
            }
            $Products = $SQL->where('name', 'like', "%$request->search%")
                ->get();
            return response()->json($Products);
        }
    }

    function get(Product $product, Request $request)
    {
        if ($request->ajax()) {
            $product->load('category:id,name');
            if ($request->templateValues == "true") {
                $product->load([
                    'templates:id,attribute_id,type',
                    'templates.attribute:id,name',
                ]);
            }
            return response()->json($product);
        }
    }

    function post(Request $request)
    {
        if ($request->ajax()) {
            $request->validate([
                'category_id' => ['nullable', 'numeric', 'exists:categories,id'],
                'name' => ['string', 'required'],
                'templateValues' => ['array', 'required']
            ]);
            $Product = new Product;
            $Product->name = $request->name;
            $Product->category_id = $request->category_id;
            $Product->save();

            $data = [];
            foreach ($request->templateValues as $tv) {
                $data[] = [
                    'template_id' => $tv['template_id'],
                    'product_id' => $Product->id,
                    'value' => json_encode($tv['jsonValue'])
                ];
            }
            TemplateValue::insert($data);
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
            Product::where('id', $request->id)
                ->update([
                    'name' => $request->name,
                    'category_id' => $request->category_id
                ]);
            foreach ($request->templates as $tv) {
                TemplateValue::where('id', $tv['id'])
                    ->update([
                        'value' => json_encode($tv['value'])
                    ]);
            }
        }
    }

    function delete(Product $product, Request $request)
    {
        if ($request->ajax()) {
            $product->delete();
        }
    }
}
