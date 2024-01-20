<?php
/**
 * @author Rufusy Idachi <idachirufus@gmail.com>
 * @date: 1/20/2024
 * @time: 1:11 PM
 */

namespace App\Repositories;

use App\Events\Models\User\UserCreated;
use App\Exceptions\GeneralJsonException;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserRepository extends BaseRepository
{
    public function create(array $attributes)
    {
        return DB::transaction(function () use ($attributes) {
            $created = User::query()->create([
                'name' => data_get($attributes, 'name'),
                'email' => data_get($attributes, 'email'),
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
            ]);

            throw_if(!$created, GeneralJsonException::class, 'Failed to create user.');

            event(new UserCreated($created));

            return $created;
        });
    }

    public function update($user, array $attributes)
    {
        return DB::transaction(function () use($user, $attributes) {
            $updated = $user->update([
                'name' => data_get($attributes, 'name', $user->name),
                'email' => data_get($attributes, 'email', $user->email),
            ]);
            throw_if(!$updated, GeneralJsonException::class, 'Failed to update user.');

            return $user;
        });
    }

    public function forceDelete($user)
    {
        return DB::transaction(function () use($user) {
            $deleted = $user->forceDelete();

            throw_if(!$deleted, GeneralJsonException::class, 'Cannot delete user.');

            return $deleted;
        });
    }
}
