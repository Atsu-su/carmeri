<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (! Item::exists()) {
            Item::factory(10)->create();
            Item::factory(10)->notOnSale()->create();
          }
    }
}
