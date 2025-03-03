<?php

class GalleryController 
{
    private static $_instance; // L'attribut qui stockera l'instance unique

    /**
    * La méthode statique qui permet d'instancier ou de récupérer l'instance unique
    **/
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new GalleryController();
        }
        return self::$_instance;
    }

    public function __construct()
    {
        add_action('wp_ajax_nopriv_gallery', array( $this, 'registerAjaxCallForGallery' ));
        add_action('wp_ajax_gallery', array( $this, 'registerAjaxCallForGallery' ));
    }

    public static function registerAjaxCallForGallery()
    {
        if ( !isset($_POST['nonce']) && !wp_verify_nonce( $_POST['nonce'], 'ajax-nonce' ) ) {
            die ( 'Busted!');
        }

        $offset = isset($_POST['offset']) ? (int)$_POST['offset'] : 0;
        $max = isset($_POST['max']) ? (int)$_POST['max'] : 3;
        $pageId = isset($_POST['pageId']) ? $_POST['pageId'] : 0;

        //$gallery = self::getGallery($min, $max, $pageId);
        $count = count(self::getGallery(0, 0, $pageId));
        $gallery = self::getGallery($offset, $max, $pageId);
        //$slice = array_slice($gallery, (int)$min, (int)$max);
        $response = array();
        $response['gallery'] = $gallery;
        $response['offset'] = $offset;
        $response['max'] = $max;
        $response['pageId'] = $pageId;
        $response['count'] = $count;
        $response['isLastRow'] = $count <= ($offset + $max);

        return wp_send_json($response);
    }

    public static function getLimitAndMax(string $id, string $param = ""): array|string
    {
        $limit = DefaultController::field_value("page_gallery_limit", $id) ?? 0;
        $max = DefaultController::field_value("page_gallery_max", $id) ?? 0;

        $array = [
            "limit" => $limit,
            "max" => $max
        ];
    
        if(!empty($param) && array_key_exists($param, $array)) {
            return $array[$param];
        }
        return array($limit, $max);
    }

    /**
     *  Obtenir la galerie d'image
     */
    public static function getGallery(int $offset = 0, int $max = 0, string|int $id = null): array
    {
        $galleries = DefaultController::field_value("page_gallery_listing", $id) ?? [];
        if($max > 0) {
            $galleries = array_slice($galleries, $offset, $max);
        }
        return $galleries;
    }
}
