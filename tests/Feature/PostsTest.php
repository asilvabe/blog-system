<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class PostsTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function it_cannot_render_the_create_post_form_if_user_is_unauthenticated(): void
    {
        $this
            ->get(route('posts.create'))
            ->assertRedirect('login');
    }


    /** @test */
    public function it_can_render_the_create_post_form(): void
    {
        $this
            ->actingAs(User::factory()->create())
            ->get(route('posts.create'))
            ->assertOk()
            ->assertViewIs('posts.create');
    }

    /** @test */
    public function it_can_store_a_post(): void
    {
        $data = [
            'title' => $this->faker->sentence(2),
            'body' => $this->faker->paragraph(),
        ];

        $this
            ->actingAs(User::factory()->create())
            ->post(route('posts.store'), $data)
            ->assertRedirect(route('home'));

        $this->assertDatabaseHas('posts', $data);
    }

    /** @test */
    public function it_cannot_store_a_post_if_user_is_unauthenticated(): void
    {
        $data = [
            'title' => $this->faker->sentence(2),
            'body' => $this->faker->paragraph(),
        ];

        $this
            ->post(route('posts.store'), $data)
            ->assertRedirect('login');

        $this->assertDatabaseMissing('posts', $data);
    }

    /**
     * @test
     * @dataProvider validationProvider
     */
    public function it_cannot_create_a_post_due_validation_errors(string $input, string $value): void
    {
        $this
            ->actingAs(User::factory()->create())
            ->post(route('posts.store'), [$input => $value])
            ->assertRedirect()
            ->assertSessionHasErrors($input);
    }

    public function validationProvider(): array
    {
        return [
            'title is required' => ['title', ''],
            'title must be less or equal than 30' => ['title', Str::random(31)],
            'body is required' => ['body', ''],
            'body must be less or equal than 250' => ['body', Str::random(251)],
        ];
    }
}
