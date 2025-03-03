<?php

class AboutController 
{
    private static $_instance; // L'attribut qui stockera l'instance unique

    /**
    * La méthode statique qui permet d'instancier ou de récupérer l'instance unique
    **/
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new AboutController();
        }
        return self::$_instance;
    }

    public function __construct()
    {
        add_filter('acf/fields/flexible_content/layout_title/name=philosophy_content', array( $this, 'adminOrganisationTitle' ), 10, 4);
        add_filter('acf/fields/flexible_content/layout_title/name=product_conception_milestone', array( $this, 'adminConceptionTitle' ), 10, 4);
        add_filter('acf/fields/flexible_content/layout_title/name=facilities_listing', array( $this, 'adminFacilitiesTitle' ), 10, 4);
    }

    public static function adminOrganisationTitle($title, $field, $layout, $i)
    {
        $text = (get_sub_field('text') ? (get_sub_field('text')) : false);
        $title = "Timeline";
        if( $text ) {
            $title = '<b>' . esc_html(strip_tags(substr($text, 0,100))) . '</b>';
        }
        return $title;
    }

    public static function adminConceptionTitle($title, $field, $layout, $i)
    {
        $text = (get_sub_field('title') ? (get_sub_field('title')) : false);
        $title = "Timeline";
        if( $text ) {
            $title = '<b>' . esc_html(strip_tags(substr($text, 0,100))) . '</b>';
        }
        return $title;
    }

    public static function adminFacilitiesTitle($title, $field, $layout, $i)
    {
        $text = (get_sub_field('name') ? (get_sub_field('name')) : false);
        $title = "Timeline";
        if( $text ) {
            $title = '<b>' . esc_html(strip_tags(substr($text, 0,100))) . '</b>';
        }
        return $title;
    }

    public static function getAboutBanners(string $page_id, string $param = ""): array
    {
        $top = DefaultController::field_value("page_history_banner", $page_id) ?? false;
        $bottom = DefaultController::field_value("facilities_banner", $page_id) ?? false;

        $banner = array(
            "top" => $top,
            "bottom" => $bottom
        );

        if(!empty($param) && array_key_exists($param, $banner)) return $banner[$param];
        return $banner;
    }

    public static function getPhilosophyContent(string $page_id, string $param = ""): bool|array|string
    {
        $content = DefaultController::field_value('page_history', $page_id) ?? false;
        if(!empty($param) && array_key_exists($param, $content)) return $content[$param];
        return $content;
    }
}
