<?php

namespace Database\Seeders;

use App\Models\RcompraProducto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RcompraProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RcompraProducto::factory(100)->create();
    }
}
