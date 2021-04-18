<?php


namespace Database\Factories;


use App\Models\News;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    protected $model = News::class;

    public function definition()
    {
        static $reduce = 999;

        return [
            'title' => $this->faker->words(3,true),
            'body' => $this->faker->text('100'),
            'created_at' => \Carbon\Carbon::now()->subSeconds($reduce--),
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}