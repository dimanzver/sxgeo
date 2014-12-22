<?php
namespace Astartsky\SypexGeo\Bean;

class Region
{
    protected $id;
    protected $iso;
    protected $nameRu;
    protected $nameEn;
    protected $country;

    /**
     * @param int $id
     * @param string $iso
     * @param string $nameRu
     * @param string $nameEn
     * @param Country $country
     */
    public function __construct($id, $iso, $nameRu, $nameEn, $country = null)
    {
        $this->id = $id;
        $this->iso = $iso;
        $this->nameRu = $nameRu;
        $this->nameEn = $nameEn;
        $this->country = $country;
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
     * @return Country|null
     */
    public function getCountry()
    {
        return $this->country;
    }
}