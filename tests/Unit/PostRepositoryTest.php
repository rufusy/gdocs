<?php

namespace Tests\Unit;

use App\Exceptions\GeneralJsonException;
use App\Models\Post;
use App\Repositories\PostRepository;
use Tests\TestCase;

class PostRepositoryTest extends TestCase
{
    public function test_create()
    {
       /**
        * Steps:
        * 1. Define the goal. Test if create() will actually create post in db
        * 2. Replicate the env/restriction (recreate the condition on where to call the create post method)
        * 3. Define the source of truth
        * 4. Compare the result against source of truth
        */

        // Replicate the env/restriction
        $repository = $this->app->make(PostRepository::class);

        // Define the source of truth
        $payload = [
            'title' => 'Test post creation',
            'body' => []
        ];

       // Compare the result against source of truth
        $result = $repository->create($payload);

        $this->assertSame($payload['title'], $result->title, 'Post created does not have the same title.');
    }

    public function test_update()
    {
        $repository = $this->app->make(PostRepository::class);
        $dummyPost = Post::factory(1)->create()[0];

        $payload = [
            'title' => 'abc123',
        ];

        $updatedPost = $repository->update($dummyPost, $payload);
        $this->assertSame($payload['title'], $updatedPost->title, 'Post updated does not have the same title.');
    }

    public function test_delete()
    {
        $repository = $this->app->make(PostRepository::class);
        $dummyPost = Post::factory(1)->create()->first();

        $repository->forceDelete($dummyPost);

        $post = Post::query()->find($dummyPost->id);

        $this->assertSame(null, $post, 'Post is not deleted.');
    }

    public function test_delete_will_throw_exception_when_post_does_not_exist()
    {
        $repository = $this->app->make(PostRepository::class);
        $dummyPost = Post::factory(1)->make()->first();

        $this->expectException(GeneralJsonException::class);
        $repository->forceDelete($dummyPost);
    }
}
