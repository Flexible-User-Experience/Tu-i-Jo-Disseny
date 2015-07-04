<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Route\RouteCollection;

/**
 * Class BaseAdmin
 *
 * @category Admin
 * @package  AppBundle\Admin
 * @author   David Romaní <david@flux.cat>
 */
abstract class BaseAdmin extends Admin
{
    /**
     * Configure route collection
     *
     * @param RouteCollection $collection
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('show');
    }

    /**
     * Get export formats
     *
     * @return array
     */
    public function getExportFormats()
    {
        return array(
            'csv',
            'xls',
        );
    }
}
