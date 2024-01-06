<?php

namespace Database\Seeders;

use App\Models\Comment;
use Database\Seeders\traits\DisableForeignKeys;
use Database\Seeders\traits\TruncateTable;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    use TruncateTable, DisableForeignKeys;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->disableForeignKeys();

        $this->truncate('comments');

        Comment::factory(3)->create();

        $this->enableForeignKeys();
    }
}
