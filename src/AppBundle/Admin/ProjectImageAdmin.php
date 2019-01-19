<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

/**
 * Class ProjectImageAdmin.
 *
 * @category Admin
 *
 * @author   David Romaní <david@flux.cat>
 */
class ProjectImageAdmin extends BaseAdmin
{
    protected $classnameLabel = 'Imatge';
    protected $baseRoutePattern = 'web/imatge-projecte';
    protected $datagridValues = array('_sort_by' => 'position');

    /**
     * Configure list view.
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
                    'label' => 'Imatge',
                    'template' => '::Admin/list__cell_image_field.html.twig',
                )
            )
            ->add(
                'project',
                null,
                array(
                    'label' => 'Projecte',
                    'editable' => false,
                    'sortable' => true,
                    'sort_field_mapping' => array('fieldName' => 'name'),
                    'sort_parent_association_mappings' => array(array('fieldName' => 'project')),
                )
            )
            ->add(
                'position',
                null,
                array(
                    'label' => 'Posició',
                    'editable' => true,
                )
            )
            ->add(
                'enabled',
                null,
                array(
                    'label' => 'Actiu',
                    'editable' => true,
                )
            )
            ->add(
                '_action',
                'actions',
                array(
                    'actions' => array(
                        'edit' => array('template' => '::Admin/Buttons/list__action_edit_button.html.twig'),
                        'delete' => array('template' => '::Admin/Buttons/list__action_delete_button.html.twig'),
                    ),
                    'label' => 'Accions',
                )
            )
        ;
    }

    /**
     * Configure list view filters.
     *
     * @param DatagridMapper $datagrid
     */
    protected function configureDatagridFilters(DatagridMapper $datagrid)
    {
        $datagrid
            ->add(
                'project',
                null,
                array(
                    'label' => 'Projecte',
                )
            )
            ->add(
                'enabled',
                null,
                array(
                    'label' => 'Actiu',
                )
            )
        ;
    }

    /**
     * Configure edit view.
     *
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $imageHelp = $this->getProjectImageHelperFormMapperWithThumbnail();
        $formMapper
            ->with('Imatge', array('class' => 'col-md-6'))
            ->add(
                'imageFile',
                FileType::class,
                array(
                    'label' => 'Arxiu',
                    'required' => false,
                    'sonata_help' => $imageHelp,
                    'help' => $imageHelp,
                )
            )
            ->add(
                'project',
                null,
                array(
                    'label' => 'Projecte',
                    'attr' => array(
                        'hidden' => true,
                    ),
                )
            )
            ->end()
            ->with('Controls', array('class' => 'col-md-6'))
            ->add(
                'position',
                null,
                array(
                    'label' => 'Posició',
                )
            )
            ->add(
                'enabled',
                CheckboxType::class,
                array(
                    'label' => 'Actiu',
                    'required' => false,
                )
            )
            ->end()
        ;
    }
}
