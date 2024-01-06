<?php
/**
 * @author Rufusy Idachi <idachirufus@gmail.com>
 * @date: 1/6/2024
 * @time: 1:15 PM
 */

namespace App\Services;


class Geolocation
{
    private Map $map;
    private Satellite $satellite;

    public function __construct(Map $map, Satellite $satellite)
    {
        $this->map = $map;
        $this->satellite = $satellite;
    }

    public function search(string $name): array
    {
        // ...

        $location = $this->map->findAddress($name);

        return $coordinates = $this->satellite->pinPoint($location);
    }
}
