<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApprovePostTest extends TestCase
{
    use RefreshDatabase;

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
}
