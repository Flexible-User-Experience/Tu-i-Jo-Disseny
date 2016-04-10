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
    /** @var string */
    private $locale;

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
        $map->setLanguage($language);
        $map->setCenter($latitude, $longitude, true);
        $map->setMapOption('zoom', $zoom);
        $map->addMarker($marker);

        return $map;
    }
}
