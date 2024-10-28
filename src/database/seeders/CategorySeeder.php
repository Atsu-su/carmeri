<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (! Category::exists()) {
            Category::insert([
                [
                    'category_name' => 'ファッション',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'category_name' => '家電',
                    'created_at' => now(),
                    'updated_at' => now(),],
                [
                    'category_name' => 'インテリア',
                    'created_at' => now(),
                    'updated_at' => now(),],
                [
                    'category_name' => 'レディース',
                    'created_at' => now(),
                    'updated_at' => now(),],
                [
                    'category_name' => 'メンズ',
                    'created_at' => now(),
                    'updated_at' => now(),],
                [
                    'category_name' => 'コスメ',
                    'created_at' => now(),
                    'updated_at' => now(),],
                [
                    'category_name' => '本',
                    'created_at' => now(),
                    'updated_at' => now(),],
                [
                    'category_name' => 'ゲーム',
                    'created_at' => now(),
                    'updated_at' => now(),],
                [
                    'category_name' => 'スポーツ',
                    'created_at' => now(),
                    'updated_at' => now(),],
                [
                    'category_name' => 'キッチン',
                    'created_at' => now(),
                    'updated_at' => now(),],
                [
                    'category_name' => 'ハンドメイド',
                    'created_at' => now(),
                    'updated_at' => now(),],
                [
                    'category_name' => 'アクセサリー',
                    'created_at' => now(),
                    'updated_at' => now(),],
                [
                    'category_name' => 'おもちゃ',
                    'created_at' => now(),
                    'updated_at' => now(),],
                [
                    'category_name' => 'ベビー・キッズ',
                    'created_at' => now(),
                    'updated_at' => now(),],
            ]);
        }
    }
}
