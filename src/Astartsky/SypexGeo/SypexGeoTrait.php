<?php
namespace Astartsky\SypexGeo;

trait SypexGeoTrait
{
    /**
     * @return SxGeo
     */
    public function getSypexGeoLibrary()
    {
        return $this['sypex_geo_library'];
    }

    /**
     * @return SypexGeoAdapter
     */
    public function getSypexGeoAdapter()
    {
        return $this['sypex_geo_adapter'];
    }
}