<?php

namespace Database\Factories;

use App\Models\Articel;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
     protected $model = Article::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {   
        

        return [
                 'title' => $this->faker->unique()->sentence,
            'user_id' => User::inRandomOrder()->first()->id, // generates a new user
            'category_id' => Category::inRandomOrder()->first()->id,
            'body' => $this->faker->paragraph(5),
            'thumbnail' => $this->faker->imageUrl(640, 480, 'news', true, 'Article'),
              'views' => $this->faker->numberBetween(0, 5000),
        ];
    }
}
