<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class PostsTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function it_can_show_the_form_to_create_a_post(): void
    {
        $this
            ->get(route('posts.create'))
            ->assertOk()
            ->assertViewIs('posts.create');
    }

    /** @test */
    public function it_can_create_a_post(): void
    {
        $data = [
            'title' => $this->faker->sentence(2),
            'body' => $this->faker->paragraph(),
        ];

        $this
            ->post(route('posts.store'), $data)
            ->assertRedirect();

        $this->assertDatabaseHas('posts', $data);
    }

    /**
     * @test
     * @dataProvider validationProvider
     */
    public function it_cannot_create_a_post_due_validation_errors(string $input, string $value): void
    {
        $this
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
