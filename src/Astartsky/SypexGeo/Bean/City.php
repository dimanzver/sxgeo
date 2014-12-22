<?php
namespace Astartsky\SypexGeo\Bean;

class City
{
    protected $id;
    protected $latitude;
    protected $longitude;
    protected $nameRu;
    protected $nameEn;
    protected $region;

    /**
     * @param int $id
     * @param float $latitude
     * @param float $longitude
     * @param string $nameRu
     * @param string $nameEn
     * @param Region $region
     */
    public function __construct($id, $latitude, $longitude, $nameRu, $nameEn, $region = null)
    {
        $this->id = $id;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->nameRu = $nameRu;
        $this->nameEn = $nameEn;
        $this->region = $region;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @return string
     */
    public function getNameRu()
    {
        return $this->nameRu;
    }

    /**
     * @return string
     */
    public function getNameEn()
    {
        return $this->nameEn;
    }

    /**
     * @return Region|null
     */
    public function getRegion()
    {
        return $this->region;
    }
}