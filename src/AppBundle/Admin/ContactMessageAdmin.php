<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

/**
 * Class ContactMessageAdmin
 *
 * @category Admin
 * @package  AppBundle\Admin
 * @author   David Romaní <david@flux.cat>
 */
class ContactMessageAdmin extends BaseAdmin
{
    protected $classnameLabel = 'Missatge contacte';
    protected $baseRoutePattern = 'contactes/missatge';
    protected $datagridValues = array(
        '_sort_by'    => 'createdAt',
        '_sort_order' => 'desc',
    );

    /**
     * Configure route collection
     *
     * @param RouteCollection $collection
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection
            ->remove('create')
            ->remove('edit')
            ->remove('delete')
            ->remove('batch')
            ->add('answer', $this->getRouterIdParameter() . '/answer');
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add(
                'checked',
                null,
                array(
                    'label' => 'Llegit',
                )
            )
            ->add(
                'createdAt',
                'doctrine_orm_date',
                array(
                    'label'      => 'Data',
                    'field_type' => 'sonata_type_date_picker',
                )
            )
            ->add(
                'name',
                null,
                array(
                    'label' => 'Nom',
                )
            )
            ->add(
                'email',
                null,
                array(
                    'label' => 'Email',
                )
            )
            ->add(
                'phone',
                null,
                array(
                    'label' => 'Telèfon',
                )
            )
            ->add(
                'message',
                null,
                array(
                    'label' => 'Missatge',
                )
            )
            ->add(
                'answered',
                null,
                array(
                    'label' => 'Contestat',
                )
            )
            ->add(
                'answer',
                null,
                array(
                    'label' => 'Resposta',
                )
            );
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add(
                'checked',
                null,
                array(
                    'label' => 'Llegit',
                )
            )
            ->add(
                'createdAt',
                'date',
                array(
                    'label'  => 'Data',
                    'format' => 'd/m/Y H:i',
                )
            )
            ->add(
                'name',
                null,
                array(
                    'label' => 'Nom',
                )
            )
            ->add(
                'email',
                null,
                array(
                    'label' => 'Email',
                )
            )
            ->add(
                'phone',
                null,
                array(
                    'label' => 'Telèfon',
                )
            )
            ->add(
                'message',
                'textarea',
                array(
                    'label' => 'Missatge',
                )
            )
            ->add(
                'answered',
                null,
                array(
                    'label' => 'Contestat',
                )
            );
        if ($this->getSubject()->getAnswered()) {
            $showMapper
                ->add(
                    'answer',
                    'textarea',
                    array(
                        'label' => 'Resposta',
                    )
                );
        }
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        unset($this->listModes['mosaic']);
        $listMapper
            ->add(
                'checked',
                null,
                array(
                    'label' => 'Llegit',
                )
            )
            ->add(
                'createdAt',
                'date',
                array(
                    'label'  => 'Data',
                    'format' => 'd/m/Y'
                )
            )
            ->add(
                'name',
                null,
                array(
                    'label' => 'Nom',
                )
            )
            ->add(
                'email',
                null,
                array(
                    'label' => 'Email',
                )
            )
            ->add(
                'phone',
                null,
                array(
                    'label' => 'Telèfon',
                )
            )
            ->add(
                'answered',
                null,
                array(
                    'label' => 'Contestat',
                )
            )
            ->add(
                '_action',
                'actions',
                array(
                    'actions' => array(
                        'show'   => array(
                            'template' => '::Admin/Buttons/list__action_show_button.html.twig'
                        ),
                        'answer' => array(
                            'template' => '::Admin/Cells/list__action_answer.html.twig'
                        )
                    ),
                )
            );
    }
}
