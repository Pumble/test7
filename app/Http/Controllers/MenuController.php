<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\MenuItem;

class MenuController extends Controller
{
    function index()
    {
        $Menus = Menu::select([
            'id',
            'name'
        ])->get();
        return view('menus.index', compact('Menus'));
    }

    function detail($id, Request $request)
    {
        $Menu = Menu::select([
            'id',
            'name'
        ])->with([
            'items:id,menu_id,menu_item_id,name,route'
        ])->findOrFail($id);

        $Menus = Menu::select([
            'id',
            'menu_id',
            'name'
        ])->where('menu_id', $Menu->id);

        return view('menus.detail', compact('Menu', 'Menus'));
    }

    function edit($id, Request $request)
    {
        try {
            $Menu = Menu::findOrFail($id);
            $Menu->name = $request->name;
            $Menu->save();

            $Items = array_map(function ($item, $i) use ($Menu) {
                return [
                    'id' => $i,
                    'name' => $item['name'],
                    'route' => $item['route'],
                    'menu_id' => $Menu->id,
                    'menu_item_id' => $Menu['menu_item_id'] == '-Ninguna-' ? null : $Menu['menu_item_id']
                ];
            }, $request->items, array_keys($request->items));

            MenuItem::insertOrIgnore($Items);

            $Menus = Menu::select([
                'id',
                'menu_id',
                'name'
            ])->where('menu_id', $Menu->id);

            return view('menus.detail', [
                'Menu' => $Menu,
                'Menus' => $Menus
            ]);
        } catch (\Exception $e) {
            return response($e->getMessage(), 500);
        }
    }
}
