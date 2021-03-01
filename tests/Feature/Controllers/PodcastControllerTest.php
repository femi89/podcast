<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Podcast;

use App\Models\Album;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PodcastControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_podcasts()
    {
        $podcasts = Podcast::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('podcasts.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.podcasts.index')
            ->assertViewHas('podcasts');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_podcast()
    {
        $response = $this->get(route('podcasts.create'));

        $response->assertOk()->assertViewIs('app.podcasts.create');
    }

    /**
     * @test
     */
    public function it_stores_the_podcast()
    {
        $data = Podcast::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('podcasts.store'), $data);

        unset($data['description']);

        $this->assertDatabaseHas('podcasts', $data);

        $podcast = Podcast::latest('id')->first();

        $response->assertRedirect(route('podcasts.edit', $podcast));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_podcast()
    {
        $podcast = Podcast::factory()->create();

        $response = $this->get(route('podcasts.show', $podcast));

        $response
            ->assertOk()
            ->assertViewIs('app.podcasts.show')
            ->assertViewHas('podcast');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_podcast()
    {
        $podcast = Podcast::factory()->create();

        $response = $this->get(route('podcasts.edit', $podcast));

        $response
            ->assertOk()
            ->assertViewIs('app.podcasts.edit')
            ->assertViewHas('podcast');
    }

    /**
     * @test
     */
    public function it_updates_the_podcast()
    {
        $podcast = Podcast::factory()->create();

        $album = Album::factory()->create();

        $data = [
            'audio_url' => $this->faker->text(255),
            'size' => $this->faker->word,
            'description' => $this->faker->sentence(15),
            'title' => $this->faker->sentence(10),
            'album_id' => $album->id,
        ];

        $response = $this->put(route('podcasts.update', $podcast), $data);

        unset($data['description']);

        $data['id'] = $podcast->id;

        $this->assertDatabaseHas('podcasts', $data);

        $response->assertRedirect(route('podcasts.edit', $podcast));
    }

    /**
     * @test
     */
    public function it_deletes_the_podcast()
    {
        $podcast = Podcast::factory()->create();

        $response = $this->delete(route('podcasts.destroy', $podcast));

        $response->assertRedirect(route('podcasts.index'));

        $this->assertDeleted($podcast);
    }
}
