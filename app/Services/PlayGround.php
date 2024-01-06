<?php
/**
 * @author Rufusy Idachi <idachirufus@gmail.com>
 * @date: 1/6/2024
 * @time: 2:09 PM
 */

namespace App\Services;

class PlayGround
{
    public function __construct(Geolocation $geolocation)
    {
//        $geolocation = app(Geolocation::class);

        $result = GeolocationFacade::search('aa');

        dump($result);
    }

}
