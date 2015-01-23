<?php

namespace quexer\googleapi;

use yii\helpers\Inflector;

/**
 * Class GoogleApiLibrary
 * @description A collection of google map api calls, staticmap, geocode, iframe map for the Google API v3
 * @date 2015-01-23
 * @version 1.0.0
 * @author Christopher Stebe <cstebe@iserv4u.com>
 *
 */
class GoogleApiLibrary extends \yii\base\Component
{
    /**
     * @var google static map api key
     */
    public $staticmap_api_key;

    /**
     * @var google geocode api key
     */
    public $geocode_api_key;

    /**
     * @var string google map type
     */
    public $map_type = 'terrain';

    /**
     * @var string google map size height x width in px
     */
    public $map_size = '520x350';

    /**
     * @var string google map iframe with
     */
    public $map_iframe_width = '100%';

    /**
     * @var string google map iframe height
     */
    public $map_iframe_height = '500';

    /**
     * @var bool google map sensor
     */
    public $map_sensor = false;

    /**
     * @var int google map zoom
     */
    public $map_zoom = 9;

    /**
     * @var int google map scale
     */
    public $map_scale = 1;

    /**
     * @var string output path for generated google map images
     */
    public $map_image_path = '/images';

    /**
     * @var string google map language
     */
    public $map_language = 'en';

    /**
     * @var string google map marker color
     */
    public $map_marker_color = 'red';

    /**
     * @var bool show console output
     */
    public $quiet = false;

    /**
     * @var webroot alias
     */
    public $webroot = '@app/web';

