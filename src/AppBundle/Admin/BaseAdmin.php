<?php

namespace AppBundle\Admin;

use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Route\RouteCollection;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

/**
 * Class BaseAdmin
 *
 * @category Admin
 * @package  AppBundle\Admin
 * @author   David Romaní <david@flux.cat>
 */
abstract class BaseAdmin extends AbstractAdmin
{
    /**
     * @var array
     */
    protected $perPageOptions = array(25, 50, 100, 200);

    /**
     * @var int
     */
    protected $maxPerPage = 25;

    /**
     * Configure route collection
     *
     * @param RouteCollection $collection
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('show');
        $collection->remove('batch');
    }

    /**
     * Remove batch action list view first column
     *
     * @return array
     */
    public function getBatchActions()
    {
        $actions = parent::getBatchActions();
        unset($actions['delete']);

        return $actions;
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

    /**
     * Get image helper form mapper with thumbnail
     *
     * @return string
     */
    protected function getImageHelperFormMapperWithThumbnail()
    {
        /** @var CacheManager $lis */
        $lis = $this->getConfigurationPool()->getContainer()->get('liip_imagine.cache.manager');
        /** @var UploaderHelper $vus */
        $vus = $this->getConfigurationPool()->getContainer()->get('vich_uploader.templating.helper.uploader_helper');

        return ($this->getSubject()->getImageName() ? '<img src="' . $lis->getBrowserPath($vus->asset($this->getSubject(), 'imageFile'), '480xY') . '" class="admin-preview" style="width:100%;" alt=""/>' : '') . '<span style="width:100%;display:block;">Màxim 10MB amb format PNG, JPG o GIF. Imatge amb amplada mínima de 1.200px.</span>';
    }

    /**
     * Get project image helper form mapper with thumbnail
     *
     * @return string
     */
    protected function getProjectImageHelperFormMapperWithThumbnail()
    {
        /** @var CacheManager $lis */
        $lis = $this->getConfigurationPool()->getContainer()->get('liip_imagine.cache.manager');
        /** @var UploaderHelper $vus */
        $vus = $this->getConfigurationPool()->getContainer()->get('vich_uploader.templating.helper.uploader_helper');

        return ($this->getSubject() ? $this->getSubject()->getImageName() ? '<img src="' . $lis->getBrowserPath($vus->asset($this->getSubject(), 'imageFile'), '480xY') . '" class="admin-preview" style="width:100%;" alt=""/>' : '' : '') . '<span style="width:100%;display:block;">Màxim 10MB amb format PNG, JPG o GIF. Imatge amb amplada mínima de 1.200px.</span>';
    }

    /**
     * Get image2 helper form mapper with thumbnail
     *
     * @return string
     */
    protected function getImage2HelperFormMapperWithThumbnail()
    {
        /** @var CacheManager $lis */
        $lis = $this->getConfigurationPool()->getContainer()->get('liip_imagine.cache.manager');
        /** @var UploaderHelper $vus */
        $vus = $this->getConfigurationPool()->getContainer()->get('vich_uploader.templating.helper.uploader_helper');

        return ($this->getSubject()->getImageName2() ? '<img src="' . $lis->getBrowserPath($vus->asset($this->getSubject(), 'imageFile2'), '480xY') . '" class="admin-preview" style="width:100%;" alt=""/>' : '') . '<span style="width:100%;display:block;">Màxim 10MB amb format PNG, JPG o GIF. Imatge amb amplada mínima de 1.200px.</span>';
    }
}
