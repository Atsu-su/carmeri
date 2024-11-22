<?php

namespace Tests\Feature;

use App\Models\Condition;
use App\Models\Item;
use App\Models\Like;
use App\Models\User;
use Database\Seeders\ConditionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Stringable;
use Tests\TestCase;

class MyListTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_お気に入り商品表示()
    {
        // Arrange
        Schema::disableForeignKeyConstraints();

        $firstItem = Item::factory()->create(['seller_id' => 10]);
        $secondItem = Item::factory()->create(['seller_id' => 20]);
        $user = $this->login();

        Like::factory()->create(
            [
                'user_id' => $user->id,
                'item_id' => $secondItem->id,
            ]
        );

        // Act
        $response = $this->get('/');

        // Assert
        $response->assertStatus(200)
            ->assertSeeInOrder([
                '<div class="tab first-tab">',
                $firstItem->name,
                '<div class="tab second-tab js-hidden">',
            ], false)
            ->assertSeeInOrder([
                '<div class="tab second-tab js-hidden">',
                $secondItem->name,
            ], false);

        Schema::enableForeignKeyConstraints();
    }

    public function test_未ログイン時商品非表示()
    {
        // Arrange
        Schema::disableForeignKeyConstraints();

        Item::factory(3)->create();

        // Act
        $response = $this->get('/');

        // Assert
        $response->assertStatus(200)
            ->assertSeeInOrder([
                '<div class="tab second-tab js-hidden">',
                'ログイン</a>後に表示されます',
            ], false);

        Schema::enableForeignKeyConstraints();
    }
}
