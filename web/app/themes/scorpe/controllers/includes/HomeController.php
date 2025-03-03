<?php

class HomeController
{
    private static $_instance; // L'attribut qui stockera l'instance unique
    /**
    * La méthode statique qui permet d'instancier ou de récupérer l'instance unique
    **/
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new HomeController();
        }
        return self::$_instance;
    }

    public function __construct()
    {
        add_filter('acf/fields/flexible_content/layout_title/name=header', array( $this, 'adminTitleHeader' ), 10, 4);
        add_filter('acf/fields/flexible_content/layout_title/name=FR_header', array( $this, 'FR_adminTitleHeader' ), 10, 4);

        add_filter('acf/fields/flexible_content/layout_title/name=home_about', array( $this, 'adminHomeAbout' ), 10, 4);
        add_filter('acf/fields/flexible_content/layout_title/name=FR_home_about', array( $this, 'FR_adminHomeAbout' ), 10, 4);

        add_filter('acf/fields/flexible_content/layout_title/name=section_inter', array( $this, 'adminInternational' ), 10, 4);
        add_filter('acf/fields/flexible_content/layout_title/name=FR_section_inter', array( $this, 'FR_adminInternational' ), 10, 4);

        add_filter('acf/fields/flexible_content/layout_title/name=listing', array( $this, 'adminDemoListing' ), 10, 4);
        //add_filter('acf/fields/flexible_content/layout_title/name=FR_listing', array( $this, 'FR_adminDemoListing' ), 10, 4);
    }

    public static function adminTitleHeader($title, $field, $layout, $i)
    {
        $text = (get_sub_field('content') ? (get_sub_field('content')) : false);
        $title = "Slide of the header";
        if( $text ) {
            $title = '<b>' . esc_html(substr($text['label_pagination'], 0,100)) . '</b>';
        }
        return $title;
    }
    
    public static function adminHomeAbout($title, $field, $layout, $i)
    {
        $text = (get_sub_field('title') ? (get_sub_field('title')) : false);
        $title = "Content";
        if( $text ) {
            $title = '<b>' . esc_html(substr($text, 0,100)) . '</b>';
        }
        return $title;
    }
    
    public static function adminInternational($title, $field, $layout, $i)
    {
        $text = (get_sub_field('content') ? (get_sub_field('content')) : false);
        $title = "Slide of the section";
        if( $text ) {
            $title = '<b>' . esc_html(substr($text['label_pagination'], 0,100)) . '</b>';
        }
        return $title;
    }

    public static function adminDemoListing($title, $field, $layout, $i)
    {
        $text = (get_sub_field('title') ? (get_sub_field('title')) : false);
        $title = "Content";
        if( $text ) {
            $title = '<b>' . esc_html(substr($text, 0,100)) . '</b>';
        }
        return $title;
    }

    public static function FR_adminTitleHeader($title, $field, $layout, $i)
    {
        $text = (get_sub_field('content') ? (get_sub_field('content')) : false);
        $title = "Diapositive";
        if( $text ) {
            $title = '<b>' . esc_html(substr($text['label_pagination'], 0,100)) . '</b>';
        }
        return $title;
    }

    public static function FR_adminHomeAbout($title, $field, $layout, $i)
    {
        $text = (get_sub_field('title') ? (get_sub_field('title')) : false);
        $title = "Contenu";
        if( $text ) {
            $title = '<b>' . esc_html(substr($text, 0,100)) . '</b>';
        }
        return $title;
    }

    public static function FR_adminInternational($title, $field, $layout, $i)
    {
        $text = (get_sub_field('content') ? (get_sub_field('content')) : false);
        $title = "Diapositive";
        if( $text ) {
            $title = '<b>' . esc_html(substr($text['label_pagination'], 0,100)) . '</b>';
        }
        return $title;
    }

    public static function FR_adminDemoListing($title, $field, $layout, $i)
    {
        $text = (get_sub_field('title') ? (get_sub_field('title')) : false);
        $title = "Contenu";
        if( $text ) {
            $title = '<b>' . esc_html(substr($text, 0,100)) . '</b>';
        }
        return $title;
    }

    public static function getHomeHeader(): array|string
    {
        $header = LanguageController::get_field_value_by_context("header", DefaultController::getFrontID());
        $simple_header = array();
        foreach ($header as $key => $value) {
            $simple_header[$key]["background"] = $value['background'];
            $simple_header[$key]["label_pagination"] = $value['content']['label_pagination'];
            $simple_header[$key]["url_pagination"] = $value['content']['label_pagination_url'];
            $simple_header[$key]["title"] = $value['content']['title'];
            $simple_header[$key]["subtitle"] = $value['content']['subtitle'];
        }

        return $simple_header;
    }

    public static function getAboutSection()
    {
        $content = LanguageController::get_field_value_by_context("home_about", DefaultController::getFrontID());
        $simple_content = array();
        foreach ($content as $key => $value) {
            $simple_content[$key]["title"] = $value['title'];
            $simple_content[$key]["description"] = $value['description'];
        }

        return $simple_content;
    }

    public static function getBusinessSectorContent()
    {
        $content = LanguageController::get_field_value_by_context("business_section_content", DefaultController::getFrontID());
        return $content;
    }


    public static function getSectionInterContent(): array|string
    {
        $header = LanguageController::get_field_value_by_context("section_inter", DefaultController::getFrontID());
        $simple_header = array();
        foreach ($header as $key => $value) {
            $simple_header[$key]["background"] = $value['background'];
            $simple_header[$key]["label_pagination"] = $value['content']['label_pagination'];
            $simple_header[$key]["title"] = $value['content']['title'];
            $simple_header[$key]["subtitle"] = $value['content']['subtitle'];
        }

        return $simple_header;
    }

    public static function getGroupCompaniesContent()
    {
        $content = LanguageController::get_field_value_by_context("companies_content", DefaultController::getFrontID());
        return $content;
    }

    public static function getDemoLiveContent()
    {
        $content = LanguageController::get_field_value_by_context("section_demo_live", DefaultController::getFrontID());

        $simple_content = array();
        foreach ($content['listing'] as $key => $value) {
            $simple_content[$key]["title"] = $value['title'];
            $simple_content[$key]["content"] = $value['content'];
        }
        $content['listing'] = $simple_content;
        return $content;
    }

    public static function getFrenchMarketContent()
    {
        $content = DefaultController::field_value("FR_french_market", DefaultController::getFrontID());
        return $content;
    }
}