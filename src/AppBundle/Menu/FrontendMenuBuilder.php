<?php

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

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
     * @var UrlGeneratorInterface
     */
    private $router;

    /**
     * @var TokenStorageInterface
     */
    private $ts;

    /**
     *
     *
     * Methods
     *
     *
     */

    /**
     * @param FactoryInterface      $factory
     * @param AuthorizationChecker  $ac
     * @param TokenStorageInterface $ts
     * @param UrlGeneratorInterface $router
     */
    public function __construct(FactoryInterface $factory, AuthorizationChecker $ac, TokenStorageInterface $ts, UrlGeneratorInterface $router)
    {
        $this->factory = $factory;
        $this->ac      = $ac;
        $this->ts      = $ts;
        $this->router  = $router;
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
        if ($this->ts->getToken() && $this->ac->isGranted('ROLE_CMS')) {
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
            'front.services',
            array(
                'label'   => 'front.services',
                'uri'     => $this->router->generate('front_homepage') . '#serveis',
                'current' => $route == $this->router->generate('front_homepage') . '#serveis',
            )
        );
        $menu->addChild(
            'front.team',
            array(
                'label'   => 'front.about',
                'uri'     => $this->router->generate('front_homepage') . '#natros',
                'current' => $route == $this->router->generate('front_homepage') . '#natros',
            )
        );
        $menu->addChild(
            'front.headquarter',
            array(
                'label'   => 'front.headquarter',
                'uri'     => $this->router->generate('front_homepage') . '#estudi',
                'current' => $route == $this->router->generate('front_homepage') . '#estudi',
            )
        );
        $menu->addChild(
            'front.blog',
            array(
                'label'   => 'front.blog',
                'route'   => 'front_blog_posts_list',
                'current' => $route == 'front_blog_posts_list' || $route == 'front_blog_tag_detail' || $route == 'front_blog_posts_detail',
            )
        );
        $menu->addChild(
            'front.contact',
            array(
                'label'   => 'front.contact',
                'uri'     => $this->router->generate('front_homepage') . '#contacte',
                'current' => $route == $this->router->generate('front_homepage') . '#contacte',
            )
        );

        return $menu;
    }
}
