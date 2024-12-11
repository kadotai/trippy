<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Prefecture;

class PrefectureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Prefecture::insert([
                ['id' => 1, 'prefecture_name' => "Hokkaido"],
                ['id' => 2, 'prefecture_name' => "Aomori"],
                ['id' => 3, 'prefecture_name' => "Iwate"],
                ['id' => 4, 'prefecture_name' => "Miyagi"],
                ['id' => 5, 'prefecture_name' => "Akita"],
                ['id' => 6, 'prefecture_name' => "Yamagata"],
                ['id' => 7, 'prefecture_name' => "Fukushima"],
                ['id' => 8, 'prefecture_name' => "Ibaraki"],
                ['id' => 9, 'prefecture_name' => "Tochigi"],
                ['id' => 10, 'prefecture_name' => "Gunma"],
                ['id' => 11, 'prefecture_name' => "Saitama"],
                ['id' => 12, 'prefecture_name' => "Chiba"],
                ['id' => 13, 'prefecture_name' => "Tokyo"],
                ['id' => 14, 'prefecture_name' => "Kanagawa"],
                ['id' => 15, 'prefecture_name' => "Niigata"],
                ['id' => 16, 'prefecture_name' => "Toyama"],
                ['id' => 17, 'prefecture_name' => "Ishikawa"],
                ['id' => 18, 'prefecture_name' => "Fukui"],
                ['id' => 19, 'prefecture_name' => "Yamanashi"],
                ['id' => 20, 'prefecture_name' => "Nagano"],
                ['id' => 21, 'prefecture_name' => "Gifu"],
                ['id' => 22, 'prefecture_name' => "Shizuoka"],
                ['id' => 23, 'prefecture_name' => "Aichi"],
                ['id' => 24, 'prefecture_name' => "Mie"],   
                ['id' => 25, 'prefecture_name' =>  "Shiga"],
                ['id' => 26, 'prefecture_name' => "Kyoto"],
                ['id' => 27, 'prefecture_name' => "Osaka"],
                ['id' => 28, 'prefecture_name' => "Hyogo"],
                ['id' => 29, 'prefecture_name' => "Nara"],
                ['id' => 30, 'prefecture_name' => "Wakayama"],
                ['id' => 31, 'prefecture_name' => "Tottori"],        
                ['id' => 32, 'prefecture_name' => "Shimane"],
                ['id' => 33, 'prefecture_name' => "Okayama"],
                ['id' => 34, 'prefecture_name' => "Hiroshima"],
                ['id' => 35, 'prefecture_name' => "Yamaguchi"],
                ['id' => 36, 'prefecture_name' => "Tokushima"],
                ['id' => 37, 'prefecture_name' => "Kagawa"],
                ['id' => 38, 'prefecture_name' => "Ehime"],
                ['id' => 39, 'prefecture_name' => "Kochi"],
                ['id' => 40, 'prefecture_name' => "Fukuoka"],
                ['id' => 41, 'prefecture_name' => "Saga"],
                ['id' => 42, 'prefecture_name' => "Nagasaki"],
                ['id' => 43, 'prefecture_name' => "Kumamoto"],
                ['id' => 44, 'prefecture_name' => "Oita"],
                ['id' => 45, 'prefecture_name' => "Miyazaki"],
                ['id' => 46, 'prefecture_name' => "Kagoshima"],
                ['id' => 47, 'prefecture_name' => "Okinawa"],
                ['id' => 48, 'prefecture_name' => "null"],
        ]);

    }
}
