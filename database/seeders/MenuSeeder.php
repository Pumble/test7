<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::insert([
            ['name' => 'Interno'],
            ['name' => 'Externo'],
            ['name' => 'Footer']
        ]);
    }
}
