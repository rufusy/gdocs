<?php
/**
 * @author Rufusy Idachi <idachirufus@gmail.com>
 * @date: 1/18/2024
 * @time: 8:13 AM
 */

namespace App\Repositories;

abstract class BaseRepository
{
    abstract public function create(array $attributes);
    abstract public function update($model, array $attributes);
    abstract public function forceDelete($model);
}
