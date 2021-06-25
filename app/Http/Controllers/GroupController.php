<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;

class GroupController extends Controller
{
    /* === API === */
    function search(Request $request)
    {
        if ($request->ajax()) {
            $SQL = Group::select([
                'id',
                'name'
            ]);
            if ($request->attributes == 'true') {
                $SQL->with([
                    'attributes:id,group_id,name'
                ]);
            }
            $Groups = $SQL->where('name', 'like', "%$request->search%")
                ->get();
            return response()->json($Groups);
        }
    }
}
