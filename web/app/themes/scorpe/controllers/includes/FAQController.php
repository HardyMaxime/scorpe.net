<?php

class FAQController 
{
    private static $_instance; // L'attribut qui stockera l'instance unique

    /**
    * La méthode statique qui permet d'instancier ou de récupérer l'instance unique
    **/
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new FAQController();
        }
        return self::$_instance;
    }

    public function __construct()
    {
        add_filter('acf/fields/flexible_content/layout_title/name=page_faq_listing', array( static::class, 'adminTitleFAQ' ), 10, 4);
    }

    public static function adminTitleFAQ($title, $field, $layout, $i)
    {
        $text = (get_sub_field('title') ? (get_sub_field('title')) : false);
        $title = "Question";
        if( $text ) {
            $title = '<b>' . esc_html(substr($text, 0,100)) . '</b>';
        }
        return $title;
    }

}
