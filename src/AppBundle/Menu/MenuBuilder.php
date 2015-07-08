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
     * @param array            $options
     *
     * @return ItemInterface
     */
    public function frontendMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem(
            'root',
            array(
                'navbar' => true,
            )
        );
        $menu->addChild(
            'Serveis', // TODO apply i18n
            array(
                //'icon'  => 'home',
                'route' => 'front_services',
            )
        );
        $menu->addChild(
            'Projectes', // TODO apply i18n
            array(
                //'icon'  => 'home',
                'route' => 'front_projects',
            )
        );

        return $menu;
    }
}
