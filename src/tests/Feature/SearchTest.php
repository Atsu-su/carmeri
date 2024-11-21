<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Stringable;
use Tests\TestCase;

class SearchTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_検索された商品が表示()
    {
        $item = Item::factory()->create([
            'seller_id' => 1,
            'on_sale' => true,
            'name' => 'abcdefg',
            'price' => 1000,
            'brand' => 'snail',
            'condition_id' => '1',
            'description' => 'this is not fake.',
            'image' => 'image.jpg',
        ]);

        $response = $this->from('/')
            ->post('/', [
                'keyword' => 'cd',
            ]);

        $response->assertStatus(302)
            ->assertRedirect('/');

        $this->followRedirects($response)
            ->assertSee('abcdefg');
    }

    // public function test_パスワード未入力()
    // {
    //     $response = $this->from('/login')
    //         ->post('/login', [
    //                 'password' => '',
    //         ]);

    //     $response->assertStatus(302)
    //         ->assertRedirect('/login');

    //     $this->followRedirects($response)
    //         ->assertSee('パスワードを入力してください');
    // }

    // public function test_認証失敗()
    // {
    //     $user = User::factory()->create();

    //     // パスワードが間違っている
    //     $response = $this->from('/login')
    //         ->post('/login', [
    //                 'email' => $user->email,
    //                 'password' => 'aaaaaaaa',
    //         ]);

    //     $response->assertStatus(302)
    //         ->assertRedirect('/login');

    //     $this->followRedirects($response)
    //         ->assertSee('ログイン情報が登録されていません');

    //     // メールアドレスが間違っている
    //     $response = $this->from('/login')
    //     ->post('/login', [
    //             'email' => 'aaaa@aaaa.com',
    //             'password' => 'password',
    //     ]);

    //     $response->assertStatus(302)
    //         ->assertRedirect('/login');

    //     $this->followRedirects($response)
    //         ->assertSee('ログイン情報が登録されていません');
    // }

    // public function test_認証成功()
    // {
    //     $user = User::factory()->create();

    //     $response = $this->from('/login')
    //         ->post('/login', [
    //                 'email' => $user->email,
    //                 'password' => 'password',
    //         ]);

    //     $response->assertStatus(302)
    //         ->assertRedirect('/');

    //     $this->assertAuthenticated();
    // }
}
