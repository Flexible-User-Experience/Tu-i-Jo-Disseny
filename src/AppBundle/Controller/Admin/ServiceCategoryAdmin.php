<?php

namespace AppBundle\Controller\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

/**
 * Class ServiceCategoryAdmin
 *
 * @category Controller
 * @package  AppBundle\Controller\Admin
 * @author   David Romaní <david@flux.cat>
 */
class ServiceCategoryAdmin extends Admin
{
    /**
     * Configure list view
     *
     * @param ListMapper $mapper
     */
    protected function configureListFields(ListMapper $mapper)
    {
        $mapper
            ->addIdentifier('name', null, array('label' => 'nom'))
            ->add(
                '_action',
                'actions',
                array(
                    'actions' => array(
                        'edit' => array(),
                        'delete' => array(),
                    ),
                    'label'   => 'actions',
                )
            );
    }

    /**
     * Configure list view filters
     *
     * @param DatagridMapper $datagrid
     */
    protected function configureDatagridFilters(DatagridMapper $datagrid)
    {
        $datagrid
            ->add('name', null, array(
                'label' => 'nom'
            ));
    }

    /**
     * Configure edit view
     *
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        // $myEntity = $this->getSubject();
        $formMapper
            ->add('name', 'text', array(
                'label' => 'nom',
            ));
    }

    /**
     * Configure route collection
     *
     * @param RouteCollection $collection
     *
     * @return mixed
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('export');
    }
}
