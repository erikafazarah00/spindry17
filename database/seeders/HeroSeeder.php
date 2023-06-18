<?php

namespace Database\Seeders;

use App\Models\Hero;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class HeroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $faker = Faker::create('id_ID');

        // eloquent ORM
        // for($i=1;$i<11;$i++)
        // {
        //     Hero::create([
        //         'title'=> $faker->title,
        //         'subtitle' => $faker->paragraph,
        //         'background' => $faker->image,
        //         'status' => 'hide'
        //     ]);
        // }

        // Jquery DB
        // DB::table('hero')->insert([
        //     'title'=> 'Transformer',
        //     'subtitle' => 'Robot dari planet lain-lain',
        //     'background' => 'transformer.jpeg',
        //     'status' => 'show'
        // ]);
    }
}
