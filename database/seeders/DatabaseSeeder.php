<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            Groups::class,
            Categories::class,
            Attributes::class,
            Products::class,
            Templates::class,
            TemplatesValues::class,
            MenuSeeder::class,
            MenuItemSeeder::class
        ]);
    }
}
