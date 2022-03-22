<?php
namespace H5AP\Services;

define( 'CODEINWP_AWESOME_PLUGIN_VERSION', '1.0.0' );

class Menu {
    protected static $_instance = null;

    /**
     * construct function
     */
    public function __construct(){
        add_action( 'init', [$this, 'registerSettings'] );
        add_action( 'admin_menu', [$this, 'registerMenu'] );
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

    /**
     * Register Settings
     */
    function registerSettings() {
        register_setting(
            'h5ap_settings',
            'h5ap_gutenberg_enable',
            array(
                'type'         => 'boolean',
                'show_in_rest' => true,
                'default'      => false,
            )
        );
    
    }

    /**
     * Register Menu
     */
    function registerMenu() {
        $page_hook_suffix = add_submenu_page(
            'edit.php?post_type=audioplayer',
            __( 'How To', 'h5ap' ),
            __( 'How To', 'h5ap' ),
            'manage_options',
            'how-to',
            [$this, 'settings_callback']
        );
    
        add_action( "admin_print_scripts-{$page_hook_suffix}", [$this, 'eqnueueAssets'] );
    }

    /**
     * Settings Page Callback
     */
    function settings_callback() {
        echo '<div id="h5ap-settings"></div>';
    }
    
    function eqnueueAssets() {
        wp_enqueue_script( 'h5ap-settings', H5AP_PLUGIN_DIR . 'dist/settings.js', array( 'wp-api', 'wp-i18n', 'wp-components', 'wp-element' ), H5AP_PLUGIN_VERSION, true );
        wp_enqueue_style( 'h5ap-settings', H5AP_PLUGIN_DIR . 'dist/settings.css', array( 'wp-components' ) );
    }
}
Menu::instance();