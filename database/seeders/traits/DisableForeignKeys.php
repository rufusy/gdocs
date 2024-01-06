<?php
/**
 * @author Rufusy Idachi <idachirufus@gmail.com>
 * @date: 1/6/2024
 * @time: 4:57 PM
 */

namespace Database\Seeders\traits;

use Illuminate\Support\Facades\DB;

trait DisableForeignKeys
{
    protected function disableForeignKeys(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
    }

    protected function enableForeignKeys(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
