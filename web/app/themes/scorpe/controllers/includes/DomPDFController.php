<?php

use Dompdf\Dompdf;
use Dompdf\Options;
use Dompdf\Adapter\CPDF;

class DomPDFController
{
    private static $_instance; // L'attribut qui stockera l'instance unique

    /**
    * La méthode statique qui permet d'instancier ou de récupérer l'instance unique
    **/
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new DomPDFController();
        }
        return self::$_instance;
    }

    public function __construct()
    {

    }

    public static function generatePageToPDF(string $id)
    {
        if(isset($_GET['pdf']))
        {
            self::generatePDF($id);
            die();
        }
        if(isset($_GET['pdfpage']))
        {
            self::getPageToPDF($id); 
            die();
        }
    }

    public static function getPageToPDF(string|int $id)
    {
        get_template_part('parts/pdf/product', null, array('product_id' => $id));
    }

    public static function generatePDF(string $id)
    {
        $pdf_title = get_queried_object()->post_name;
        $pdf_categ = (ProductController::getCategoriesByProductId($id)[0]->name ?: "");
        $pdf_name = self::buildPDFName("scorpe-technologies-".$pdf_categ."-".$pdf_title);

        $options = new Options();
        $options->setIsRemoteEnabled(true);
        $options->setIsFontSubsettingEnabled(true);
        $dompdf = new Dompdf($options);

        ob_start();
        get_template_part('parts/pdf/product', null, array('product_id' => $id));
        $content = ob_get_contents();
        ob_get_clean();

        if($content)
        {
            $dompdf->loadHtml($content);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            self::injectPageCount($dompdf);
            $dompdf->stream($pdf_name, array("Attachment" => false));
        }
        else
        {
            echo '<pre>';
            var_dump("impossible de generer le pdf");
            echo'</pre>';
            die();
        }
    }

    public static function convertToBase64($path){
        $context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n')));
        $content = file_get_contents($path,false,$context);
        $image = base64_encode($content);
        return $image;
    }

    /**
     * Replace a predefined placeholder with the total page count in the whole PDF document
     *
     * @param Dompdf $dompdf
     */
    public static function injectPageCount(Dompdf $dompdf): void
    {
        $canvas = $dompdf->getCanvas();
		assert($canvas instanceof CPDF);
		$search = self::insertNullByteBeforeEachCharacter('{N}');
		$replace = self::insertNullByteBeforeEachCharacter((string) $canvas->get_page_count());

		foreach ($canvas->get_cpdf()->objects as &$object) {
			if ($object['t'] === 'contents') {
				$object['c'] = str_replace($search, $replace, $object['c']);
			}
		}
    }

    private static function insertNullByteBeforeEachCharacter(string $string): string
	{
		return "\u{0000}" . substr(chunk_split($string, 1, "\u{0000}"), 0, -1);
	}

    private static function buildPDFName(string $string)
    {
        // Convertit les caractères spéciaux en caractères ASCII
        $string = iconv('UTF-8', 'ASCII//TRANSLIT', $string);
        // Supprime les caractères non alphanumériques
        $string = preg_replace('/[^a-zA-Z0-9 -]/', '', $string);
        // Remplace les espaces par des tirets
        $string = str_replace(' ', '-', $string);
        // Convertit en minuscules
        $string = strtolower($string);
        // Supprime les doubles tirets
        $string = preg_replace('/-+/', '-', $string);
        // Supprime les tirets en début et fin de chaîne
        $string = trim($string, '-');
        
        return $string;
    }
}
