<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Database\Factories\helpers\FactoryHelper;
use Database\Seeders\traits\DisableForeignKeys;
use Database\Seeders\traits\TruncateTable;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    use TruncateTable, DisableForeignKeys;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->disableForeignKeys();

        $this->truncate('users');

        $users = User::factory(10)->create();

        $users->each(function (User $user) {
            $user->posts()->syncWithoutDetaching([FactoryHelper::getRandomModelId(Post::class)]);
        });

        $this->enableForeignKeys();
    }
}
