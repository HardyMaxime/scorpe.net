<?php

class SAVController
{
    private static $_instance; // L'attribut qui stockera l'instance unique

    /**
    * La méthode statique qui permet d'instancier ou de récupérer l'instance unique
    **/
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new SAVController();
        }
        return self::$_instance;
    }

    public function __construct()
    {
    }

    public static function getGallery(string $page_id): array|bool
    {
        $gallery = DefaultController::field_value("page_sav_sav_gallery", $page_id) ?? false;
        return $gallery;
    }
}
