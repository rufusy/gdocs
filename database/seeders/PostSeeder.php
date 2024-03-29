<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Database\Factories\helpers\FactoryHelper;
use Database\Seeders\traits\DisableForeignKeys;
use Database\Seeders\traits\TruncateTable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    use TruncateTable, DisableForeignKeys;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->disableForeignKeys();

        $this->truncate('posts');

//        Post::factory(3)->state([
//            'title' => 'Untitled'
//        ])->create();

        $posts = Post::factory(3)->untitled()->create();

        $posts->each(function (Post $post) {
            $post->users()->syncWithoutDetaching([FactoryHelper::getRandomModelId(User::class)]);
        });

        $this->enableForeignKeys();
    }
}
