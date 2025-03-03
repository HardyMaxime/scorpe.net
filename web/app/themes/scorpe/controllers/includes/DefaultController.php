<?php

class DefaultController 
{
    protected static $frontID;
    private static $_instance; // L'attribut qui stockera l'instance unique

    /**
    * La méthode statique qui permet d'instancier ou de récupérer l'instance unique
    **/
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new DefaultController();
        }
        return self::$_instance;
    }

    public function __construct()
    {
        $frontid = get_option('page_on_front');
        self::setFrontID($frontid);
        add_action( 'admin_init', [$this, 'clbs_hide_editor'] );
        add_filter( 'page_template', array($this, 'clbs_custom_hierarchy_template') );
    }

    public static function clbs_hide_editor()
    {
        $post_id = (isset($_GET['post']) ? $_GET['post'] : false);
        if( !( $post_id ) ) return;
        if(in_array($post_id, self::getPageIDOfCustomizePage())) {
            remove_post_type_support('page', 'editor');
        }
    }

    public static function clbs_custom_hierarchy_template($template)
    {
        global $post;
        if ($post->post_parent) {
            // get top level parent page

            $parent = get_post(
               reset(array_reverse(get_post_ancestors($post->ID)))
            );

            $child_template = locate_template(
                [
                    'subpages/'.$parent->post_name . '/page-' . $post->post_name . '.php',
                    'subpages/'.$parent->post_name . '/page-' . $post->ID . '.php',
                    'subpages/'.$parent->post_name . '/page.php',
                ]
            );

            if ($child_template) return $child_template;
        }
        return $template;
    }

    /**
     *  Setter de l'ID de la page d'accueil
     */
    public static function setFrontID(string $id)
    {
        self::$frontID = $id;
    }

    /**
     * Retourne l'ID de la page d'accueil
     * @return string
     */
    public static function getFrontID(): string
    {
        return self::$frontID;
    }

    /**
     *  Retourne vrai si la page d'accueil est la page courante
     */
    public static function isAccueil(): bool 
    {
        $res = is_front_page() ? true : false;
        return $res;
    }

    /**
     *  Genere les class pour le body
    */
    public static function generateBodyClass(): array
    {
        $bodyClass = [];
        if (is_front_page()) {
            $bodyClass[] = "is-accueil";
        }
        if(current_user_can('administrator')) {
            $bodyClass[] = "is-admin";
        }

        if(is_page('contact')) {
            $bodyClass[] = "page-contact";
        }

        if(is_page(140)) {
            $bodyClass[] = "page-contact";
        }

        if(self::isNavbarStatic()) {
            $bodyClass[] = "static-navbar";
        }

        return $bodyClass;
    }

    public static function getPostThumbnailAttribut(string $image_id, string $params = ""): array|string
    {
        $attributs = array(
            'alt' => get_post_meta( $image_id, '_wp_attachment_image_alt', true ),
            'title' => get_the_title($image_id)
        );

        if(!empty($params) && array_key_exists($params, $attributs))
        {
            return $attributs[$params];
        }

        return $attributs;
    }

    /**
     * Retourne le contenu d'un champ ACF ou un champ personnalisé
     * @param string $field Nom du champ
     * @param string $id ID de la page
     */
    public static function field_value($field, $id)
    {
        // Si ACF est installé
        if(empty($id)) $id = get_the_ID();
        if(function_exists('get_field'))
        {
            return get_field($field, $id);
        }
        return get_post_meta($id, $field, true);
    }

    /**
     * Retourne le contenu d'un champ ou une chaine vide si le champ est vide
     * @param string $field Nom du champ
     * @param string $id ID de la page
     * @param string $return_value Valeur de retour si le champ est vide
     */
    public static function get_field_or_empty($field, $id, $return_value = "") {
        $value = self::field_value($field, $id);
        return empty($value) ? $return_value : $value;
    }

    /**
     * Vérifie si le paramètre existe dans le tableau et le retourne
     * @param string $param Nom du paramètre
     * @param array $array Tableau de paramètres
     */
    public static function check_array_param($param, $array)
    {
        if(!empty($param) && array_key_exists($param, $array))
        {
            return $array[$param];
        }
    }

    public static function isNavbarStatic(): bool
    {
        $static = true;
        if(is_front_page() || is_page('contact') || is_page(140)) {
            $static = false;
        }
        return $static;
    }

    public static function changeWpQuery(WP_Query $query): WP_Query
    {
        global $wp_query;
        $tmp_query = $wp_query;
        $wp_query = $query;

        return $tmp_query;
    }

    public static function resetWpQuery(WP_Query $query): void
    {
        global $wp_query;
        $wp_query = $query;
    }

    public static function clbs_pagination(string $paged)
    {
        $pages = paginate_links([
            'type' => 'array',
            'prev_next' => false,
            'current'    => max( 1, $paged )
        ]);
        if ($pages === null) {
            return;
        }
        echo '<nav class="pagination-wrapper reset-list" aria-label="Pagination" >';
        echo '<ul class="pagination">';
        foreach ($pages as $page) {
            $active = strpos($page, 'current') !== false;
            $class = 'pagination-item';
            if ($active) {
                $class .= ' active';
            }
            echo '<li class="' . $class . '">';
            echo str_replace('page-numbers', 'pagination-item-link', $page);
            echo '</li>';
        }
        echo '</ul>';
        echo '</nav>';
    }

    public static function getPageHeading(string $page_id, string $param = ""): array|string
    {
        $heading = [
            'title' => get_the_title(),
            'description' => (DefaultController::field_value('page_description', $page_id) ?? "")
        ];

        if(!empty($param) && array_key_exists($param, $heading))
        {
            return $heading[$param];
        }

        return $heading;
    }

    public static function getPageIDOfCustomizePage()
    {
        $ids = [12, 16, 18, 20, 22, 24, 497, 499];
        $contact_id = ContactController::getEnglishContactID();
        $ids = array_merge($ids, [$contact_id]);

        $french_ids = [];

        foreach ($ids as $id) {
            $french_ids[] = pll_get_post($id, 'fr');
        }

        $ids = array_merge($ids, $french_ids);
        return $ids;
    }

    /**
     * Envoie un mail à l'administrateur du site en cas d'erreur
     * @param string $message Message à envoyer
     * @return void
     */
    public static function sendAdminMailErreur(string $message = ""): void
    {
        $to = get_option('admin_email');
        $titre = get_bloginfo('name');
        $subject = '["ATTENTION"] Erreur sur le site : ' . $titre .' - ' . date('d/m/Y H:i:s');
        $body = 'Une erreur est survenue sur le site ' . $titre . ' : ' . $message;
        $headers = array('Content-Type: text/html; charset=UTF-8');
        wp_mail( $to, $subject, $body, $headers );
        exit;
    }

    /**
     * Renvoie l'url de la favion déjà echappée 
     * @return array|string URL de la favicon et le type
     */
    public static function getFavicon(string $param = ""): array|string
    {
        $array = array();
        if(function_exists('get_site_icon_url') && !empty(get_site_icon_url()))
        {
            $array = [
                "url" => esc_url(get_site_icon_url()),
                "type" => esc_attr("image/png")
            ];
        }
        else
        {
            $array =  [
                "url" => esc_url(get_template_directory_uri().'/assets/favicon.ico'),
                "type" => esc_attr("image/x-icon")
            ];
        }

        if(!empty($param) && array_key_exists($param, $array))
        {
            return $array[$param];
        }

        return $array;
    }

        /**
     *  Retourne l'url de l'image
     *  @param string $path Chemin de l'image ou nom de l'image
     *  @return string URL de l'image echappée
    */
    public static function assets(string $path): string
    {
        return esc_url(get_template_directory_uri() . '/assets/' . $path);
    }

    public static function getPostThumbnail(string $post_id, string $params = null, bool $return_false = false): array|string
    {
        // Récupérer les informations de l'image
        $image_id = get_post_thumbnail_id($post_id);
        $image_src = wp_get_attachment_image_src($image_id, 'listing');
        if($return_false && !$image_src) return false;
        // Générer les attributs
        $attributs = array(
            'url' => $image_src ? esc_url($image_src[0]) : esc_url(self::assets('default-listing.jpg')),
            'alt' => get_post_meta($image_id, '_wp_attachment_image_alt', true) ? esc_attr(get_post_meta($image_id, '_wp_attachment_image_alt', true)) : esc_attr(get_bloginfo('name')),
            'title' => get_the_title($image_id) ?: esc_attr(get_bloginfo('name')),
        );
        // Si un paramètre spécifique est demandé
        if (!empty($params) && isset($attributs[$params])) {
            return $attributs[$params];
        }
        // Retourner tous les attributs par défaut
        return $attributs;
    }
}