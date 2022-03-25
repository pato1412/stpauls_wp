<?php
/*
Plugin Name: STM Importer
Plugin URI: http://stylemixthemes.com/
Description: STM Importer
Author: Stylemix Themes
Author URI: http://stylemixthemes.com/
Text Domain: stm_importer
Version: 3.0
*/

define( 'STM_DEMO_PATH', dirname(__FILE__) );

require_once( STM_DEMO_PATH . '/helpers/widgets.php' );
require_once( STM_DEMO_PATH . '/helpers/content.php' );
require_once( STM_DEMO_PATH . '/helpers/theme_options.php' );
require_once( STM_DEMO_PATH . '/helpers/sliders.php' );

// Demo Import - Styles
function stm_demo_import_styles() {
    $plugin_url = plugin_dir_url( __FILE__ );

    wp_enqueue_style( 'stm-demo-import-style', $plugin_url . '/assets/css/style.css', null, null, 'all' );
}

add_action( 'admin_enqueue_scripts', 'stm_demo_import_styles' );

// Content Import
function stm_demo_import_content()
{

    $layout = 'school';

    if( !empty( $_GET[ 'demo_template' ] ) ) {
        $layout = sanitize_title( $_GET[ 'demo_template' ] );
    }

    update_option( 'stm_layout_mode', $layout );

    stm_theme_import_content( $layout );

    stm_theme_import_widgets($layout);

    stm_theme_import_sliders( $layout );

    stm_importer_done_function( $layout );

    do_action('pearl_importer_done');

    wp_send_json(array(
        'url' => get_home_url('/'),
        'title' => esc_html__('View site', 'smarty'),
        'theme_options_title' => esc_html__('Theme options', 'smarty'),
        'theme_options' => esc_url_raw(admin_url('customize.php'))
    ));
    die();
}

add_action( 'wp_ajax_stm_demo_import_content', 'stm_demo_import_content' );