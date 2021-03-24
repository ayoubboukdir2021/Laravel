<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        if($users->count() == 0)
        {
            $this->command->info(" no user exist");
            return;
        }

        $nbPosts = (int)$this->command->ask('How many posts do you want to generate ');

        \App\Models\Post::factory($nbPosts)->make()->each(function($post) use ($users) {
            $post->user_id = $users->random()->id;
            $post->save();
        });
    }
}