    /**
     * @var array country codes to country names from http://pastebin.com/VSAvVng6
     */
    public static $countrycodes = [
        'AF' => 'Afghanistan',
        'AX' => 'Åland Islands',
        'AL' => 'Albania',
        'DZ' => 'Algeria',
        'AS' => 'American Samoa',
        'AD' => 'Andorra',
        'AO' => 'Angola',
        'AI' => 'Anguilla',
        'AQ' => 'Antarctica',
        'AG' => 'Antigua and Barbuda',
        'AR' => 'Argentina',
        'AU' => 'Australia',
        'AT' => 'Österreich',
        'AZ' => 'Azerbaijan',
        'BS' => 'Bahamas',
        'BH' => 'Bahrain',
        'BD' => 'Bangladesh',
        'BB' => 'Barbados',
        'BY' => 'Belarus',
        'BE' => 'Belgium',
        'BZ' => 'Belize',
        'BJ' => 'Benin',
        'BM' => 'Bermuda',
        'BT' => 'Bhutan',
        'BO' => 'Bolivia',
        'BA' => 'Bosnia and Herzegovina',
        'BW' => 'Botswana',
        'BV' => 'Bouvet Island',
        'BR' => 'Brazil',
        'IO' => 'British Indian Ocean Territory',
        'BN' => 'Brunei Darussalam',
        'BG' => 'Bulgaria',
        'BF' => 'Burkina Faso',
        'BI' => 'Burundi',
        'KH' => 'Cambodia',
        'CM' => 'Cameroon',
        'CA' => 'Canada',
        'CV' => 'Cape Verde',
        'KY' => 'Cayman Islands',
        'CF' => 'Central African Republic',
        'TD' => 'Chad',
        'CL' => 'Chile',
        'CN' => 'China',
        'CX' => 'Christmas Island',
        'CC' => 'Cocos (Keeling) Islands',
        'CO' => 'Colombia',
        'KM' => 'Comoros',
        'CG' => 'Congo',
        'CD' => 'Zaire',
        'CK' => 'Cook Islands',
        'CR' => 'Costa Rica',
        'CI' => 'Côte D\'Ivoire',
        'HR' => 'Croatia',
        'CU' => 'Cuba',
        'CY' => 'Cyprus',
        'CZ' => 'Czech Republic',
        'DK' => 'Denmark',
        'DJ' => 'Djibouti',
        'DM' => 'Dominica',
        'DO' => 'Dominican Republic',
        'EC' => 'Ecuador',
        'EG' => 'Egypt',
        'SV' => 'El Salvador',
        'GQ' => 'Equatorial Guinea',
        'ER' => 'Eritrea',
        'EE' => 'Estonia',
        'ET' => 'Ethiopia',
        'FK' => 'Falkland Islands (Malvinas)',
        'FO' => 'Faroe Islands',
        'FJ' => 'Fiji',
        'FI' => 'Finland',
        'FR' => 'France',
        'GF' => 'French Guiana',
        'PF' => 'French Polynesia',
        'TF' => 'French Southern Territories',
        'GA' => 'Gabon',
        'GM' => 'Gambia',
        'GE' => 'Georgia',
        'DE' => 'Deutschland',
        'GH' => 'Ghana',
        'GI' => 'Gibraltar',
        'GR' => 'Greece',
        'GL' => 'Greenland',
        'GD' => 'Grenada',
        'GP' => 'Guadeloupe',
        'GU' => 'Guam',
        'GT' => 'Guatemala',
        'GG' => 'Guernsey',
        'GN' => 'Guinea',
        'GW' => 'Guinea-Bissau',
        'GY' => 'Guyana',
        'HT' => 'Haiti',
        'HM' => 'Heard Island and Mcdonald Islands',
        'VA' => 'Vatican City State',
        'HN' => 'Honduras',
        'HK' => 'Hong Kong',
        'HU' => 'Hungary',
        'IS' => 'Iceland',
        'IN' => 'India',
        'ID' => 'Indonesia',
        'IR' => 'Iran, Islamic Republic of',
        'IQ' => 'Iraq',
        'IE' => 'Ireland',
        'IM' => 'Isle of Man',
        'IL' => 'Israel',
        'IT' => 'Italy',
        'JM' => 'Jamaica',
        'JP' => 'Japan',
        'JE' => 'Jersey',
        'JO' => 'Jordan',
        'KZ' => 'Kazakhstan',
        'KE' => 'KENYA',
        'KI' => 'Kiribati',
        'KP' => 'Korea, Democratic People\'s Republic of',
        'KR' => 'Korea, Republic of',
        'KW' => 'Kuwait',
        'KG' => 'Kyrgyzstan',
        'LA' => 'Lao People\'s Democratic Republic',
        'LV' => 'Latvia',
        'LB' => 'Lebanon',
        'LS' => 'Lesotho',
        'LR' => 'Liberia',
        'LY' => 'Libyan Arab Jamahiriya',
        'LI' => 'Liechtenstein',
        'LT' => 'Lithuania',
        'LU' => 'Luxembourg',
        'MO' => 'Macao',
        'MK' => 'Macedonia, the Former Yugoslav Republic of',
        'MG' => 'Madagascar',
        'MW' => 'Malawi',
        'MY' => 'Malaysia',
        'MV' => 'Maldives',
        'ML' => 'Mali',
        'MT' => 'Malta',
        'MH' => 'Marshall Islands',
        'MQ' => 'Martinique',
        'MR' => 'Mauritania',
        'MU' => 'Mauritius',
        'YT' => 'Mayotte',
        'MX' => 'Mexico',
        'FM' => 'Micronesia, Federated States of',
        'MD' => 'Moldova, Republic of',
        'MC' => 'Monaco',
        'MN' => 'Mongolia',
        'ME' => 'Montenegro',
        'MS' => 'Montserrat',
        'MA' => 'Morocco',
        'MZ' => 'Mozambique',
        'MM' => 'Myanmar',
        'NA' => 'Namibia',
        'NR' => 'Nauru',
        'NP' => 'Nepal',
        'NL' => 'Netherlands',
        'AN' => 'Netherlands Antilles',
        'NC' => 'New Caledonia',
        'NZ' => 'New Zealand',
        'NI' => 'Nicaragua',
        'NE' => 'Niger',
        'NG' => 'Nigeria',
        'NU' => 'Niue',
        'NF' => 'Norfolk Island',
        'MP' => 'Northern Mariana Islands',
        'NO' => 'Norway',
        'OM' => 'Oman',
        'PK' => 'Pakistan',
        'PW' => 'Palau',
        'PS' => 'Palestinian Territory, Occupied',
        'PA' => 'Panama',
        'PG' => 'Papua New Guinea',
        'PY' => 'Paraguay',
        'PE' => 'Peru',
        'PH' => 'Philippines',
        'PN' => 'Pitcairn',
        'PL' => 'Poland',
        'PT' => 'Portugal',
        'PR' => 'Puerto Rico',
        'QA' => 'Qatar',
        'RE' => 'Réunion',
        'RO' => 'Romania',
        'RU' => 'Russian Federation',
        'RW' => 'Rwanda',
        'SH' => 'Saint Helena',
        'KN' => 'Saint Kitts and Nevis',
        'LC' => 'Saint Lucia',
        'PM' => 'Saint Pierre and Miquelon',
        'VC' => 'Saint Vincent and the Grenadines',
        'WS' => 'Samoa',
        'SM' => 'San Marino',
        'ST' => 'Sao Tome and Principe',
        'SA' => 'Saudi Arabia',
        'SN' => 'Senegal',
        'RS' => 'Serbia',
        'SC' => 'Seychelles',
        'SL' => 'Sierra Leone',
        'SG' => 'Singapore',
        'SK' => 'Slovakia',
        'SI' => 'Slovenia',
        'SB' => 'Solomon Islands',
        'SO' => 'Somalia',
        'ZA' => 'South Africa',
        'GS' => 'South Georgia and the South Sandwich Islands',
        'ES' => 'Spain',
        'LK' => 'Sri Lanka',
        'SD' => 'Sudan',
        'SR' => 'Suriname',
        'SJ' => 'Svalbard and Jan Mayen',
        'SZ' => 'Swaziland',
        'SE' => 'Sweden',
        'CH' => 'Schweiz',
        'SY' => 'Syrian Arab Republic',
        'TW' => 'Taiwan, Province of China',
        'TJ' => 'Tajikistan',
        'TZ' => 'Tanzania, United Republic of',
        'TH' => 'Thailand',
        'TL' => 'Timor-Leste',
        'TG' => 'Togo',
        'TK' => 'Tokelau',
        'TO' => 'Tonga',
        'TT' => 'Trinidad and Tobago',
        'TN' => 'Tunisia',
        'TR' => 'Turkey',
        'TM' => 'Turkmenistan',
        'TC' => 'Turks and Caicos Islands',
        'TV' => 'Tuvalu',
        'UG' => 'Uganda',
        'UA' => 'Ukraine',
        'AE' => 'United Arab Emirates',
        'GB' => 'United Kingdom',
        'US' => 'United States',
        'UM' => 'United States Minor Outlying Islands',
        'UY' => 'Uruguay',
        'UZ' => 'Uzbekistan',
        'VU' => 'Vanuatu',
        'VE' => 'Venezuela',
        'VN' => 'Viet Nam',
        'VG' => 'Virgin Islands, British',
        'VI' => 'Virgin Islands, U.S.',
        'WF' => 'Wallis and Futuna',
        'EH' => 'Western Sahara',
        'YE' => 'Yemen',
        'ZM' => 'Zambia',
        'ZW' => 'Zimbabwe',
    ];

