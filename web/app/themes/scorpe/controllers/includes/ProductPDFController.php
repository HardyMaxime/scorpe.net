<?php

class ProductPDFController
{
    private static $_instance; // L'attribut qui stockera l'instance unique

    /**
    * La méthode statique qui permet d'instancier ou de récupérer l'instance unique
    **/
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new ProductPDFController();
        }
        return self::$_instance;
    }

    public function __construct()
    {

    }

    public static function getContent(string|int $product_id): array
    {
        $result = array();
        $keys = array(
            "carac_text" => "product_characteristic",
            "carac_table" => "product_characteristic_table",
            "avantages" => "product_advantages"
        );

        foreach($keys as $key => $content)
        {
            $inner = DefaultController::field_value('pdf_'.$content, $product_id) ?: "";
            if(empty($inner)) $inner = DefaultController::field_value($content, $product_id);

            $result[$key] = $inner;
        }
 
        return $result;
    }
}
