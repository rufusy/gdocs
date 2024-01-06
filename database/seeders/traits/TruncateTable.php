<?php
/**
 * @author Rufusy Idachi <idachirufus@gmail.com>
 * @date: 1/6/2024
 * @time: 4:53 PM
 */

namespace Database\Seeders\traits;

use Illuminate\Support\Facades\DB;

trait TruncateTable
{
    protected function truncate($table): void
    {
        DB::table($table)->truncate();
    }
}
