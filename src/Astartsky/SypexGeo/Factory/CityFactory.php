<?php
namespace Astartsky\SypexGeo\Factory;

use Astartsky\SypexGeo\Bean\City;
use Astartsky\SypexGeo\Bean\Region;

class CityFactory
{
    /**
     * @param array $array
     * @param Region $region
     * @return City
     */
    public function create($array, Region $region)
    {
        $id = isset($array['id']) ? $array['id'] : null;
        $lat = isset($array['lat']) ? $array['lat'] : null;
        $lon = isset($array['lon']) ? $array['lon'] : null;
        $nameRu = isset($array['name_ru']) ? $array['name_ru'] : null;
        $nameEn = isset($array['name_en']) ? $array['name_en'] : null;

        return new City($id, $lat, $lon, $nameRu, $nameEn, $region);
    }
}