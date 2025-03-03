<?php

class ContactController 
{
    private static $_instance; // L'attribut qui stockera l'instance unique

    /**
    * La méthode statique qui permet d'instancier ou de récupérer l'instance unique
    **/
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new ContactController();
        }
        return self::$_instance;
    }

    public function __construct()
    {
        add_action( 'acf/init', [$this, 'registerContactInfos'] );
    }

    public static function registerContactInfos()
    {
        acf_add_options_page( array(
            'page_title' => 'Infos. Contact',
            'menu_slug' => 'contact',
            'icon_url' => 'dashicons-email',
            'menu_title' => 'Infos. Contact',
            'position' => 58,
            'redirect' => false,
        ));
    }

    public static function getEnglishContactID()
    {
        //$contactID = pll_get_post(140, 'en');
        $contactID = 26;
        return $contactID;
    }

    public static function getFrenchContactID()
    {
        $contactID = pll_get_post(self::getEnglishContactID(), 'fr');
        //$contactID = 140;

        return $contactID;
    }

    public static function getContactInfos(string $params = ""): array|string|bool
    {
        $contactInfos = DefaultController::field_value("contact_infos", "option");

        if(!empty($params) && array_key_exists($params, $contactInfos))
        {
            return $contactInfos[$params];
        }

        return $contactInfos;
    }

    public static function getContactBackdround(string $params = ""): array|string|bool
    {
        $lang = LanguageController::currentLanguage();

        if($lang === 'fr')
        {
            $contactID = self::getFrenchContactID();
        }
        else
        {
            $contactID = self::getEnglishContactID();
        }

        $content = LanguageController::get_field_value_by_context('contact_background', $contactID);

        if(!empty($params) && array_key_exists($params, $content))
        {
            return $content[$params];
        }
        return $content;
    }

    public static function getKeywodsList(string $params = ""): array|string|bool
    {
        $lang = LanguageController::currentLanguage();

        if($lang === 'fr')
        {
            $contactID = self::getFrenchContactID();
        }
        else
        {
            $contactID = self::getEnglishContactID();
        }

        $content = LanguageController::get_field_value_by_context('contact_keywords', $contactID);

        if(!empty($params) && array_key_exists($params, $content))
        {
            return $content[$params];
        }
        return $content;
    }
}