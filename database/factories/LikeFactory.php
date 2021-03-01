<?php

namespace Database\Factories;

use App\Models\Like;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class LikeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Like::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'podcast_id' => \App\Models\Podcast::factory(),
            'guest_id' => \App\Models\Guest::factory(),
        ];
    }
}
