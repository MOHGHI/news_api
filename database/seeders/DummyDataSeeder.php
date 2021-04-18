<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DummyDataSeeder extends Seeder
{

    protected $totalUsers = 20;

    protected $totalNews = 30;

    public function run(\Faker\Generator $faker)
    {
        \App\Models\User::factory()->count($this->totalUsers)->create();
        \App\Models\News::factory()->count($this->totalNews)->create();

        $news = \App\Models\News::all();
        \App\Models\User::all()->each(function ($user) use ($news){
            $user->news()->saveMany(
                $news->random(rand(1,3))
            );
        });

    }
}
