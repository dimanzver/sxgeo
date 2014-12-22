<?php
namespace Astartsky\SypexGeo\Silex;

use Astartsky\SypexGeo\Exception\NoDatabaseConfiguredException;
use Astartsky\SypexGeo\Exception\NoDatabaseException;
use Astartsky\SypexGeo\Factory\CityFactory;
use Astartsky\SypexGeo\Factory\CountryFactory;
use Astartsky\SypexGeo\Factory\RegionFactory;
use Astartsky\SypexGeo\SxGeo;
use Astartsky\SypexGeo\SypexGeoAdapter;
use Silex\Application;
use Silex\ServiceProviderInterface;

class SypexGeoServiceProvider implements ServiceProviderInterface
{
    /**
     * Registers services on the given app.
     * @param Application $app An Application instance
     */
    public function register(Application $app)
    {
        $app['sypex_geo_library'] = function () use ($app) {

            if (false === (isset($app['sypex_geo']) && isset($app['sypex_geo']['database']))) {
                throw new NoDatabaseConfiguredException();
            }

            if (false === is_readable($app['sypex_geo']['database'])) {
                throw new NoDatabaseException();
            }

            return new SxGeo($app['sypex_geo']['database']);
        };

        $app['sypex_geo_adapter'] = function () use ($app) {
            return new SypexGeoAdapter($app['sypex_geo_library'], new CityFactory(), new RegionFactory(), new CountryFactory());
        };
    }

    /**
     * Bootstraps the application.
     */
    public function boot(Application $app)
    {

    }
}