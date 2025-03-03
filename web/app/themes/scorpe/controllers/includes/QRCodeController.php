<?php

use chillerlan\QRCode\{QRCode, QROptions};

class QRCodeController
{
    private static $_instance; // L'attribut qui stockera l'instance unique

    /**
    * La méthode statique qui permet d'instancier ou de récupérer l'instance unique
    **/
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new QRCodeController();
        }
        return self::$_instance;
    }

    public function __construct()
    {
    }

    public static function getPageQRCode(string $id = ""): string|bool
    {
        if(!isset($_GET['qrcode'])) return false;

        $id = $id ?? get_the_ID();

        $color = [0, 153, 176];
        $moduleValues = [
            // finder
            (chillerlan\QRCode\Data\QRMatrix::M_FINDER << 8)     => [0, 153, 176],    // dark (true)
            (chillerlan\QRCode\Data\QRMatrix::M_FINDER_DOT << 8) => $color,  // finder dot, dark (true)
            chillerlan\QRCode\Data\QRMatrix::M_FINDER            => [255, 255, 255],
            // light (false), white is the transparency color and is enabled by default
            // alignment
            (chillerlan\QRCode\Data\QRMatrix::M_ALIGNMENT << 8)  => $color,
            chillerlan\QRCode\Data\QRMatrix::M_ALIGNMENT         => [255, 255, 255],
            // timing
            (chillerlan\QRCode\Data\QRMatrix::M_TIMING << 8)     => $color,
            chillerlan\QRCode\Data\QRMatrix::M_TIMING            => [255, 255, 255],
            // format
            (chillerlan\QRCode\Data\QRMatrix::M_FORMAT << 8)     => $color,
            chillerlan\QRCode\Data\QRMatrix::M_FORMAT            => [255, 255, 255],
            // version
            (chillerlan\QRCode\Data\QRMatrix::M_VERSION << 8)    => $color,
            chillerlan\QRCode\Data\QRMatrix::M_VERSION           => [255, 255, 255],
            // data
            (chillerlan\QRCode\Data\QRMatrix::M_DATA << 8)       => $color,
            chillerlan\QRCode\Data\QRMatrix::M_DATA              => [255, 255, 255],
            // darkmodule
            chillerlan\QRCode\Data\QRMatrix::M_LOGO              => [255, 255, 255],
        ];

        $options = new chillerlan\QRCode\QROptions([
            'eccLevel'         =>  chillerlan\QRCode\QRCode::ECC_L,  // using QRCode::ECC_L
            'imageBase64'      => true, // true
            'imageTransparent' => false, // true
            'moduleValues'     => $moduleValues,
        ]);

        try
        {
            $qr_image = (new chillerlan\QRCode\QRCode($options))->render(get_permalink($id));
            //$qr_file = (new chillerlan\QRCode\QRCode($options))->render($vcard, CLBS_ACF_PATH . "assets/membre/qrcode/{$id}.png");
        }
        catch(Throwable $e){
            DefaultController::sendAdminMailErreur($e->getMessage());
            exit($e->getMessage());
        }
        return $qr_image;
    }
}
