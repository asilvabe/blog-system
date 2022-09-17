<?php

namespace Tests\Feature;

use App\Models\Post;
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
    public function it_can_list_posts(): void
    {
        Post::factory()->count(3)->create();

        $response = $this
            ->get(route('welcome'))
            ->assertOk()
            ->assertViewHas('posts');

        $this->assertCount(3, $response['posts']);
    }

    /** @test */
    public function it_cannot_list_posts_details_if_user_is_unauthenticated(): void
    {
        $this
            ->get(route('posts.index'))
            ->assertRedirect('login');
    }

    /** @test */
    public function it_cannot_list_posts_details_if_not_admin_users(): void
    {
        Post::factory()->count(3)->create();

        $regularUser = User::factory()->create();

        $response = $this
            ->actingAs($regularUser)
            ->get(route('posts.index'))
            ->assertOk()
            ->assertViewHas('posts');

        $this->assertCount(0, $response['posts']);
    }

    /** @test */
    public function it_can_list_posts_details_if_user_is_admin(): void
    {
        Post::factory()->count(3)->create();

        $adminUser = User::factory()->admin()->create();

        $response = $this
            ->actingAs($adminUser)
            ->get(route('posts.index'))
            ->assertOk()
            ->assertViewHas('posts');

        $this->assertCount(3, $response['posts']);
    }

    /** @test */
    public function it_can_render_list_post_even_when_there_are_no_posts_if_user_is_admin(): void
    {
        $adminUser = User::factory()->admin()->create();

        $this
            ->actingAs($adminUser)
            ->get(route('posts.index'))
            ->assertOk()
            ->assertSee('There are no posts');
    }

    /** @test */
    public function it_can_render_the_main_page_even_when_there_are_no_posts(): void
    {
        $this
            ->get(route('welcome'))
            ->assertOk()
            ->assertSee('There are no posts');
    }

    /** @test */
    public function it_can_show_the_post_details_page(): void
    {
        $author = User::factory()->create([
            'name' => 'John Doe',
        ]);

        $post = Post::factory()
            ->for($author, 'author')
            ->create([
                'title' => 'Test title',
                'body' => 'Post body',
                'created_at' => '2022-08-27 16:00:00',
            ]);

        $this
            ->get(route('posts.show', $post))
            ->assertOk()
            ->assertSee('Test title')
            ->assertSee('Post body')
            ->assertSee('John Doe');
    }

    /** @test */
    public function it_cannot_render_the_form_to_create_a_post_if_user_is_unauthenticated(): void
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
            ->assertRedirect(route('welcome'));

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

    /** @test */
    public function admin_users_can_approve_a_post(): void
    {
        $pendingApprovalPost = Post::factory()->create();

        $this
            ->actingAs(User::factory()->admin()->create())
            ->patch(route('posts.approve', $pendingApprovalPost))
            ->assertRedirect(route('posts.show', $pendingApprovalPost));

        $pendingApprovalPost->refresh();

        $this->assertTrue($pendingApprovalPost->isApproved());
    }

    /** @test */
    public function regular_users_cannot_approve_a_post(): void
    {
        $pendingApprovalPost = Post::factory()->create();

        $this
            ->actingAs(User::factory()->create())
            ->patch(route('posts.approve', $pendingApprovalPost))
            ->assertForbidden();

        $pendingApprovalPost->refresh();

        $this->assertFalse($pendingApprovalPost->isApproved());
    }

    /** @test */
    public function guests_cannot_approve_a_post(): void
    {
        $pendingApprovalPost = Post::factory()->create();

        $this
            ->patch(route('posts.approve', $pendingApprovalPost))
            ->assertRedirect('login');

        $pendingApprovalPost->refresh();

        $this->assertFalse($pendingApprovalPost->isApproved());
    }

    /** @test */
    public function admin_users_can_see_the_action_to_approve_a_post(): void
    {
        $pendingApprovalPost = Post::factory()->create();

        $adminUser = User::factory()->admin()->create();

        $this
            ->actingAs($adminUser)
            ->get(route('posts.show', $pendingApprovalPost))
            ->assertOk()
            ->assertSee('Approve post');
    }

    /** @test */
    public function regular_users_cannot_see_the_action_to_approve_a_post(): void
    {
        $pendingApprovalPost = Post::factory()->create();

        $regularUser = User::factory()->create();

        $this
            ->actingAs($regularUser)
            ->get(route('posts.show', $pendingApprovalPost))
            ->assertOk()
            ->assertDontSee('Approve post');
    }

    /** @test */
    public function guests_cannot_see_the_action_to_approve_a_post(): void
    {
        $pendingApprovalPost = Post::factory()->create();

        $this
            ->get(route('posts.show', $pendingApprovalPost))
            ->assertOk()
            ->assertDontSee('Approve post');
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

    /** @test */
    public function it_can_search_posts_by_title(): void
    {
        Post::factory()->count(9)->create();
        Post::factory()->create(['title' => 'test awesome title']);

        $adminUser = User::factory()->admin()->create();

        $response = $this
            ->actingAs($adminUser)
            ->get(route('posts.index', ['title_search' => 'awesome']))
            ->assertOk()
            ->assertViewHas('posts');

        $this->assertCount(1, $response['posts']);
    }

    /** @test */
    public function it_can_filter_posts_by_creation_date_range(): void
    {
        Post::factory()->count(9)->create();
        Post::factory()->create(['created_at' => '2013-03-05']);

        $adminUser = User::factory()->admin()->create();

        $response = $this
            ->actingAs($adminUser)
            ->get(route('posts.index', ['date_from' => '2013-03-01', 'date_to' => '2013-03-10']))
            ->assertOk()
            ->assertViewHas('posts');

        $this->assertCount(1, $response['posts']);
    }

    /** @test */
    public function it_can_filter_posts_by_author(): void
    {
        $regularUser = User::factory()->create(['id' => 1]);

        Post::factory()->count(9)->create();
        Post::factory()->create(['created_by' => $regularUser->id]);

        $adminUser = User::factory()->admin()->create();

        $response = $this
            ->actingAs($adminUser)
            ->get(route('posts.index', ['author' => $regularUser->id]))
            ->assertOk()
            ->assertViewHas('posts');

        $this->assertCount(1, $response['posts']);
    }

    /** @test */
    public function it_can_filter_posts_by_approve_status(): void
    {
        $admin = User::factory()->admin()->create(['id' => 1]);
        $approved = 1;
        Post::factory()->count(9)->create();
        Post::factory()->create(['approved_by' => $admin->id]);

        $adminUser = User::factory()->admin()->create();

        $response = $this
            ->actingAs($adminUser)
            ->get(route('posts.index', ['status' => $approved]))
            ->assertOk()
            ->assertViewHas('posts');

        $this->assertCount(1, $response['posts']);
    }
}
