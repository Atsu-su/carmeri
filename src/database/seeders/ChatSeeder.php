<?php

namespace Database\Seeders;

use App\Models\Chat;
use App\Models\Item;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (! Chat::exists()) {
            $faker = Faker::create('ja_JP');

            for($i = 1; $i <= 3; ++$i ) {
                $item = Item::find($i);

                for ($j = 0; $j < 3; ++$j) {
                    // 購入者
                    Chat::insert([
                        [
                            'item_id' => $i,
                            'sender_id' => $i + 1,
                            'buyer_id' => $i + 1,
                            'message' => $faker->realText(100),
                            'is_read' => false,
                        ],
                    ]);

                    // 出品者
                    Chat::insert([
                        [
                            'item_id' => $i,
                            'sender_id' => $item->seller_id,
                            'buyer_id' => $i + 1,
                            'message' => $faker->realText(100),
                            'is_read' => false,
                        ],
                    ]);
                }
            }
        }
    }
}
