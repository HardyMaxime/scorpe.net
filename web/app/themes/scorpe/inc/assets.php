<?php

class Assets
{
    private static $_instance; // L'attribut qui stockera l'instance unique
    private array $manifest = [];
    private bool $is_dev = false;
    private string $dev_url_server = "";

    public function __construct()
    {
        $this->is_dev = function_exists('wp_get_environment_type') 
        ? (wp_get_environment_type() === 'development') 
        : (defined('WP_ENV') && WP_ENV === 'development');

        $this->dev_url_server = apply_filters('theme_vite_dev_server', 'http://localhost:5173/');

        if (!$this->is_dev) {
            $this->loadManifest();
        }
        
        add_action("wp_enqueue_scripts", [$this,'mhdy_load_assets']);
        add_action("wp_enqueue_scripts", [$this,'mhdy_localize_script']);

        add_action( 'wp_default_scripts', [$this,'remove_jquery_migrate']);
        add_filter('script_loader_tag', [$this,'add_defer_attribute'], 10, 2);
        add_action( 'wp_enqueue_scripts', [$this,'clb_custom_jquery']);
        add_action('admin_enqueue_scripts', [$this,'clb_admin_style'], 11);
        //add_action('wp_enqueue_scripts', [$this,'clb_remove_jquery']);
    }

    /**
    * La méthode statique qui permet d'instancier ou de récupérer l'instance unique
    **/
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Assets();
        }
        return self::$_instance;
    }

    public function mhdy_localize_script()
    {
        // Ajout du nonce pour les appels ajax
        wp_localize_script('index', 'ajax_var', array(
            'url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('ajax-nonce')
        ));
    }

    // Supprimer JQUERY MIGRATE sur le front
    public function remove_jquery_migrate( $scripts ) {
        if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
            $script = $scripts->registered['jquery'];
            if ( $script->deps ) { 
                $script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
            }
        }
    }

    // Ajout l'attribut Defer sur les scripts js
    public function add_defer_attribute($tag, $handle) {
        // ajouter les handles de mes scripts au array ci-dessous. Ici 3 scripts par exemple.
        $scripts_to_defer = array('index', 'vite-client', 'index-dev');
        foreach($scripts_to_defer as $defer_script) {
          if ($defer_script === $handle) {
            return str_replace(' src', ' type="module" defer="defer" src', $tag);
          }
        }
        return $tag;
    }

    public function clb_custom_jquery() { 
        if ( !is_admin() ) { 
            wp_deregister_script( 'jquery' ); 
            //La fonction supprime l'utilisation du fichier original de JQuery sur votre serveur     
            wp_register_script( 'jquery', includes_url( '/js/jquery/jquery.js' ), false, NULL, true );
            //La fonction charge JQuery     
            wp_enqueue_script( 'jquery' );    
        }
    }

    // Css pour la partie admin
    public function clb_admin_style() {
        wp_enqueue_style('admin-styles', get_template_directory_uri().'/admin.css');
    }

    // Supprime completement Jquery
    function clb_remove_jquery() {
        if ( ! is_admin() ) {
           wp_deregister_script('jquery');
           wp_register_script('jquery', false);
        }
    }

    private function loadManifest(): void
    {
        if($this->is_dev) return;
        $path = get_template_directory() . '/assets/dist/.vite/manifest.json';
        if (empty($path) || ! file_exists($path)) {
            wp_die(__('Run <code>npm run build</code> in your application root!', 'fm'));
        }

        $this->manifest = json_decode(file_get_contents($path), true);
    }

    private function resolve(string $path): string
    {
        $url = '';

        if (! empty($this->manifest["{$path}"])) {
            $url = get_theme_file_uri('assets/dist/' . ltrim($this->manifest[$path]['file'], '/'));
        }

        return $url;
    }

    public function mhdy_load_assets()
    {
        if($this->is_dev)
        {
            wp_enqueue_script('vite-client',$this->dev_url_server. '@vite/client',[],null,true);
            wp_enqueue_script('index-dev',$this->dev_url_server. 'scripts/main.js',[], null, true);
        }
        else
        {
            wp_enqueue_script('index', $this->resolve("scripts/main.js"), array());
            wp_enqueue_style('style', $this->resolve("styles/main.scss"), array());
        }
    }
}