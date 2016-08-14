<?php

namespace AppBundle\Admin;

use Ivory\CKEditorBundle\Form\Type\CKEditorType;
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
    protected $classnameLabel = 'Artícle';
    protected $baseRoutePattern = 'blog/article';
    protected $datagridValues = array('_sort_by' => 'publishedAt');

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
                'tags',
                null,
                array(
                    'label'    => 'Etiquetes',
                    'editable' => false,
                )
            )
            ->add(
                'publishedAt',
                'date',
                array(
                    'label'    => 'Data publicació',
                    'editable' => false,
                    'format'   => 'd/m/Y',
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
                'description',
                null,
                array(
                    'label' => 'Descripció',
                )
            )
            ->add(
                'tags',
                null,
                array(
                    'label' => 'Etiquetes',
                )
            )
            ->add(
                'publishedAt',
                null,
                array(
                    'label' => 'Data publicació',
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
            ->with('Article', array('class' => 'col-md-8'))
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
                'tags',
                null,
                array(
                    'label'    => 'Etiquetes',
                    'required' => false,
                )
            )
            ->add(
                'publishedAt',
                'sonata_type_date_picker',
                array(
                    'label' => 'Data publicació',
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
            ->end();
    }
}
