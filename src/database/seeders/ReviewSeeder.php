<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker::create('ja_JP');

      foreach (range(1, 5) as $index) {
          for ($i = 0; $i < 3; ++$i) {
              DB::table('reviews')->insert([
                  'item_id' => $index,
                  'user_id' => $i + $index,
                  'review' => $faker->realText(100),
              ]);
          }
      }
    }
}
