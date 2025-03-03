<?php

class SearchController 
{
    private static $_instance; // L'attribut qui stockera l'instance unique

    /**
    * La méthode statique qui permet d'instancier ou de récupérer l'instance unique
    **/
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new SearchController();
        }
        return self::$_instance;
    }

    public function __construct()
    {
        add_action('wp_ajax_nopriv_search_ajax', array( static::class, 'registerAjaxSearchBar' ));
        add_action('wp_ajax_search_ajax', array( static::class, 'registerAjaxSearchBar' ));
        //add_action( 'template_redirect', array( static::class, 'clbs_change_search_url' ));
    }

    public static function clbs_change_search_url()
    {
        if ( is_search() && ! empty( $_GET['s'] ) ) {
            wp_redirect(pll_home_url() . "search/" . urlencode( get_query_var( 's' ) ) );
            exit();
        }
    }

    public static function registerAjaxSearchBar()
    {
        if ( !isset($_POST['nonce']) && !wp_verify_nonce( $_POST['nonce'], 'ajax-nonce' ) ) {
            die ( 'Busted!');
        }
        $response = array();
        $response['keyword'] = isset($_POST['keyword']) ? $_POST['keyword'] : "";
        $args = array(
            'post_type' => array('post','product'),
            'search_only_title' => esc_attr($response['keyword']),
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'orderby' => 'title',
            'order' => 'ASC'
        );
        add_filter( 'posts_where', array(static::class, "title_filter"), 10, 2 );
        $query = new WP_Query($args);
        remove_filter( 'posts_where', array(static::class, "title_filter"), 10, 2 );

        if($query->have_posts()){
            while($query->have_posts()){
                $query->the_post();
                $response['list'][get_the_ID()] = array(
                    'title' => get_the_title(),
                    'permalink' => get_the_permalink(),
                    'type' => get_the_terms(get_the_ID(), 'category')[0]->name,
                );
            }
        }
        else
        {
            $response['list'] = array();
        }
        return wp_send_json($response['list']);
    }

    public static function title_filter( $where, $wp_query )
    {
        global $wpdb;
        if ( $search_term = $wp_query->get( 'search_only_title' ) ) {
            $where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'%' . esc_sql( $wpdb->esc_like( $search_term ) ) . '%\'';
        }
        return $where;
    }

}
