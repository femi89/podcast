<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Guest;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GuestControllerTest extends TestCase
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
    public function it_displays_index_view_with_guests()
    {
        $guests = Guest::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('guests.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.guests.index')
            ->assertViewHas('guests');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_guest()
    {
        $response = $this->get(route('guests.create'));

        $response->assertOk()->assertViewIs('app.guests.create');
    }

    /**
     * @test
     */
    public function it_stores_the_guest()
    {
        $data = Guest::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('guests.store'), $data);

        $this->assertDatabaseHas('guests', $data);

        $guest = Guest::latest('id')->first();

        $response->assertRedirect(route('guests.edit', $guest));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_guest()
    {
        $guest = Guest::factory()->create();

        $response = $this->get(route('guests.show', $guest));

        $response
            ->assertOk()
            ->assertViewIs('app.guests.show')
            ->assertViewHas('guest');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_guest()
    {
        $guest = Guest::factory()->create();

        $response = $this->get(route('guests.edit', $guest));

        $response
            ->assertOk()
            ->assertViewIs('app.guests.edit')
            ->assertViewHas('guest');
    }

    /**
     * @test
     */
    public function it_updates_the_guest()
    {
        $guest = Guest::factory()->create();

        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
        ];

        $response = $this->put(route('guests.update', $guest), $data);

        $data['id'] = $guest->id;

        $this->assertDatabaseHas('guests', $data);

        $response->assertRedirect(route('guests.edit', $guest));
    }

    /**
     * @test
     */
    public function it_deletes_the_guest()
    {
        $guest = Guest::factory()->create();

        $response = $this->delete(route('guests.destroy', $guest));

        $response->assertRedirect(route('guests.index'));

        $this->assertDeleted($guest);
    }
}
