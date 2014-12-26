Sypex Geo service provider for Silex
=========

Usage
--------------

### 1. Set path to database in your app ###

```php
$app['sypex_geo'] = [];
$app['sypex_geo']['database'] = 'SxGeoCity.dat';
```

### 2. Register «SypexGeoServiceProvider» in your app ###

```php
$app->register(new \Astartsky\SypexGeo\Silex\SypexGeoServiceProvider());
```

### 3. Extend your application class with «SypexGeoTrait» ###

```php
class AwesomeApplication extends \Silex\Application
{
    ...
    use SypexGeoTrait;
    ...
}
```

### 4. Enjoy your new integration! :) ###

```php
$city = $app->getSypexGeoAdapter()->getCity(**IP**)
var_dump($city);
```

Output will be like this: 

```php
object(Astartsky\SypexGeo\Bean\City)[613]
  protected 'id' => int 524901
  protected 'latitude' => float 55.75222
  protected 'longitude' => float 37.61556
  protected 'nameRu' => string 'Москва' (length=12)
  protected 'nameEn' => string 'Moscow' (length=6)
  protected 'region' => 
    object(Astartsky\SypexGeo\Bean\Region)[612]
      protected 'id' => int 524894
      protected 'iso' => string 'RU-MOW' (length=6)
      protected 'nameRu' => string 'Москва' (length=12)
      protected 'nameEn' => string 'Moskva' (length=6)
      protected 'country' => 
        object(Astartsky\SypexGeo\Bean\Country)[611]
          protected 'id' => int 185
          protected 'iso' => string 'RU' (length=2)
          protected 'latitude' => int 60
          protected 'longitude' => int 100
          protected 'nameRu' => string 'Россия' (length=12)
          protected 'nameEn' => string 'Russia' (length=6)
```

Update on «composer install» command
--------------

### 1. Put «post-install-cmd» event to composer.json ### 

```js
"scripts": {
        "post-install-cmd": [
            "Astartsky\\SypexGeo\\Composer::installDatabases"
        ]
    }
```

### 2. Put «extra» settings to composer.json ###

```js
"extra": {
        "sypex_geo_update": "https://sypexgeo.net/files/SxGeoCity_utf8.zip",
        "sypex_geo_database": "SxGeoCity.dat"
    }
```