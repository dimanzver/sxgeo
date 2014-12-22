<?php
namespace Astartsky\SypexGeo\Bean;

class Country
{
    protected $id;
    protected $iso;
    protected $latitude;
    protected $longitude;
    protected $nameRu;
    protected $nameEn;

    /**
     * @param int $id
     * @param string $iso
     * @param float $latitude
     * @param float $longitude
     * @param string $nameRu
     * @param string $nameEn
     */
    public function __construct($id, $iso, $latitude, $longitude, $nameRu, $nameEn)
    {
        $this->id = $id;
        $this->iso = $iso;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->nameRu = $nameRu;
        $this->nameEn = $nameEn;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getIso()
    {
        return $this->iso;
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
}