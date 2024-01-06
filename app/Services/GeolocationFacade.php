<?php
/**
 * @author Rufusy Idachi <idachirufus@gmail.com>
 * @date: 1/6/2024
 * @time: 2:08 PM
 */

namespace App\Services;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array search(string $string)
 * @see Geolocation
 */
class GeolocationFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return Geolocation::class;
    }
}
