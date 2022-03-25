<?php

// Theme Info
$theme_info = wp_get_theme();

// Constants
define( 'SMARTY_THEME_VERSION', ( WP_DEBUG ) ? time() : $theme_info->get( 'Version' ) );
define( 'SMARTY_TEMPLATE_URI', get_template_directory_uri() );
define( 'SMARTY_TEMPLATE_DIR', get_template_directory() );
define( 'SMARTY_THEME_SLUG', 'smarty' );
define( 'SMARTY_CUSTOMIZER_PATH', get_template_directory() . '/inc/customizer' );
define( 'SMARTY_CUSTOMIZER_URI', get_template_directory_uri() . '/inc/customizer' );

// Content Width
if ( ! isset( $content_width ) ) {
    $content_width = 1110;
}

// Setup
if ( ! function_exists('smarty_setup') ) {
    function smarty_setup() {

        add_theme_support( 'html5', array(
            'comment-list',
            'comment-form',
            'search-form',
            'gallery',
            'caption'
        ) );

        add_theme_support( 'title-tag' );

        add_theme_support( 'automatic-feed-links' );

        add_theme_support( 'post-thumbnails' );

        load_theme_textdomain( 'smarty', get_template_directory() . '/languages' );

        register_nav_menus( array(
            'stm-topbar'  => esc_html__( 'Top bar', 'smarty' ),
            'stm-primary' => esc_html__( 'Header', 'smarty' ),
            'stm-about'   => esc_html__( 'About', 'smarty' )
        ) );

        add_theme_support( 'html5', array( 'search-form' ) );

        add_theme_support( 'post-formats', array(
            'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery',
        ) );

        add_image_size( 'post-thumbnail', 700, 480, true );
    }
}
add_action( 'after_setup_theme', 'smarty_setup' );

// Register Sidebars
if ( ! function_exists('smarty_register_sidebars') ) {
    function smarty_register_sidebars() {

        register_sidebar( array(
            'id'            => 'blog-sidebar',
            'name'          => esc_html__( 'Blog Sidebar', 'smarty' ),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h4 class="widget__title">',
            'after_title'   => '</h4>',
        ) );

        register_sidebar( array(
            'id'            => 'event-sidebar',
            'name'          => esc_html__( 'Event Sidebar', 'smarty' ),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h4 class="widget__title">',
            'after_title'   => '</h4>',
        ) );

        register_sidebar( array(
            'id'            => 'donation-sidebar',
            'name'          => esc_html__( 'Donation Sidebar', 'smarty' ),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h4 class="widget__title">',
            'after_title'   => '</h4>',
        ) );

        register_sidebar( array(
            'id'            => 'shop-sidebar',
            'name'          => esc_html__( 'Shop Sidebar', 'smarty' ),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h4 class="widget__title">',
            'after_title'   => '</h4>',
        ) );

        for ( $footer = 1; $footer < 5; $footer ++ ) {
            register_sidebar( array(
                'id'            => 'smarty-footer-' . $footer,
                'name'          => esc_html__( 'Footer ', 'smarty' ) . $footer,
                'before_widget' => '<div id="%1$s" class="widget widget_footer %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h4 class="widget_title">',
                'after_title'   => '</h4>',
            ) );
        }
    }
}
add_action( 'widgets_init', 'smarty_register_sidebars', 50 );

// Theme Layouts
function smarty_get_layout_mode()
{
    return get_option( 'stm_layout_mode', 'school' );
}

function smarty_layout_plugins( $layout = 'school', $get_layouts = false )
{

    $required = array(
        'stm-importer',
        'stm-post-type',
        'js_composer',
        'revslider',
        'timetable',
        'contact-form-7',
        'woocommerce',
        'instagram-feed',
        'mailchimp-for-wp',
        'tinymce-advanced',
        'taxonomy-terms-order',
        'stm-gdpr-compliance'
    );

    $plugins = array(
        'school-two' => array(
            'masterstudy-lms-learning-management-system',
            'masterstudy-lms-learning-management-system-pro'
        ),
    );

    if( $get_layouts ) return $plugins;

    return ( !empty( $plugins[ $layout ] ) ) ? array_merge( $required, $plugins[ $layout ] ) : $required;

}

function smarty_premium_bundled_plugins()
{
    return array(
        'breadcrumb-navxt',
        'masterstudy-lms-learning-management-system',
        'masterstudy-lms-learning-management-system-pro',
    );
}

add_filter( 'cew_before_converting_content', 'smarty_cew_before_converting_content' );