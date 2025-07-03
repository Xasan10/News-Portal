<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            
            'article_id'=> Article::inRandomOrder()->first()->id,
            'media_url' => $this->faker->randomElement([
                'https://youtu.be/xjWKAkByZ80?si=fddHJaG7Nj9X_atf',
                'https://youtu.be/xGvxL2r2J7Q?si=pJK2_bDqQcfdsRs-',
                'https://youtu.be/Qchzc7TvRXk?si=WAX1j1YxAE1R5nDk',
                'https://youtu.be/Oa0ZHfcalCM?si=Axo7EvCrXUfbLTzE',
                'https://youtu.be/GZvn8RJrVqs?si=-Qybjs0QB_wSntDR',
                'https://youtu.be/LkIS4DpRPHY?si=Q--XQk2kDY_Xq25o',
            ]),
            'file_type' => 'video',
            'caption'=>$this->faker->optional()->sentence(),
              'created_at' => now(),





        ];
    }
}
