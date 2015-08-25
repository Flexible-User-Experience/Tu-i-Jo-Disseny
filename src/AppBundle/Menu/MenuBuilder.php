<?php

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;

/**
 * Class MenuBuilder
 *
 * @category Menu
 * @package  AppBundle\Repository
 * @author   David Romaní <david@flux.cat>
 */
class MenuBuilder
{
    /**
     * Create frontend main menu
     *
     * @return ItemInterface
     */
    public function frontendMenu(FactoryInterface $factory)
    {
        $menu = $factory->createItem(
            'root',
            array(
                'navbar' => true,
            )
        );
        $menu->addChild(
            'front.services',
            array(
                //'icon'  => 'home',
                'route' => 'front_services',
            )
        );
        $menu->addChild(
            'front.projects',
            array(
                //'icon'  => 'home',
                'route' => 'front_projects',
            )
        );
        $menu->addChild(
            'front.partners',
            array(
                //'icon'  => 'home',
                'route' => 'front_partners',
            )
        );
        $menu->addChild(
            'front.blog',
            array(
                //'icon'  => 'home',
                'route' => 'front_blog',
            )
        );

        return $menu;
    }
}
