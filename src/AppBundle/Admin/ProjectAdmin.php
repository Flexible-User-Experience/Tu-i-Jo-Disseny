<?php

namespace AppBundle\Admin;

use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\Form\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

/**
 * Class ServiceAdmin.
 *
 * @category Admin
 *
 * @author   David Romaní <david@flux.cat>
 */
class ProjectAdmin extends BaseAdmin
{
    protected $classnameLabel = 'Projecte';
    protected $baseRoutePattern = 'web/projecte';
    protected $datagridValues = array('_sort_by' => 'name');

    /**
     * @param RouteCollection $collection
     */
    public function configureRoutes(RouteCollection $collection)
    {
        parent::configureRoutes($collection);
        $collection->add('preview', $this->getRouterIdParameter().'/preview');
    }

    /**
     * Configure list view.
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
                    'label' => 'Imatge',
                    'template' => '::Admin/list__cell_image_field.html.twig',
                )
            )
            ->add(
                'name',
                null,
                array(
                    'label' => 'Nom',
                    'editable' => true,
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
                'showInHomepage',
                null,
                array(
                    'label' => 'Homepage',
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
                        'preview' => array('template' => '::Admin/Buttons/list__action_preview_button.html.twig'),
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
                )
            )
            ->add(
                'services',
                null,
                array(
                    'label' => 'Serveis',
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
                'showInHomepage',
                null,
                array(
                    'label' => 'Homepage',
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
        $formMapper
            ->with('Projecte', array('class' => 'col-md-8'))
            ->add(
                'name',
                null,
                array(
                    'label' => 'Nom',
                )
            )
            ->add(
                'description',
                CKEditorType::class,
                array(
                    'label' => 'Descripció',
                    'config_name' => 'my_config',
                    'attr' => array(
                        'style' => 'resize:vertical',
                        'rows' => 14,
                    ),
                )
            )
            ->end()
            ->with('Controls', array('class' => 'col-md-4'))
            ->add(
                'services',
                null,
                array(
                    'label' => 'Serveis',
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
                'showInHomepage',
                null,
                array(
                    'label' => 'Mostrar a la homepage',
                    'required' => false,
                )
            )
            ->add(
                'enabled',
                null,
                array(
                    'label' => 'Actiu',
                    'required' => false,
                )
            )
            ->end()
            ->with('Imatge principal', array('class' => 'col-md-5'))
            ->add(
                'imageFile',
                FileType::class,
                array(
                    'label' => 'Arxiu',
                    'required' => false,
                    'help' => $this->getImageHelperFormMapperWithThumbnail(),
                )
            )
            ->end();
        if ($this->id($this->getSubject())) { // only on edit mode, disable when creating new subjects
            $formMapper
                ->with('Imatges addicionals', array('class' => 'col-md-7'))
                ->add(
                    'images',
                    CollectionType::class,
                    array(
                        'label' => ' ',
                        'required' => false,
                        'cascade_validation' => true,
                    ),
                    array(
                        'edit' => 'inline',
                        'inline' => 'table',
                        'sortable' => 'position',
                    )
                )
                ->end()
            ;
        }
    }
}
