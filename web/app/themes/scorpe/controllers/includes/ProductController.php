<?php

class ProductController
{
    private static $_instance; // L'attribut qui stockera l'instance unique

    /**
    * La méthode statique qui permet d'instancier ou de récupérer l'instance unique
    **/
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new ProductController();
        }
        return self::$_instance;
    }

    public function __construct()
    {
        ///add_filter('acf/settings/show_admin', [$this, 'hide_acf_menu']);
        //add_filter('rest_authentication_errors', [$this, 'disable_rest_api']);
        self::register_product_posttype();
        //self::register_accessories_posttype();
        //add_filter('query_vars', array(static::class, 'clbs_query_vars'));
        //add_action('init',  array(static::class, 'clbs_rewrite_rule_product_archive'));
    }

    public static function clbs_rewrite_rule_product_archive()
    {
        add_rewrite_rule(
            '^nos-produits/id/([0-9]+)/?$',
            'index.php?post_type=product&term=$matches[1]',
            'top'
        );
        add_rewrite_rule(
            '^our-products/id/([0-9]+)/?$',
            'index.php?post_type=product&term=$matches[1]',
            'top'
        );
        flush_rewrite_rules();
    }

    public static function clbs_query_vars($params)
    {
        $params[] = 'term';
        $params[] = 'p_term_id';

        return $params;
    }

    public static function register_accessories_posttype()
    {
        $accessories_options = [
            "supports" => ["title", "excerpt"],
            "publicly_queryable" => false,
            "with_front" => false,
            "has_archive" => false,
            "hierarchical" => false,
        ];
        $accessories_labels = array(
            'name' => _x('Accessoires', 'Post Type General Name', 'text_domain'),
            'singular_name' => _x('Accessoire', 'Post Type Singular Name', 'text_domain'),
            'menu_name' => __('Accessoires', 'text_domain'),
            'name_admin_bar' => __('Accessoires', 'text_domain'),
            'archives' => __('Archives des accessoires', 'text_domain'),
            'attributes' => __("Attributs de l'accessoires", 'text_domain'),
            'parent_item_colon' => __('Accessoire parent :', 'text_domain'),
            'all_items' => __('Tous les accessoires', 'text_domain'),
            'add_new_item' => __('Ajouter un accessoire', 'text_domain'),
            'add_new' => __('Ajouter', 'text_domain'),
            'new_item' => __('Nouvelle accessoire', 'text_domain'),
            'edit_item' => __("Modifier l'accessoire", 'text_domain'),
            'update_item' => __("Mettre à jour l'accessoire", 'text_domain'),
            'view_item' => __("Voir l'accessoire", 'text_domain'),
            'view_items' => __('Voir les accessoires', 'text_domain'),
            'search_items' => __('Rechercher un accessoire', 'text_domain'),
            'not_found' => __('Aucun accessoire trouvé.', 'text_domain'),
            'not_found_in_trash' => __('Aucun accessoire trouvé dans la corbeille.', 'text_domain'),
            'featured_image' => __('Image à la une', 'text_domain'),
            'set_featured_image' => __('Définir l’image à la une', 'text_domain'),
            'remove_featured_image' => __('Supprimer l’image à la une', 'text_domain'),
            'use_featured_image' => __('Utiliser comme image à la une', 'text_domain'),
            'insert_into_item' => __("Insérer dans l'accessoire", 'text_domain'),
            'uploaded_to_this_item' => __('Téléversé sur cet accessoire', 'text_domain'),
            'items_list' => __('Liste des accessoires', 'text_domain'),
            'items_list_navigation' => __('Navigation de la liste des accessoires', 'text_domain'),
            'filter_items_list' => __('Filtrer la liste des accessoires', 'text_domain'),
        );

        $accessories = new PostType( 'accessories', $accessories_options, $accessories_labels );
        $accessories->register();
    }

    public static function register_product_posttype()
    {
        $product_options = [
            "supports" => ["title", "excerpt", "thumbnail"],
            "publicly_queryable" => true,
            "with_front" => true,
            "has_archive" => true,
            "hierarchical" => false,
            "slug" => "product",
        ];
        $product_labels = array(
            'name' => _x('Produits', 'Post Type General Name', 'text_domain'),
            'singular_name' => _x('Produit', 'Post Type Singular Name', 'text_domain'),
            'menu_name' => __('Produits', 'text_domain'),
            'name_admin_bar' => __('Produit', 'text_domain'),
            'archives' => __('Archives des produits', 'text_domain'),
            'attributes' => __('Attributs du produit', 'text_domain'),
            'parent_item_colon' => __('Produit parent :', 'text_domain'),
            'all_items' => __('Tous les produits', 'text_domain'),
            'add_new_item' => __('Ajouter un nouveau produit', 'text_domain'),
            'add_new' => __('Ajouter', 'text_domain'),
            'new_item' => __('Nouveau produit', 'text_domain'),
            'edit_item' => __('Modifier le produit', 'text_domain'),
            'update_item' => __('Mettre à jour le produit', 'text_domain'),
            'view_item' => __('Voir le produit', 'text_domain'),
            'view_items' => __('Voir les produits', 'text_domain'),
            'search_items' => __('Rechercher un produit', 'text_domain'),
            'not_found' => __('Aucun produit trouvé.', 'text_domain'),
            'not_found_in_trash' => __('Aucun produit trouvé dans la corbeille.', 'text_domain'),
            'featured_image' => __('Image à la une', 'text_domain'),
            'set_featured_image' => __('Définir l’image à la une', 'text_domain'),
            'remove_featured_image' => __('Supprimer l’image à la une', 'text_domain'),
            'use_featured_image' => __('Utiliser comme image à la une', 'text_domain'),
            'insert_into_item' => __('Insérer dans le produit', 'text_domain'),
            'uploaded_to_this_item' => __('Téléversé sur ce produit', 'text_domain'),
            'items_list' => __('Liste des produits', 'text_domain'),
            'items_list_navigation' => __('Navigation de la liste des produits', 'text_domain'),
            'filter_items_list' => __('Filtrer la liste des produits', 'text_domain'),
        );

        $product = new PostType( 'product', $product_options, $product_labels );
        $product->icon( 'dashicons-admin-tools' );
        $product->taxonomy( 'category' );
        $product->register();
    }

    /**
     * Get product categories
     * @param int $term_id Si on veut récupérer les sous-catégories d'une catégorie
     */
    public static function getProductCategories($term_id = false, bool $hide_empty = false)
    {
        // Classé par ordre de la meta 'categ_order' si elle existe
        $args = [
            'taxonomy' => 'category',
            'orderby' => 'date',
            'order' => 'ASC',
            'hide_empty' => $hide_empty,
        ];

        if($term_id) $args['child_of'] = $term_id; // get children of this term (this term is the parent)
        if(!$term_id) $args['parent'] = 0; // get only parent categories (no children

        $categs = get_categories($args);
        $order_categ = array();
        $index = 0;
        foreach($categs as $categ) {
            $order = get_term_meta($categ->term_id, 'categ_order', true);
            $defaut_key = (count($categs) + $index);
            if($order)
            {
                $order_categ[$order] = $categ;
            }
            else
            {
                $order_categ[$defaut_key] = $categ;
            }
            $index++;
        }
        ksort($order_categ);
        return ($order_categ);
    }

    public static function getProductCategorieName($term_id)
    {
        $term = get_term($term_id);
        return $term->name;
    }

    public static function getProducts(
        string $term_id = "", 
        int $limit = 8, 
        bool $showAccessoire = true, 
        bool $rand = false, 
        bool $convert = false,
        bool $alphaOrder = false,
        array $exclude = []): WP_Query|array
    {
        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        $args = [
            'post_type' => 'product',
            'posts_per_page' => $limit,
            'post__not_in' => $exclude
        ];

        if($rand)
        {
            $args['orderby'] = 'date';
            $args['order'] = 'ASC';
        }

        if($alphaOrder)
        {
            $args['orderby'] = 'title';
            $args['order'] = 'ASC';
        }

        if($paged) $args['paged'] = $paged;

        // Si on ne veut pas afficher les accessoires
        if(!$showAccessoire)
        {
            // SI la clé existe et qu'elle est égale à 1
            $args['meta_query'] = [
                'relation' => "OR",
                [
                    'key' => 'product_is_accessorie',
                    'value' => 1,
                    'compare' => '!=',
                ],
                [
                    'key' => 'product_is_accessorie',
                    'compare' => 'NOT EXISTS',
                ]
            ];
        }

        if(!empty($term_id)) $args['tax_query'] = [
            [
                'taxonomy' => 'category',
                'field' => 'term_id',
                'terms' => $term_id,
            ]
        ];

        if($convert) return get_posts($args);

        $products = new WP_Query($args);
        return $products;
    }

    /**
     * Renvoie les images d'un produit
     * @param string $id ID du produit
     * @param bool $onlyFirst Si on veut récupérer uniquement la première image
     */
    public static function getProductThumbnails(string $id, string $param = "", ?string $size = ""): array|string
    {
        //$images = DefaultController::field_value('product_preview_listing', $id);
        $images = DefaultController::getPostThumbnail($id, null, false, $size) ?: false;
        if(empty($images))
        {
            $images = [
                "url" => DefaultController::assets("default-listing.jpg"),
                "alt" => get_the_title($id)
            ];
        }

        if(!empty($param) && array_key_exists($param, $images)) return $images[$param];
        return $images;
    }

    public static function getProductContent(string $id, string $param = ""): array|string
    {
        $content = [];
        $content['description'] = DefaultController::field_value('product_description', $id);
        $content['characteristic'] = DefaultController::field_value('product_characteristic', $id);
        $content['advantages'] = DefaultController::field_value('product_advantages', $id);

        if(!empty($param) && array_key_exists($param, $content))
        {
            return $content[$param];
        }

        return $content;
    }

    public static function getProductAccessories(string $id): array|bool
    {
        $accessories = DefaultController::field_value('product_accessorie', $id);
        if(!empty($accessories))
        {
            return $accessories;
        }

        return false;
    }

    /**
     * Renvoie les fichiers d'un produit
     * @param string $id ID du produit
     * @param string $params  manual ou datasheet, Si on veut récupérer un fichier en particulier
     * @return array|string|bool
     */
    public static function getFiles(string $id, string $params = ""): array|string|bool
    {
        $files = array();

        $files['datasheet'] = DefaultController::field_value('product_technical_sheet', $id) ?: false;
        $files['manual'] = DefaultController::field_value('product_manuel', $id) ?: false;

        if(!empty($params) && array_key_exists($params, $files))
        {
            return $files[$params];
        }

        return $files;
    }

    /**
     * Renvoie la vidéo démonstration d'un produit
     * @param string $id ID du produit
     * @return array|bool
     */
    public static function hasVideo(string $id, string $params = "" ): array|bool
    {
        $video_url = DefaultController::field_value('product_video_id', $id);
        if(empty($video_url)) return false;

        $video_url_parse = parse_url($video_url);
        parse_str($video_url_parse['query'], $video_id);
    
        if(empty($video_id) || !isset($video_id['v'])) return false;
        $video_id = $video_id['v'];

        $video_thumbnail = "https://img.youtube.com/vi/{$video_id}/maxresdefault.jpg";
        //$video_thumbnail = esc_url(get_template_directory_uri() . '/assets/scorpe-technologies-defaut-thumb-video.jpg');
        $force_video_thumbnail = DefaultController::field_value('product_video_thumb', $id);

        if(!empty($force_video_thumbnail)) $video_thumbnail = $force_video_thumbnail['url'];

        $array = array();
        $array['id'] = $video_id;
        $array['url'] = $video_url;
        $array['thumbnail'] =$video_thumbnail;
        $array['title'] = DefaultController::field_value('product_video_title', $id) ?: "Démonstration Scorpe Technologies";

        if(!empty($params) && array_key_exists($params, $array))
        {
            return $array[$params];
        }

        return $array;
    }

    /**
     *  Renvoie le parent d'une catégorie si elle existe
     * @param string $term_id ID de la catégorie
     * @return bool|WP_Term Renvoie false si la catégorie n'a pas de parent, sinon renvoie le parent
     */
    public static function getParentCategorie(string $term_id): bool|WP_Term
    {
        $term = get_term($term_id);
        if(empty($term)) return false;

        if($term->parent == 0) return $term;

        $parent = get_term($term->parent);
        if(empty($parent)) return false;

        return $parent;
    }

    public static function getCategoriesByProductId(string $product_id): bool|array
    {
        $terms = get_the_terms($product_id, 'category');
        if(empty($terms)) return false;

        // Réorganise les catégories par ordre de parenté
        $terms = self::sortCategoriesByParent($terms);
        return $terms;
    }

    public static function sortCategoriesByParent(array $terms)
    {
        $parent_terms = array();
        $child_terms = array();
        foreach($terms as $term)
        {
            if($term->parent == 0)
            {
                $parent_terms[] = $term;
            }
            else
            {
                $child_terms[] = $term;
            }
        }

        $terms = array_merge($parent_terms, $child_terms);
        return $terms;
    }

    public static function getSubCategImage(string|object $id)
    {
        return DefaultController::field_value('categ_thumb', $id) ?? false;
    }

    public static function getDefautThumb()
    {
        return get_template_directory_uri() . '/assets/default-listing.jpg';
    }

    public static function isAccessorie(string $product_id): bool
    {
        $is_accessorie = DefaultController::field_value('product_is_accessorie', $product_id) ?? false;
        return $is_accessorie;
    }

    public static function get_post_primary_category($post_id, $term='category', $return_all_categories=false){
        $return = array();
    
        if (class_exists('WPSEO_Primary_Term')){
            // Show Primary category by Yoast if it is enabled & set
            $wpseo_primary_term = new WPSEO_Primary_Term( $term, $post_id );
            $primary_term = get_term($wpseo_primary_term->get_primary_term());
    
            if (!is_wp_error($primary_term)){
                $return['primary_category'] = $primary_term;
            }
        }
    
        if (empty($return['primary_category']) || $return_all_categories){
            $categories_list = get_the_terms($post_id, $term);
    
            if (empty($return['primary_category']) && !empty($categories_list)){
                $return['primary_category'] = $categories_list[0];  //get the first category
            }
            if ($return_all_categories){
                $return['all_categories'] = array();
    
                if (!empty($categories_list)){
                    foreach($categories_list as &$category){
                        $return['all_categories'][] = $category->term_id;
                    }
                }
            }
        }
        return $return;
    }

    public static function buildProductBreadcrumb(string $post_id)
    {
        $breadcrumb = array();
        $primary_categ = self::get_post_primary_category($post_id);
        if(isset($primary_categ['primary_category']))
        {
            $primary_categ = $primary_categ['primary_category'];
            $parent_categ = [];

            if($primary_categ->parent)
            {
                $parent_categ = self::getParentCategorie($primary_categ->term_id);
            }

            if($parent_categ)
            {
                $breadcrumb[] = $parent_categ;
            }
            $breadcrumb[] = $primary_categ;
            return $breadcrumb;
        }
    }

    public static function getProductBanner(string $product_id, string $param = ""): array|string
    {
        $background = DefaultController::field_value("product_header_background", $product_id);
        $mobile =  DefaultController::field_value("product_header_background_mobile", $product_id);
        if(!empty($background) && empty($mobile))
        {
            $mobile = $background['sizes']['product'];
        }

        if(empty($background) && empty($mobile))
        {
            $mobile = DefaultController::assets("scorpe-technologies-defaut-thumb-video.jpg");
        }

        $images= array(
            "background" => $background ? $background['url'] : DefaultController::assets("scorpe-technologies-defaut-thumb-video.jpg"),
            "mobile" => $mobile,
            "alt" => $background ? $background['alt'] : "Scorpe technologies"
        );

        if(!empty($param) && array_key_exists($param, $images)) return $images[$param];
        return $images;
    }
}