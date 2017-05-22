<?php

namespace AppBundle\Service;

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Overlay\Animation;
use Ivory\GoogleMap\Overlay\Marker;
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
     *
     * @return Map
     */
    public function buildMap($latitude, $longitude, $zoom = 15)
    {
        $position = new Coordinate($latitude, $longitude);
        $marker = new Marker($position);
        $marker->setAnimation(Animation::DROP);
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
        $map->setCenter($position);
        $map->setMapOption('zoom', $zoom);
        $map->getOverlayManager()->addMarker($marker);

        return $map;
    }
}
