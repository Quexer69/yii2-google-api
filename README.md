# Yii2 google api collection 
-----------------------------

A collection of google map api calls, staticmap, geocode, iframe map

...for Google API v3, PHP >= 5.4.0, Yii 2.0.*


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

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

    // Google Maps Image and Geocode API settings
    'googleApiLibrary'   => [
            'class'             => 'quexer\googleapi\GoogleApiLibrary',
            'webroot'           => '@webroot',
            'staticmap_api_key' => '***************************************',
            'geocode_api_key'   => '***************************************',
            'map_type'          => 'terrain',
            'map_size'          => '520x350',
            'map_sensor'        => false,
            'map_zoom'          => 9,
            'map_scale'         => 1,
            'map_image_path'    => '/images/google_map',
            'map_marker_color'  => 'red',
            'map_iframe_width'  => '100%',
            'map_iframe_height' => '500', // in px
            'map_language       => 'de',
            'quiet'             => false
    ],
    ...
],
```
	
Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
\Yii::$app->googleApiLibrary

// Use $address OR $latlng
$address 	          = '70180 Stuttgart, Germany';
$latlng 	          = '48.7632145,9.174027';

```

**Just type in an address string as you do on google maps!**

```php
$filePath             = \Yii::$app->googleApiLibrary->createImage($address,null);
```

**For query by latitude and longitude**

```php
$filePath             = \Yii::$app->googleApiLibrary->createImage(null, $latlng);
```

**To simply get the Google geocode object**

```php
$filePath             = \Yii::$app->googleApiLibrary->getGeoCodeObject(null, $latlng);
```

**Render a Google map iframe**

```php
$filePath             = \Yii::$app->googleApiLibrary->renderMapIframe(null, $latlng);
```

**Calculate Distance between two geo points**

```php
$latlng_origin	      = ['48.7632145','9.174027'];
$latlng_destination	  = ['48.4525334','9.468254'];
$unit		          = 'miles'; // or 'km'

$distance		      = \Yii::$app->googleApiLibrary->getDistance($latlng_origin, $latlng_destination, $unit);
```

###Public Methods
---

```php
\Yii::$app->googleApiLibrary->renderMapIframe($address, $latlng, $iFrameWidth, $iFrameHeight)

\Yii::$app->googleApiLibrary->createImage($address, $latlng, $setMarker)

\Yii::$app->googleApiLibrary->getGeoCodeObject($address, $latlng)

\Yii::$app->googleApiLibrary->getDistance($start, $finish, $unit)

```


