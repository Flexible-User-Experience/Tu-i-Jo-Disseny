<?php

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;

/**
 * Class MenuBuilder
 *
 * @category Menu
 * @package  AppBundle\Repository
 * @author   David Romaní <david@flux.cat>
 */
class FrontendMenuBuilder
{
    /**
     * @var FactoryInterface
     */
    private $factory;

    /**
     * @var AuthorizationChecker
     */
    private $ac;

    /**
     *
     *
     * Methods
     *
     *
     */

    /**
     * @param FactoryInterface     $factory
     * @param AuthorizationChecker $ac
     */
    public function __construct(FactoryInterface $factory, AuthorizationChecker $ac)
    {
        $this->factory = $factory;
        $this->ac = $ac;
    }

    /**
     * @param RequestStack $requestStack
     *
     * @return ItemInterface
     */
    public function createTopMenu(RequestStack $requestStack)
    {
        $route = $requestStack->getCurrentRequest()->get('_route');
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav navbar-right top-menu');
        if ($this->ac->isGranted('ROLE_CMS')) {
            $menu->addChild(
                'admin',
                array(
                    'label' => 'front.cms',
                    'route' => 'sonata_admin_dashboard',
                )
            );
        }
        $menu->addChild(
            'front.projects',
            array(
                'label'   => 'front.projects',
                'route'   => 'front_projects',
                'current' => $route == 'front_projects' || $route == 'front_project_detail',
            )
        );
        $menu->addChild(
            'front.blog',
            array(
                'label'   => 'front.blog',
                'route'   => 'front_blog_posts_list',
                'current' => $route == 'front_blog_posts_list' || $route == 'front_blog_posts_detail',
            )
        );

        return $menu;
    }
}
