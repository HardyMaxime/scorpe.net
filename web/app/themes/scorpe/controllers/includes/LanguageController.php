<?php

class LanguageController
{
    private static $_instance; // L'attribut qui stockera l'instance unique
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new LanguageController();
        }
        return self::$_instance;
    }

    public static function init()
    {
        //add_filter('acf/fields/flexible_content/layout_title/name=home_gallery_services', array( static::class, 'adminTitleGallery' ), 10, 4);
        if(function_exists('pll_register_string'))
        {
            //pll_register_string('form-label-lunch-name', 'Nom');
        }
    }

    public static function getContactID()
    {
        $ids = [26, 140];
        return $ids;
    }

    public static function generateSiwtcher()
    {
        if(!function_exists('pll_the_languages')) return;

        $langs_array = pll_the_languages( array( 'dropdown' => 1, 'raw' => 1 ) );
        echo '<div class="lg-switcher">';
            echo '<div class="lg-switcher-current">'.pll_current_language('slug').'</div>';
            echo '<div class="lg-switcher-options">';
                foreach($langs_array as $key => $lang):
                    echo '<a data-lang='. $key .' '.($lang['current_lang'] === true ?  "class=active" : "" ).' href='.esc_url($lang['url']).'> 
                    <span class="text-ident">'. self::translateStaticText("Choose language", "Choisir la langage : ") .'</span>'.$key.'
                    </a>';
                endforeach;
            echo '</div>';
        echo '</div>';
    }

    public static function field_value_translate(string $name, string $lang = "")
    {
        if(function_exists('pll_current_language') && empty($lang))
        {
            $lang = pll_current_language('slug');
        }

        if(empty($lang))
        {
            $lang = 'fr';
        }
        return DefaultController::field_value($name, $lang);
    }

    /**
     * Outputs localized string if polylang exists or  output's not translated one as a fallback
     * @param $string
     * @return  void
     */
    public static function pl_e( $string = '' ) {
        if ( function_exists( 'pll_e' ) ) {
            pll_e( $string );
        } else {
            echo $string;
        }
    }

    /**
     * Returns translated string if polylang exists or  output's not translated one as a fallback
     * @param $string
     * @return string
     */
    public static function pl__( $string = '' ) {
        if ( function_exists( 'pll__' ) ) {
            return pll__( $string );
        }
        return $string;
    }

    public static function currentLanguage()
    {
        if(!function_exists('pll_current_language'))
        {
            return 'fr';
        }
        return pll_current_language("slug");
    }

    public static function getProductListingURL()
    {
        $current_lg = self::currentLanguage();
        if($current_lg === 'en')
        {
            return pll_home_url() . "our-products/";
        }
        return pll_home_url() . "nos-produits/";
    }

    public static function getImageAlt(array $image)
    {
        if(!function_exists('pll_current_language')) return;
        $image_id = $image['id'];

        if(!isset($image_id) || empty($image_id)) return;
        $fr_alt = DefaultController::field_value('FR_alt', $image_id);
        if(self::currentLanguage() == "fr" && !empty($fr_alt))
        {
            $image['alt'] = $fr_alt;
        }
        return $image['alt'];
    }

    public static function get_field_value_by_context(string $context, string $id)
    {
        $lang = LanguageController::currentLanguage();
        if($lang == "en") {
            $content = get_field($context, $id);
        } else {
            $content = get_field('FR_'.$context, $id);
        }

        return $content;
    }

    public static function getProductURL()
    {
        $current_lg = self::currentLanguage();
        if($current_lg === 'en')
        {
            return  get_permalink(12);
        }
        return get_permalink(133);
    }

    public static function translateStaticText(string $eng, string $french): string
    {
        if(self::currentLanguage() == "fr")
        {
            return $french;
        }
        return $eng;
    }

    public static function getContactURL()
    {
        $current_lg = self::currentLanguage();
        if($current_lg === 'en')
        {
            return esc_url(get_permalink(26));
        }
        return esc_url(get_permalink(140));
    }
}