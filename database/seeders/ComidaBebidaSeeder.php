<?php

namespace Database\Seeders;

use App\Models\ComidaBebida;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComidaBebidaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ComidaBebida::factory(20)->create();
    }
}
