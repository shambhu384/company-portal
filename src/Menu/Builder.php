<?php

namespace App\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function mainMenu(FactoryInterface $factory)
    {
        $menu = $factory->createItem('root');

        $menu->addChild('Home', ['route' => 'homepage']);


        $menu->addChild('Latest Blog Post', [
           'route' => 'article_index'
        ]);

        // create another menu item
        $menu->addChild('About Me', ['route' => 'about']);
        // you can also add sub levels to your menus as follows
        $menu['About Me']->addChild('Edit profile', ['route' => 'edit_profile']);

        // ... add more children

        return $menu;
    }
}
