<?php
namespace Astartsky\SypexGeo;

use Astartsky\SypexGeo\Factory\CityFactory;
use Astartsky\SypexGeo\Factory\CountryFactory;
use Astartsky\SypexGeo\Factory\RegionFactory;

class SypexGeoAdapter
{
    protected $sx;
    protected $cityFactory;
    protected $regionFactory;
    protected $countryFactory;

    /**
     * @param SxGeo $sx
     * @param CityFactory $cityFactory
     * @param RegionFactory $regionFactory
     * @param CountryFactory $countryFactory
     */
    public function __construct(SxGeo $sx, CityFactory $cityFactory, RegionFactory $regionFactory, CountryFactory $countryFactory)
    {
        $this->sx = $sx;
        $this->cityFactory = $cityFactory;
        $this->regionFactory = $regionFactory;
        $this->countryFactory = $countryFactory;
    }

    /**
     * @param string $ip
     * @return Bean\City|null
     */
    public function getCity($ip)
    {
        $raw = $this->sx->getCityFull($ip);

        $country = isset($raw['country']) ? $this->countryFactory->create($raw['country']) : null;
        $region = isset($raw['region']) ? $this->regionFactory->create($raw['region'], $country) : null;
        $city = isset($raw['city']) ? $this->cityFactory->create($raw['city'], $region) : null;

        return $city;
    }
}