<?php
namespace Astartsky\SypexGeo\Factory;

use Astartsky\SypexGeo\Bean\Country;
use Astartsky\SypexGeo\Bean\Region;

class RegionFactory
{
    /**
     * @param array $array
     * @param Country $country
     * @return Region
     */
    public function create($array, Country $country)
    {
        $id = isset($array['id']) ? $array['id'] : null;
        $iso = isset($array['iso']) ? $array['iso'] : null;
        $nameRu = isset($array['name_ru']) ? $array['name_ru'] : null;
        $nameEn = isset($array['name_en']) ? $array['name_en'] : null;

        return new Region($id, $iso, $nameRu, $nameEn, $country);
    }
}