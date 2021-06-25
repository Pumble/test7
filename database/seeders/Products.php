<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class Products extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::insert([
            // CPU
            ['name' => 'AMD RYZEN 5 3600X', 'category_id' => 7],
            ['name' => 'INTEL CORE I3 10105F', 'category_id' => 8],

            // Tarjetas madre
            ['name' => 'ASROCK A520M-HDV', 'category_id' => 2],
            ['name' => 'GIGABYTE A520M DS3H', 'category_id' => 2],

            // RAM
            ['name' => 'PATRIOT VIPER ELITE II 8 GB DDR4 3200', 'category_id' => 3],
            ['name' => 'ADATA XPG SPECTRIX D50 8 GB DDR4 3200 WHITE', 'category_id' => 3],

            // Tarjetas de video
            ['name' => 'ASUS GEFORCE GTX 1650 PHOENIX OC 4 GB', 'category_id' => 4],
            ['name' => 'MSI GEFORCE RTX 3070 VENTUS 2X OC 8 GB', 'category_id' => 4],

            // Almacenamiento
            ['name' => 'KINGSTON A400 240 GB', 'category_id' => 12],
            ['name' => 'ADATA FALCON 1 TB', 'category_id' => 11],

            // Fuentes de poder
            ['name' => 'BITFENIX BPA 600W 80 PLUS', 'category_id' => 6],
            ['name' => 'COOLER MASTER MWE GOLD 750 V2 - 80 PLUS GOLD', 'category_id' => 6],
        ]);
    }
}
