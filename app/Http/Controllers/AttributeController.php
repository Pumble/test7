<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attribute;

class AttributeController extends Controller
{
    /* === API === */
    function search(Request $request)
    {
        if ($request->ajax()) {
            $Attributes = Attribute::select([
                'id',
                'group_id',
                'name'
            ])->where('name', 'like', "%$request->search%")
                ->get();
            return response()->json($Attributes);
        }
    }
}
