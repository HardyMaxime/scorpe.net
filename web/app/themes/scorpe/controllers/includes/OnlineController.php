<?php

class OnlineController 
{
    private static $_instance; // L'attribut qui stockera l'instance unique

    /**
    * La méthode statique qui permet d'instancier ou de récupérer l'instance unique
    **/
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new OnlineController();
        }
        return self::$_instance;
    }

    public function __construct()
    {
        add_filter('acf/fields/flexible_content/layout_title/name=wrapper', array( $this, 'adminOnlineContentTitle' ), 10, 4);

        self::registerLiveVideoPostType();
    }

    public static function adminOnlineContentTitle($title, $field, $layout, $i)
    {
        $text = (get_sub_field('text') ? (get_sub_field('text')) : false);
        $title = "Text | Texte";
        if( $text ) {
            $title = '<b>' . esc_html(substr($text, 0,100)) . '</b>';
        }
        return $title;
    }

    public static function getGallery(string $page_id): array|bool
    {
        $gallery = DefaultController::field_value("page_online_gallery", $page_id) ?? false;
        return $gallery;
    }

    public static function registerLiveVideoPostType()
    {
        $live_options = [
            "supports" => ["title"],
            "publicly_queryable" => false,
            "with_front" => false,
            "has_archive" => false,
            "hierarchical" => false,
        ];
        $live_labels = array(
            'name' => _x('Live', 'Post Type General Name', 'text_domain'),
            'singular_name' => _x('Live', 'Post Type Singular Name', 'text_domain'),
            'menu_name' => __('Live video', 'text_domain'),
            'name_admin_bar' => __('Live video', 'text_domain'),
            'archives' => __('Archives des lives', 'text_domain'),
            'attributes' => __("Attributs du live", 'text_domain'),
            'parent_item_colon' => __('Live parent :', 'text_domain'),
            'all_items' => __('Tous les lives', 'text_domain'),
            'add_new_item' => __('Ajouter un live', 'text_domain'),
            'add_new' => __('Ajouter', 'text_domain'),
            'new_item' => __('Nouveau live video', 'text_domain'),
            'edit_item' => __("Modifier le live video", 'text_domain'),
            'update_item' => __("Mettre à jour le live video", 'text_domain'),
            'view_item' => __("Voir les lives vidéo", 'text_domain'),
            'view_items' => __('Voir les lives vidéo', 'text_domain'),
            'search_items' => __('Rechercher un live', 'text_domain'),
            'not_found' => __('Aucun live trouvé.', 'text_domain'),
            'not_found_in_trash' => __('Aucun live trouvé dans la corbeille.', 'text_domain'),
            'featured_image' => __('Image à la une', 'text_domain'),
            'set_featured_image' => __('Définir l’image à la une', 'text_domain'),
            'remove_featured_image' => __('Supprimer l’image à la une', 'text_domain'),
            'use_featured_image' => __('Utiliser comme image à la une', 'text_domain'),
            'insert_into_item' => __("Insérer dans le live vidéo", 'text_domain'),
            'uploaded_to_this_item' => __('Téléversé sur ce live', 'text_domain'),
            'items_list' => __('Liste des lives vidéo', 'text_domain'),
            'items_list_navigation' => __('Navigation de la liste des lives vidéo', 'text_domain'),
            'filter_items_list' => __('Filtrer la liste des lives vidéo', 'text_domain'),
        );

        $live = new PostType( 'live', $live_options, $live_labels );
        $live->icon('dashicons-video-alt2');
        $live->register();
    }

    public static function getLiveVideo(): WP_Query
    {
        $args = [
            'post_type' => 'live',
            'posts_per_page' => -1,
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key' => 'online_video_date',
                    'compare' => '>=',
                    'value' => date( 'Y-m-d' ),
                    'type' => 'DATE'
                ),
                // check si existe
                array(
                   'relation' => 'AND',
                   array(
                    'key' => 'online_video_hide',
                    'compare' => 'EXISTS',
                   ),
                    array(
                    'key' => 'online_video_hide',
                    'compare' => '!=',
                    'value' => '1',
                    ),
                )
            ),
            'orderby' => 'meta_value',
            'meta_key' => 'online_video_date',
            'order' => 'ASC',
        ];

        $live = new WP_Query($args);
        return $live;
    }

    public static function getLiveVideoContent(string $id, string $param = ""): bool|string|array
    {
        $date = DefaultController::field_value("online_video_date", $id) ?? false;
        $url = DefaultController::field_value("online_video_url", $id) ?? false;

        $array = [
            "date" => $date,
            "url" => $url,
        ];

        if(!empty($param) && array_key_exists($param, $array)) {
            return $array[$param];
        }

        return $array;
    }
}
