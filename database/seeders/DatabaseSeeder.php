<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => config(key: 'blog.admin_name'),
            'email' => config(key: 'blog.admin_email'),
            'password' => bcrypt(config(key: 'blog.admin_password')),
            'is_admin' => true,
         ]);

        User::factory()
            ->count(rand(1,5))
            ->has(Post::factory(count: 50), relationship: 'posts')
            ->create();
    }
}
