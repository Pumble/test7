<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TemplateValue;

class TemplatesValues extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TemplateValue::insert([
            // AMD RYZEN 5 3600X
            [
                'template_id' => 1,
                'product_id' => 1,
                'value' => json_encode(['value' => 95]),
            ],
            [
                'template_id' => 2,
                'product_id' => 1,
                'value' => json_encode(['value' => '7nm']),
            ],
            [
                'template_id' => 3,
                'product_id' => 1,
                'value' => json_encode(['value' => 10]),
            ],
            [
                'template_id' => 4,
                'product_id' => 1,
                'value' => json_encode(['value' => 10]),
            ],
            [
                'template_id' => 5,
                'product_id' => 1,
                'value' => json_encode(['value' => '4.4 GHZ']),
            ],
            [
                'template_id' => 6,
                'product_id' => 1,
                'value' => json_encode(['value' => 6]),
            ],
            [
                'template_id' => 7,
                'product_id' => 1,
                'value' => json_encode(['value' => 12]),
            ],
            [
                'template_id' => 8,
                'product_id' => 1,
                'value' => json_encode(['value' => '3/32 MB (L2/L3)']),
            ],
            [
                'template_id' => 9,
                'product_id' => 1,
                'value' => json_encode(['value' => 'AM4']),
            ],
            [
                'template_id' => 10,
                'product_id' => 1,
                'value' => json_encode(['value' => 95]),
            ],
        ]);
    }
}
