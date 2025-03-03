<?php

class ServiceController 
{
    private static $_instance; // L'attribut qui stockera l'instance unique

    /**
    * La méthode statique qui permet d'instancier ou de récupérer l'instance unique
    **/
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new ServiceController();
        }
        return self::$_instance;
    }

    public function __construct()
    {
        add_filter('acf/fields/flexible_content/layout_title/name=timeline_service', array( $this, 'adminTimelineTitle' ), 10, 4);
    }

    public static function adminTimelineTitle($title, $field, $layout, $i)
    {
        $text = (get_sub_field('title') ? (get_sub_field('title')) : false);
        $title = "Timeline";
        if( $text ) {
            $title = '<b>' . esc_html(substr($text, 0,100)) . '</b>';
        }
        return $title;
    }

    public static function getTrainingPartContent(string $page_id,string $param = ""): bool|array|string
    {
        $content = DefaultController::field_value('section_training', $page_id) ?? false;
        if(!empty($param) && array_key_exists($param, $content)) return $content[$param];
        return $content;
    }

    public static function getServicePartContent(string $page_id,string $param = ""): bool|array|string
    {
        $content = DefaultController::field_value('section_service', $page_id) ?? false;
        if(!empty($param) && array_key_exists($param, $content)) return $content[$param];
        return $content;
    }

}
