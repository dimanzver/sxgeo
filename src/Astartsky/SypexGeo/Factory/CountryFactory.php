<?php
namespace Astartsky\SypexGeo\Factory;

use Astartsky\SypexGeo\Bean\Country;

class CountryFactory
{
    /**
     * @param $array
     * @return Country
     */
    public function create($array)
    {
        $id = isset($array['id']) ? $array['id'] : null;
        $iso = isset($array['iso']) ? $array['iso'] : null;
        $lat = isset($array['lat']) ? $array['lat'] : null;
        $lon = isset($array['lon']) ? $array['lon'] : null;
        $nameRu = isset($array['name_ru']) ? $array['name_ru'] : null;
        $nameEn = isset($array['name_en']) ? $array['name_en'] : null;

        return new Country($id, $iso, $lat, $lon, $nameRu, $nameEn);
    }
}