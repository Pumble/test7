<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Attribute;

class Attributes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Attribute::insert([
            // === ATRIBUTOS GENERALES
            // ENERGIA
            ['name' => 'Voltaje', 'group_id' => 5],
            // DIMENSIONES
            ['name' => 'Contrucción', 'group_id' => 6],
            ['name' => 'Ancho', 'group_id' => 6],
            ['name' => 'Largo', 'group_id' => 6],

            // === ATRIBUTOS POR CATEGORIA
            // ATRIBUTOS PARA CPU
            ['name' => 'Frecuencia', 'group_id' => 1],
            ['name' => 'Cores', 'group_id' => 1],
            ['name' => 'Threads', 'group_id' => 1],
            ['name' => 'Cache', 'group_id' => 1],
            ['name' => 'Socket', 'group_id' => 1],
            ['name' => 'Consumo', 'group_id' => 1],
            ['name' => 'Familia', 'group_id' => 1],

            // ATRIBUTOS PARA TARJETAS MADRE
            ['name' => 'Plataforma', 'group_id' => 1],
            ['name' => 'Chipset', 'group_id' => 1],
            ['name' => 'Formato', 'group_id' => 1],
            ['name' => 'Memoria', 'group_id' => 1],

            // ATRIBUTOS PARA RAM
            ['name' => 'Velocidad', 'group_id' => 1],
            ['name' => 'Capacidad', 'group_id' => 1],
            ['name' => 'Latencia CAS', 'group_id' => 1],

            // TARJETAS DE VIDEO
            ['name' => 'Fabricante', 'group_id' => 1],
            ['name' => 'GPU', 'group_id' => 1],
            ['name' => 'Core Clock', 'group_id' => 1],

            // ALMACENAMIENTO
            ['name' => 'Velocidad de lectura', 'group_id' => 1],
            ['name' => 'Tipo de memoria', 'group_id' => 1],
            ['name' => 'Interfaz', 'group_id' => 1],
            ['name' => 'Velocidad de escritura', 'group_id' => 1],

            // FUENTES DE PODER
            ['name' => 'Poder', 'group_id' => 1],
            ['name' => 'Certificación', 'group_id' => 1],
            ['name' => 'Modular', 'group_id' => 1]
        ]);
    }
}
