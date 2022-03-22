<?php
namespace H5APPlayer\Model;

class EnqueueAssets{
    
    protected static $_instance = null;

    /**
     * construct function
     */
    public function __construct(){
        add_action('wp_enqueue_scripts',[$this, 'publicAssets']);
        add_action('admin_enqueue_scripts',[$this, 'adminAssets']);
    }

    /**
     * Create instance function
     */
    public static function instance(){
        if(self::$_instance === null){
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function publicAssets(){
        wp_register_style( 'bplugins-plyrio', H5AP_PLUGIN_DIR . 'style/player-style.css', array(), H5AP_PLUGIN_VERSION , 'all'  );
        // wp_register_style( 'h5ap-public', H5AP_PLUGIN_DIR . 'dist/public.css', array('bplugins-plyrio'), H5AP_PLUGIN_VERSION , 'all'  );

        wp_register_script( 'bplugins-plyrio', H5AP_PLUGIN_DIR . 'js/plyr.min.js' , array(), H5AP_PLUGIN_VERSION , false );
        wp_register_script( 'h5ap-public', H5AP_PLUGIN_DIR . 'dist/public.js' , array('jquery', 'bplugins-plyrio'), H5AP_PLUGIN_VERSION , false );
    }

    public function adminAssets($page){
        global $post;
        $screen = get_current_screen();
		if($page === 'plugins.php' || $screen->post_type === 'audioplayer'){
			wp_enqueue_script('h5ap-admin',  H5AP_PLUGIN_DIR . 'admin/js/script.js');

			wp_localize_script('h5ap-admin', 'h5apAdmin', array(
				'ajaxUrl' => admin_url('admin-ajax.php')
			));

			wp_enqueue_style('h5ap-admin',  H5AP_PLUGIN_DIR . 'admin/css/style.css');
            wp_enqueue_script( 'gum-js', H5AP_PLUGIN_DIR.'js/gumroad-embed.js', array(), H5AP_PLUGIN_VERSION );
		}
    }
}
EnqueueAssets::instance();