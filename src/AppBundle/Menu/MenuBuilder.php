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
     * @param FactoryInterface $factory
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
                'route' => 'front_services',
            )
        );
        $menu->addChild(
            'front.projects',
            array(
                'route' => 'front_projects',
                'current' => true,
            )
        );
        $menu->addChild(
            'front.partners',
            array(
                'route' => 'front_partners',
            )
        );
        $menu->addChild(
            'front.blog',
            array(
                'route' => 'front_blog',
            )
        );

        return $menu;
    }
}
