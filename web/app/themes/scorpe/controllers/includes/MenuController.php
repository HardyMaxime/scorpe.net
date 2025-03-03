<?php

class MenuController
{
    private static $_instance; // L'attribut qui stockera l'instance unique

    /**
    * La méthode statique qui permet d'instancier ou de récupérer l'instance unique
    **/
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new MenuController();
        }
        return self::$_instance;
    }

    public function __construct()
    {

    }

    public static function getMainMenu()
    {
        $location = get_nav_menu_locations();
        $menu = wp_get_nav_menu_object($location[MAIN_MENU]);
        $menu_items = wp_get_nav_menu_items($menu->term_id);
        return $menu_items;
    }

    public static function getSecondaryMenu()
    {
        $location = get_nav_menu_locations();
        $menu = wp_get_nav_menu_object($location[SECONDARY_MENU]);
        $menu_items = wp_get_nav_menu_items($menu->term_id);
        return $menu_items;
    }
}