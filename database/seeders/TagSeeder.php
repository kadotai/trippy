<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tag::insert([
            [
                'tag_name' => 'アクティビティ'
            ],
            [
                'tag_name' => 'グルメ'
            ],
            [
                'tag_name' => 'ローカルフード'
            ],
            [
                'tag_name' => 'カフェ'
            ],
            [
                'tag_name' => 'スイーツ'
            ],
            [
                'tag_name' => 'ホテル'
            ],
            [
                'tag_name' => '歴史'
            ],
            [
                'tag_name' => '買い物'
            ],
            [
                'tag_name' => '自然'
            ],
            [
                'tag_name' => '世界遺産'
            ],
            [
                'tag_name' => '夜景'
            ],
            [
                'tag_name' => 'ひとり旅'
            ],
            [
                'tag_name' => '映え'
            ]
            ]);
    }
}