    /**
     * @var the full webroot path from \Yii::getAlias($this->webroot)
     */
    private static $webrootPath;

    /**
     * @param null $address
     * @param null $latlng
     * @param null $iFrameWidth
     * @param null $iFrameHeight
     *
     * @return string
     */
    public function renderIframeMap($address = null, $latlng = null, $iFrameWidth = null, $iFrameHeight = null)
    {
        if ($address === null && $latlng === null) {
            if (!$this->quiet) {
                echo 'IframeMap -> ' . \Yii::t(
                        'app',
                        'Please provide at least an address or a latitude and logitude pair!'
                    );
            }
        }

        switch (true) {
            case $iFrameWidth !== null:
                $this->map_iframe_width = $iFrameWidth;
                break;
            case $iFrameHeight !== null:
                $this->map_iframe_height = $iFrameHeight;
                break;
        }

        switch (true) {
            case $address !== null :
                $geoObject = $this->getGeoCodeObject($address, null);
                $latlng    = $geoObject->geometry->location->lat . ',' . $geoObject->geometry->location->lng;
                break;

            default:
                break;
        }

        // map google map types to embed map types
        switch ($this->map_type) {
            case 'satellite':
                $mapType = 'k';
                break;

            case 'hybrid':
                $mapType = 'h';
                break;

            case 'terrain':
                $mapType = 'p';
                break;

            default:
                $mapType = 'm';
                break;
        }

        // generate google map
        $mapRequestUrl = 'https://maps.google.de/maps'
            . '?q=' . $latlng
            . '&ie=UTF8'
            . '&t=' . $mapType
            . '&z=' . $this->map_zoom
            . '&hl=' . $this->map_language
            . '&output=embed';

        $return = '<iframe frameborder="0" marginheight="0" marginwidth="0" scrolling="no" '
            . 'src="' . $mapRequestUrl . '" '
            . 'width="' . $this->map_iframe_width . '" '
            . 'height="' . $this->map_iframe_height . '">'
            . '</iframe>';

        return $return;

    }

