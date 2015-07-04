<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;

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
