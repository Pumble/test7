<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class Categories extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::insert([
            ['name' => 'CPU', 'category_id' => null],
            ['name' => 'Tarjetas madre', 'category_id' => null],
            ['name' => 'RAM', 'category_id' => null],
            ['name' => 'Tarjetas de video', 'category_id' => null],
            ['name' => 'Almacenamiento', 'category_id' => null],
            ['name' => 'Fuentes de poder', 'category_id' => null],

            // SUB CATEGORIAS CPU
            ['name' => 'AMD', 'category_id' => 1],
            ['name' => 'Intel', 'category_id' => 1],

            // SUB CATEGORIA RAM
            ['name' => 'Laptop', 'category_id' => 3],

            // SUB CATEGORIA RAM
            ['name' => 'HDD', 'category_id' => 5],
            ['name' => 'SSD', 'category_id' => 5],
            ['name' => 'Memoria Flash', 'category_id' => 5],
            ['name' => 'Disco externo', 'category_id' => 5],
            ['name' => 'Unidades DVD', 'category_id' => 5],
        ]);
    }
}
