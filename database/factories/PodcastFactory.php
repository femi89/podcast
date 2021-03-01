<?php

namespace Database\Factories;

use App\Models\Podcast;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PodcastFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Podcast::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'audio_url' => $this->faker->text(255),
            'size' => $this->faker->word,
            'description' => $this->faker->sentence(15),
            'title' => $this->faker->sentence(10),
            'album_id' => \App\Models\Album::factory(),
        ];
    }
}
