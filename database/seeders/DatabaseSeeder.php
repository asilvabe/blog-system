<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {


        User::factory()->create([
            'name' => env(key: 'ADMIN_NAME'),
            'email' => env(key: 'ADMIN_EMAIL'),
            'password' => bcrypt(env(key: 'ADMIN_PASS')),
            'is_admin' => true,
         ]);

        User::factory()->count(rand(1,5))->has(Post::factory(count: 50), relationship: 'posts')->create();
    }
}
