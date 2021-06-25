<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Template;

class Templates extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Template::insert([
            // PARA CPU
            [
                'category_id' => 1,
                'attribute_id' => 1,
                'type' => 'Float'
            ],
            [
                'category_id' => 1,
                'attribute_id' => 2,
                'type' => 'String'
            ],
            [
                'category_id' => 1,
                'attribute_id' => 3,
                'type' => 'Float'
            ],
            [
                'category_id' => 1,
                'attribute_id' => 4,
                'type' => 'Float'
            ],
            [
                'category_id' => 1,
                'attribute_id' => 5,
                'type' => 'String'
            ],
            [
                'category_id' => 1,
                'attribute_id' => 6,
                'type' => 'String'
            ],
            [
                'category_id' => 1,
                'attribute_id' => 7,
                'type' => 'Number'
            ],
            [
                'category_id' => 1,
                'attribute_id' => 8,
                'type' => 'String'
            ],
            [
                'category_id' => 1,
                'attribute_id' => 9,
                'type' => 'String'
            ],
            [
                'category_id' => 1,
                'attribute_id' => 10,
                'type' => 'Float'
            ],

            // PARA TARJETAS MADRE
            [
                'category_id' => 2,
                'attribute_id' => 12,
                'type' => 'String'
            ],
            [
                'category_id' => 2,
                'attribute_id' => 13,
                'type' => 'String'
            ],
            [
                'category_id' => 2,
                'attribute_id' => 14,
                'type' => 'String'
            ],
            [
                'category_id' => 2,
                'attribute_id' => 15,
                'type' => 'String'
            ],

            // PARA RAM
            [
                'category_id' => 3,
                'attribute_id' => 16,
                'type' => 'Number'
            ],
            [
                'category_id' => 3,
                'attribute_id' => 17,
                'type' => 'Number'
            ],
            [
                'category_id' => 3,
                'attribute_id' => 18,
                'type' => 'Number'
            ],

            // PARA GPU
            [
                'category_id' => 4,
                'attribute_id' => 19,
                'type' => 'String'
            ],
            [
                'category_id' => 4,
                'attribute_id' => 20,
                'type' => 'String'
            ],
            [
                'category_id' => 4,
                'attribute_id' => 21,
                'type' => 'String'
            ],

            // PARA ALMACENAMIENTO
            [
                'category_id' => 5,
                'attribute_id' => 22,
                'type' => 'Number'
            ],
            [
                'category_id' => 5,
                'attribute_id' => 23,
                'type' => 'String'
            ],
            [
                'category_id' => 5,
                'attribute_id' => 24,
                'type' => 'String'
            ],
            [
                'category_id' => 5,
                'attribute_id' => 25,
                'type' => 'Number'
            ],

            // PARA FUENTES DE PODER
            [
                'category_id' => 6,
                'attribute_id' => 26,
                'type' => 'Number'
            ],
            [
                'category_id' => 6,
                'attribute_id' => 27,
                'type' => 'String'
            ],
            [
                'category_id' => 6,
                'attribute_id' => 28,
                'type' => 'Boolean'
            ]
        ]);
    }
}