    /**
     * @param null $address
     * @param null $latlng
     * @param bool $setMarker
     *
     * @return string
     */
    public function createImage($address = null, $latlng = null, $setMarker = false)
    {
        self::$webrootPath = realpath(\Yii::getAlias($this->webroot));

        // get google geocde object
        switch (true) {
            case $address !== null :
                $geoObject   = $this->getGeoCodeObject($address, null);
                $querystring = $geoObject->geometry->location->lat . ',' . $geoObject->geometry->location->lng;
                break;
            case $latlng !== null :
                $geoObject   = $this->getGeoCodeObject(null, $latlng);
                $querystring = str_replace(' ', '', $latlng);
                break;
            default:
                $querystring = false;
                break;
        }

        // generate google maps image
        $imageRequestUrl = 'http://maps.googleapis.com/maps/api/staticmap'
            . '?center=' . $querystring
            . '&zoom=' . $this->map_zoom
            . '&size=' . $this->map_size
            . '&maptype=' . $this->map_type
            . '&sensor=' . $this->map_sensor
            . '&scale=' . $this->map_scale
            . '&language=' . $this->map_language
            . '&key=' . $this->staticmap_api_key;

        // add 'markers' param if $setMarker is true (places marker on provided $geoObject)
        $imageRequestUrl .=
            ($setMarker === true ? '&markers=color:' . $this->map_marker_color . '|' . $querystring : '');

        // full path and filename before save image
        $address      = $this->getAddressComponents($geoObject);
        $relFilePath  = $this->map_image_path . '/' . $this->createImageFilename(
                [$address['postal_code'], $address['locality'], $this->getCountryByCode($address['country_code'])],
                'png'
            );
        $fullFilePath = self::$webrootPath . $relFilePath;

        try {
            // Request the google map image
            $handler = curl_init($imageRequestUrl);
            curl_setopt($handler, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($handler, CURLOPT_PROXYPORT, 3128);
            curl_setopt($handler, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($handler, CURLOPT_SSL_VERIFYPEER, 0);
            $googleImage = curl_exec($handler);
        } catch (\Exception $e) {
            $msg = (isset($e->errorInfo[2])) ? $e->errorInfo[2] : $e->getMessage();
            if (!$this->quiet) {
                \Yii::$app->getSession()->setFlash('error', $msg);
                echo "\n -> Alert: " . $msg;
            }
        }

        //if the img did not come back
        if (curl_errno($handler)) {
            $return = 'Curl error: ' . curl_error(
                    $handler
                ) . 'Your client has issued a malformed or illegal request. That’s all we know.';

            // Close handle
            curl_close($handler);

            return $return;
        } else {
            try {
                //@ini_set('allow_url_fopen', 1);
                file_put_contents($fullFilePath, $googleImage);
                //@ini_set('allow_url_fopen', 0);
            } catch (\Exception $e) {
                $msg = (isset($e->errorInfo[2])) ? $e->errorInfo[2] : $e->getMessage();
                if (!$this->quiet) {
                    \Yii::$app->getSession()->setFlash('error', $msg);
                    echo "\n -> Alert: " . $msg;
                }
            }

            if (!$this->quiet) {
                echo "\n -> Image: " . $relFilePath;
            }

            // Close handle
            curl_close($handler);

            return $relFilePath;
        }
    }

    /**
     * generate google maps geocode request
     *
     * if address is set, query by address, else by latlng
     *
     * @param null $address
     * @param null $latlng
     *
     * @return JSON decoded array with all location information for this address | false
     */
    public function getGeoCodeObject($address = null, $latlng = null)
    {
        if ($address !== null || $latlng !== null) {

            switch (true) {
                case $address !== null:
                    $querystring = '?address=' . urlencode($address);
                    break;
                case $latlng !== null:
                    $querystring = '?latlng=' . $latlng;
                    break;
                default:
                    $querystring = '';
            }

            // concat query string
            $querystring = str_replace(' ', '%20', $querystring);

            // query by address string
            $geoCodeUrl = 'https://maps.googleapis.com/maps/api/geocode/json'
                . $querystring
                . '&language=' . $this->map_language
                . '&key=' . $this->geocode_api_key;

            // get geocode object
            try {
                $ch = curl_init($geoCodeUrl);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                $response = curl_exec($ch);
                curl_close($ch);
            } catch (\Exception $e) {
                $msg = (isset($e->errorInfo[2])) ? $e->errorInfo[2] : $e->getMessage();
                if (!$this->quiet) {
                    \Yii::$app->getSession()->setFlash('error', $msg);
                    echo "\n -> Alert: " . $msg;
                }
            }

            // json decode response
            $response_a = json_decode($response);

            if (isset($response_a->results[0])) {
                return $response_a->results[0];
            } else {
                return null;
            }
        } else {
            if (!$this->quiet) {
                echo 'getGeoCodeObject() -> ' . \Yii::t('app', 'no input params given!');
            }
        }
    }

    /**
     * @param array $start (key[0] = lat, key[1] = lng)
     * @param array $finish (key[0] = lat, key[1] = lng)
     * @param string $unit miles | km
     *
     * @return float rounded to 15,xx
     */
    public function getDistance($start = [], $finish = [], $unit = 'miles')
    {
        $theta    = $start[1] - $finish[1];
        $distance = (sin(deg2rad($start[0])) * sin(deg2rad($finish[0]))) + (cos(deg2rad($start[0])) * cos(
                    deg2rad($finish[0])
                ) * cos(deg2rad($theta)));
        $distance = acos($distance);
        $distance = rad2deg($distance);

        switch (true) {
            case $unit = 'miles' :
                $distance = $distance * 60 * 1.1515;
                break;
            case $unit = 'km' :
                $distance = $distance * 60 * 1.1515 * 1.609344;
                break;
        }

        return round($distance, 2);
    }

    /**
     * @param array $attributes Input an array of attributes to create a filename from
     * @param string $type type of the file
     *
     * @return string a nice slugged filename
     */
    private function createImageFilename($attributes = [], $type = 'png')
    {
        if (is_array($attributes) && sizeof($attributes) > 0) {

            $rawFilename = null;
            foreach ($attributes as $attribute) {
                $rawFilename .= $attribute . ' ';
            }
            $rawFilename = substr($rawFilename, 0, sizeof($rawFilename) - 2);

            return Inflector::slug($rawFilename) . '.' . $type;
        } else {
            return null;
        }
    }

    /**
     * @param array $address
     *
     * @return null|string address from Array as String
     */
    private function stringifyAddress($address = [])
    {
        if (is_array($address)) {

            $address_string = '';
            foreach ($address as $component) {

                if ($component !== null) {
                    $address_string .= $component . ',';
                }
            }
            return substr($address_string, 0, sizeof($address_string) - 2);

        } else {
            return null;
        }
    }

    /**
     * @param $geoObject
     * @param bool $string set to true to get the address components as string
     *
     * @return array|string|null
     */
    private function getAddressComponents($geoObject, $string = false)
    {
        if (is_object($geoObject) && isset($geoObject->address_components)) {

            foreach ($geoObject->address_components as $address_component) {

                switch ($address_component->types[0]) {
                    case 'postal_code':
                        $postal_code = $address_component->short_name;
                        break;
                    case 'locality':
                        $locality = $address_component->long_name;
                        break;
                    case 'country':
                        $country      = $address_component->long_name;
                        $country_code = $address_component->short_name;
                        break;
                }
            }

            /**
             * build array with address components.
             * There are some more that can be added if needed
             */
            $address_array = [
                'postal_code'  => (isset($postal_code) ? $postal_code : null),
                'locality'     => (isset($locality) ? $locality : null),
                'country_code' => (isset($country_code) ? $country_code : null),
                'country'      => (isset($country) ? $country : null)
            ];

            if ($string === true) {
                return $this->stringifyAddress($address_array);
            } else {
                return $address_array;
            }
        } else {
            return null;
        }
    }

    /**
     * @param $short_country_code
     *
     * @return null|string
     */
    public static function getCountryByCode($short_country_code)
    {
        foreach (self::$countrycodes as $code => $country) {
            if (strtoupper($short_country_code) === $code) {
                return $country;
            }
        }
        return null;
    }
}