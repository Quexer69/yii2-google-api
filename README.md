# Yii2 google api collection 
-----------------------------

A collection of google map api calls, staticmap, geocode, iframe map

...for Google API v3, PHP >= 5.4.0, Yii 2.0.*


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist quexer69/yii2-google-api "*"
```

or add

```
"quexer69/yii2-google-api": "*"
```

to the require section of your `composer.json` file.


###Configuration
---
in your app and/or console configuration file, add these

    'components' => [
    
        // Google Maps Image and Geocode API settings
    	'googleApiLibrary'   => [
    			'class'             => 'quexer\googleapi\GoogleApiLibrary',
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
                'language'          => 'de',
                'quiet'             => false
    	],
		...
	],
	
Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
\Yii::$app()->googleApiLibrary
```


**Just type in an address string as you do on google maps!**

    $address 	          = '70180 Stuttgart, Germany';
    $filePath             = \Yii::$app()->googleApiLibrary->createImage($address,null);

**For query by latitude and longitude**

    $latlng 	          = '48.7632145,9.174027';
    $filePath             = \Yii::$app()->googleApiLibrary->createImage(null, $latlng);

**Calculate Distance between two geo points**

    $latlng_origin	      = ['48.7632145,9.174027'];
    $latlng_destination	  = ['48.4525334,9.468254'];
    $unit		          = 'miles' // or 'km'

    $distance		      = \Yii::$app()->googleApiLibrary->getDistance($latlng_origin, $latlng_destination, $unit);


###Public Methods
---

`public function getGoogleMapIframe($address, $latlng, $iFrameWidth, $iFrameHeight)`

`public function createImage($address, $latlng, $setMarker)`

`public function getGeoCodeObject($address, $latlng)`

`public function getDistance($start, $finish, $unit)`

`public static function getCountryByCode($short_country_code)`


