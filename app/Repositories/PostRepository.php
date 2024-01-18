<?php
/**
 * @author Rufusy Idachi <idachirufus@gmail.com>
 * @date: 1/18/2024
 * @time: 7:38 AM
 */

namespace App\Repositories;

use App\Exceptions\GeneralJsonException;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class PostRepository extends BaseRepository
{
    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return DB::transaction(function () use ($attributes) {
            $created = Post::query()->create([
                'title' => data_get($attributes, 'title', 'Untitled'),
                'body' => data_get($attributes, 'body'),
            ]);

            throw_if(!$created, GeneralJsonException::class, 'Failed to create post');

            if(data_get($attributes, 'user_ids')) {
                $created->users()->sync(data_get($attributes, 'user_ids'));
            }

            return $created;
        });
    }

    /**
     * @param Post $post
     * @param array $attributes
     * @return mixed
     */
    public function update($post, array $attributes)
    {
        return DB::transaction(function () use ($post, $attributes) {
            $updated = $post->update([
                'title' => data_get($attributes, 'title', $post->title),
                'body' => data_get($attributes, 'body', $post->body),
            ]);

            throw_if($updated, GeneralJsonException::class, 'Failed to update post');

            if(data_get($attributes, 'user_ids')) {
                $post->users()->sync(data_get($attributes, 'user_ids'));
            }

            return $post;
        });
    }

    /**
     * @param Post $post
     * @return mixed
     */
    public function forceDelete($post)
    {
        return DB::transaction(function () use ($post) {
            $deleted = $post->forceDelete();

            throw_if(!$deleted, GeneralJsonException::class, 'Failed to delete post');

            return $deleted;
        });
    }
}
