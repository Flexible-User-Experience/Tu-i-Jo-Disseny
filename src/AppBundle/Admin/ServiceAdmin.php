<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Class ServiceAdmin
 *
 * @category Admin
 * @package  AppBundle\Admin
 * @author   David Romaní <david@flux.cat>
 */
class ServiceAdmin extends BaseAdmin
{
    protected $baseRoutePattern = 'services/service';
    protected $datagridValues = array('_sort_by' => 'category.position');

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
                'category',
                null,
                array(
                    'label'    => 'Categoria',
                    'editable' => false,
                )
            )
            ->add(
                'position',
                null,
                array(
                    'label'    => 'Posició',
                    'editable' => true,
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
                'category',
                null,
                array(
                    'label' => 'Categoria',
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
        // $myEntity = $this->getSubject();
        $formMapper
            ->with('Servei', array('class' => 'col-md-7'))
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
                'category',
                null,
                array(
                    'label'    => 'Categoria',
                    'required' => true,
                )
            )
            ->end()
            ->with('Imatge', array('class' => 'col-md-5'))
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
            ->with('Traduccions', array('class' => 'col-md-7'))
            ->add(
                'translations',
                'a2lix_translations_gedmo',
                array(
                    'required'           => false,
                    'label'              => ' ',
                    'translatable_class' => 'AppBundle\Entity\Translations\ServiceCategoryTranslation',
                    'fields'             => array(
                        'name' => array(
                            'label'    => 'Nom',
                            'required' => false,
                        ),
                        'description' => array(
                            'label'    => 'Descripció',
                            'required' => false,
                            'attr'  => array(
                                'style' => 'resize:vertical',
                                'rows'  => 13,
                            )
                        ),
                    ),
                )
            )
            ->end()
            ->with('Controls', array('class' => 'col-md-5'))
            ->add(
                'position',
                null,
                array(
                    'label' => 'Posició',
                )
            )
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
