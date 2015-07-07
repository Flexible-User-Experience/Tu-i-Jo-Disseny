<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Class BlogPostAdmin
 *
 * @category Admin
 * @package  AppBundle\Admin
 * @author   David Romaní <david@flux.cat>
 */
class BlogPostAdmin extends BaseAdmin
{
    protected $baseRoutePattern = 'blog/post';
    protected $datagridValues = array('_sort_by' => 'publishedAt');

    /**
     * Configure list view
     *
     * @param ListMapper $mapper
     */
    protected function configureListFields(ListMapper $mapper)
    {
        $mapper
            ->add(
                'imageFile',
                null,
                array(
                    'label'    => 'Imatge',
                    'template' => '::Admin/list__cell_image_field.html.twig'
                )
            )
            ->add(
                'name',
                null,
                array(
                    'label'    => 'Nom',
                    'editable' => true,
                )
            )
            ->add(
                'tags',
                null,
                array(
                    'label'    => 'Etiquetes',
                    'editable' => false,
                )
            )
            ->add(
                'publishedAt',
                null,
                array(
                    'label'    => 'Data publicació',
                    'editable' => false,
                )
            )
            ->add(
                'enabled',
                null,
                array(
                    'label'    => 'Actiu',
                    'editable' => true,
                )
            )
            ->add(
                '_action',
                'actions',
                array(
                    'actions' => array(
                        'edit'   => array(),
                    ),
                    'label'   => 'Accions',
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
            ->add(
                'name',
                null,
                array(
                    'label' => 'Nom',
                )
            )
            ->add(
                'tags',
                null,
                array(
                    'label'    => 'Etiquetes',
                )
            )
            ->add(
                'publishedAt',
                null,
                array(
                    'label'    => 'Data publicació',
                )
            )
            ->add(
                'enabled',
                null,
                array(
                    'label' => 'Actiu',
                )
            );
    }

    /**
     * Configure edit view
     *
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Article', array('class' => 'col-md-6'))
            ->add(
                'name',
                null,
                array(
                    'label' => 'Nom',
                )
            )
            ->add(
                'description',
                null,
                array(
                    'label' => 'Descripció',
                    'attr'  => array(
                        'style' => 'resize:vertical',
                        'rows'  => 13,
                    )
                )
            )
            ->add(
                'tags',
                null,
                array(
                    'label'    => 'Etiquetes',
                    'required' => false,
                )
            )
            ->add(
                'publishedAt',
                null,
                array(
                    'label'    => 'Data publicació',
                )
            )
            ->end()
            ->with('Imatge', array('class' => 'col-md-6'))
            ->add(
                'imageFile',
                'file',
                array(
                    'label'    => 'Arxiu',
                    'required' => false,
                    'help'     => $this->getImageHelperFormMapperWithThumbnail(),
                )
            )
            ->end()
            ->with('Controls', array('class' => 'col-md-6'))
            ->add(
                'enabled',
                null,
                array(
                    'label'    => 'Actiu',
                    'required' => false,
                )
            )
            ->end();
    }
}
