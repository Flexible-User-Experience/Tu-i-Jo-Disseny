<?php

namespace AppBundle\Service;

use Ivory\GoogleMap\Overlays\Animation;
use Ivory\GoogleMap\Overlays\Marker;
use Ivory\GoogleMap\Map;

/**
 * Class GoogleMapsService
 *
 * @category Service
 * @package  AppBundle\Service
 * @author   David Romaní <david@flux.cat>
 */
class GoogleMapsService
{
    /**
     * @var string
     */
    private $locale;

    /**
     * Methods
     */

    /**
     * GoogleMapsService constructor
     *
     * @param string $locale
     */
    public function __construct($locale)
    {
        $this->locale = $locale;
    }

    /**
     * Build a Google Map
     *
     * @param float       $latitude
     * @param float       $longitude
     * @param int         $zoom
     * @param string|null $language
     *
     * @return Map
     * @throws \Ivory\GoogleMap\Exception\AssetException
     * @throws \Ivory\GoogleMap\Exception\MapException
     * @throws \Ivory\GoogleMap\Exception\OverlayException
     */
    public function buildMap($latitude, $longitude, $zoom = 15, $language = null)
    {
        if (!$language) {
            $language = $this->locale;
        }
        /** @var Marker $marker */
        $marker = new Marker();
        $marker->setPrefixJavascriptVariable('marker_');
        $marker->setPosition($latitude, $longitude, true);
        $marker->setAnimation(Animation::DROP);
        /** @var Map $map */
        $map = new Map();
        $map->setStylesheetOption('width', '100%');
        $map->setStylesheetOption('height', '100%');
        // https://snazzymaps.com/style/151/ultra-light-with-labels
        $map->setMapOption('styles' , [
            [
                'featureType' => 'water',
                'elementType' => 'geometry',
                'stylers'     =>
                    [
                        [ 'color'     => '#e9e9e9' ],
                        [ 'lightness' => 17 ],
                    ],
            ],
            [
                'featureType' => 'landscape',
                'elementType' => 'geometry',
                'stylers'     =>
                    [
                        [ 'color'     => '#f5f5f5' ],
                        [ 'lightness' => 15 ],
                    ],
            ],
            [
                'featureType' => 'road.highway',
                'elementType' => 'geometry.fill',
                'stylers'     =>
                    [
                        [ 'color'     => '#ffffff' ],
                        [ 'lightness' => 17 ],
                    ],
            ],
            [
                'featureType' => 'road.arterial',
                'elementType' => 'geometry',
                'stylers'     =>
                    [
                        [ 'color'     => '#ffffff' ],
                        [ 'lightness' => 18 ],
                    ],
            ],
            [
                'featureType' => 'road.local',
                'elementType' => 'geometry',
                'stylers'     =>
                    [
                        [ 'color'     => '#ffffff' ],
                        [ 'lightness' => 16 ],
                    ],
            ],
            [
                'featureType' => 'poi',
                'elementType' => 'geometry',
                'stylers'     =>
                    [
                        [ 'color'     => '#f5f5f5' ],
                        [ 'lightness' => 21 ],
                    ],
            ],
            [
                'featureType' => 'poi.park',
                'elementType' => 'geometry',
                'stylers'     =>
                    [
                        [ 'color'     => '#dedede' ],
                        [ 'lightness' => 21 ],
                    ],
            ],
            [
                'featureType' => 'transit',
                'elementType' => 'geometry',
                'stylers'     =>
                    [
                        [ 'color'     => '#f2f2f2' ],
                        [ 'lightness' => 19 ],
                    ],
            ],
            [
                'featureType' => 'administrative',
                'elementType' => 'geometry.fill',
                'stylers'     =>
                    [
                        [ 'color'     => '#fefefe' ],
                        [ 'lightness' => 20 ],
                    ],
            ],
            [
                'featureType' => 'administrative',
                'elementType' => 'geometry.stroke',
                'stylers'     =>
                    [
                        [ 'color'     => '#fefefe' ],
                        [ 'lightness' => 17 ],
                        [ 'weight'    => 1.2 ],
                    ],
            ],
        ]);
        $map->setLanguage($language);
        $map->setCenter($latitude, $longitude, true);
        $map->setMapOption('zoom', $zoom);
        $map->addMarker($marker);

        return $map;
    }
}
