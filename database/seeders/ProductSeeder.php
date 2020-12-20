<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PrroductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::truncate();
        Product::factory()->count(10)->create();
    }
}
