<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenuItem;
use Illuminate\Support\Facades\Route;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $internal = "/admin/";

        MenuItem::insert([
            [
                'menu_id' => 1,
                'name' => 'Atributos',
                'route' => $internal . "attributes"
            ],
            [
                'menu_id' => 1,
                'name' => 'Categorias',
                'route' => $internal . "categories"
            ],
            [
                'menu_id' => 1,
                'name' => 'Grupos',
                'route' => $internal . "groups"
            ],
            [
                'menu_id' => 1,
                'name' => 'Menus',
                'route' => $internal . "menus"
            ],
            [
                'menu_id' => 1,
                'name' => 'Productos',
                'route' => $internal . "products"
            ],
            [
                'menu_id' => 1,
                'name' => 'Plantillas',
                'route' => $internal . "templates"
            ],
            [
                'menu_id' => 1,
                'name' => 'Usuarios',
                'route' => $internal . "users"
            ]
        ]);
    }
}
