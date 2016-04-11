<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Class PartnerAdmin
 *
 * @category Admin
 * @package  AppBundle\Admin
 * @author   David Romaní <david@flux.cat>
 */
class PartnerAdmin extends BaseAdmin
{
    protected $classnameLabel = 'Equip';
    protected $baseRoutePattern = 'web/equip';
    protected $datagridValues = array('_sort_by' => 'name');

    /**
     * Configure list view
     *
     * @param ListMapper $mapper
     */
    protected function configureListFields(ListMapper $mapper)
    {
        unset($this->listModes['mosaic']);
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
                'studies',
                null,
                array(
                    'label'    => 'Estudis',
                    'editable' => true,
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
                        'edit'   => array('template' => '::Admin/Buttons/list__action_edit_button.html.twig'),
                        'delete' => array('template' => '::Admin/Buttons/list__action_delete_button.html.twig'),
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
                'studies',
                null,
                array(
                    'label' => 'Estudis',
                )
            )
            ->add(
                'description',
                null,
                array(
                    'label' => 'Descripció',
                )
            )
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
            ->with('Equip', array('class' => 'col-md-8'))
            ->add(
                'name',
                null,
                array(
                    'label' => 'Nom',
                )
            )
            ->add(
                'studies',
                null,
                array(
                    'label' => 'Estudis',
                )
            )
            ->add(
                'description',
                'ckeditor',
                array(
                    'label'       => 'Descripció',
                    'required'    => false,
                    'config_name' => 'my_config',
                    'attr'        => array(
                        'style' => 'resize:vertical',
                        'rows'  => 14,
                    )
                )
            )
            ->end()
            ->with('Controls', array('class' => 'col-md-4'))
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
            ->end()
            ->with('Imatge pricipal', array('class' => 'col-md-5'))
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
            ->with('Imatge secundaria', array('class' => 'col-md-5'))
            ->add(
                'imageFile2',
                'file',
                array(
                    'label'    => 'Arxiu',
                    'required' => false,
                    'help'     => $this->getImage2HelperFormMapperWithThumbnail(),
                )
            )
            ->end();
    }
}
