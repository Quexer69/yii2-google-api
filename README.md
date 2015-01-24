# Yii2 google api library 
-----------------------------

[![Latest Stable Version](https://poser.pugx.org/quexer69/yii2-google-api/v/stable.svg)](https://packagist.org/packages/quexer69/yii2-google-api) [![Total Downloads](https://poser.pugx.org/quexer69/yii2-google-api/downloads.svg)](https://packagist.org/packages/quexer69/yii2-google-api) [![Latest Unstable Version](https://poser.pugx.org/quexer69/yii2-google-api/v/unstable.svg)](https://packagist.org/packages/quexer69/yii2-google-api) [![License](https://poser.pugx.org/quexer69/yii2-google-api/license.svg)](https://packagist.org/packages/quexer69/yii2-google-api)

A collection of google map api calls, staticmap, geocode, iframe map

...for Google API v3, PHP >= 5.4.0, Yii 2.0.*


Installation
------------

The preferred way to install this component is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist quexer69/yii2-google-api "2.0.*"
```

or add

```
"quexer69/yii2-google-api": "2.0.*"
```

to the require section of your `composer.json` file.


###Configuration
---
in your app and/or console configuration file, add these


```php
'components' => [

    // Google Maps Image and Geocode API settings for \Yii::$app->googleApi component
    'googleApi'   => [
            'class'             => 'quexer\googleapi\GoogleApiLibrary',
            
            // API Keys !!!
            'staticmap_api_key' => '***************************************',
            'geocode_api_key'   => '***************************************',
            
            // Set basePath
            'webroot'           => '@webroot',
            
            // Image path and map iframe settings
            'map_image_path'    => '/images/google_map',
            'map_type'          => 'terrain',
            'map_size'          => '520x350',
            'map_sensor'        => false,
            'map_zoom'          => 9,
            'map_scale'         => 1,
            'map_marker_color'  => 'red',
            'map_iframe_width'  => '100%', // %, px, em
            'map_iframe_height' => '500px',  // %, px, em
            'map_language'       => 'de',
            
            // Debug
            'quiet'             => false
    ],
    ...
],
```

###Public Methods
---

```php
\Yii::$app->googleApi->renderMapIframe($address, $latlng, $iFrameWidth, $iFrameHeight)

\Yii::$app->googleApi->createImage($address, $latlng, $setMarker)

\Yii::$app->googleApi->getGeoCodeObject($address, $latlng)

\Yii::$app->googleApi->getDistance($start, $finish, $unit)

```

Usage
-----

Once the component is installed, simply use it in your code by:

```php
// Use $address OR $latlng
$address 	          = '70180 Stuttgart, Germany';
$latlng 	          = '48.7632145,9.174027';

```

**Create a Google map image**

```php
$relFilePath          = \Yii::$app->googleApi->createImage($address, null, true);
```

**To simply get the Google geocode object**

```php
$relFilePath          = \Yii::$app->googleApi->getGeoCodeObject(null, $latlng);
```

**Render a Google map iframe**

```php
$iframeMarkup         = \Yii::$app->googleApi->renderMapIframe(null, $latlng);
```

**Calculate Distance between two geo points**

```php
$latlng_origin	      = ['48.7632145','9.174027'];
$latlng_destination	  = ['48.4525334','9.468254'];
$unit		          = 'miles'; // 'miles' or 'km'

$floatDistance    = \Yii::$app->googleApi->getDistance($latlng_origin, $latlng_destination, $unit);
```
