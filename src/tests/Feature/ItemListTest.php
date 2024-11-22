<?php

namespace Tests\Feature;

use App\Models\Condition;
use App\Models\Item;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Stringable;
use Tests\TestCase;

class ItemListTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_出品商品非表示()
    {
        // Arrange
        $user = $this->login();
        $condition = Condition::create(['condition' => '新品、未使用']);

        Item::factory()->create(
            [
                'seller_id' => $user->id,
                'on_sale' => true,
                'name' => 'abcdefg',
                'price' => 1000,
                'brand' => 'brand',
                'condition_id' => $condition->id,
                'description' => 'description',
                'image' => 'image.jpg',
            ]
        );

        // Act
        $response = $this->get('/');

        // Assert
        $response->assertStatus(200)
            ->assertDontSee('abcdefg');
    }
}
