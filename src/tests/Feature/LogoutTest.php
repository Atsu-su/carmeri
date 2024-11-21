<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Stringable;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_ログアウト成功()
    {
        $this->login();
        $response = $this->from('/')
            ->post('/logout');

        $response->assertStatus(302)
            ->assertRedirect('/');
    }
}