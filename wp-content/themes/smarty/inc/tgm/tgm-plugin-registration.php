<?php

require_once get_template_directory() . '/inc/tgm/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'smarty_register_required_plugins' );

function smarty_register_required_plugins( $return = false )
{
    $plugins = array(
        'stm-importer' => array(
            'name' => 'STM Importer',
            'slug' => 'stm-importer',
            'source' => get_package( 'stm-importer', 'zip' ),
            'required' => true,
            'version' => '3.0',
            'external_url' => 'https://stylemixthemes.com/'
        ),
        'stm-post-type' => array(
            'name' => 'STM Post Type',
            'slug' => 'stm-post-type',
            'source' => get_package( 'stm-post-type', 'zip' ),
            'required' => true,
            'version' => '2.0',
            'force_activation' => true,
            'external_url' => 'https://stylemixthemes.com/'
        ),
        'js_composer' => array(
            'name' => 'WPBakery Visual Composer',
            'slug' => 'js_composer',
            'source' => get_package( 'js_composer', 'zip' ),
            'required' => true,
            'version' => '6.2',
            'external_url' => 'http://vc.wpbakery.com/'
        ),
        'revslider' => array(
            'name' => 'Slider Revolution',
            'slug' => 'revslider',
            'source' => get_package( 'revslider', 'zip' ),
            'required' => true,
            'version' => '6.2.22',
            'external_url' => 'https://revolution.themepunch.com/'
        ),
        'timetable' => array(
            'name' => 'Timetable Responsive Schedule For WordPress',
            'slug' => 'timetable',
            'source' => get_package( 'timetable', 'zip' ),
            'required' => true,
            'version' => '5.9',
            'external_url' => 'http://codecanyon.net/item/timetable-responsive-schedule-for-wordpress/'
        ),
        'masterstudy-lms-learning-management-system-pro' => array(
            'name' => 'MasterStudy LMS PRO',
            'slug' => 'masterstudy-lms-learning-management-system-pro',
            'source' => get_package( 'masterstudy-lms-learning-management-system-pro', 'zip' ),
            'required' => true,
            'version' => '3.2.0',
            'external_url' => 'https://stylemixthemes.com/'
        ),
        'stm-gdpr-compliance' => array(
            'name' => 'STM GDPR Compliance & Cookie Consent',
            'slug' => 'stm-gdpr-compliance',
            'source' => get_package( 'stm-gdpr-compliance', 'zip' ),
            'required' => true,
            'version' => '1.1.1',
            'external_url' => 'https://stylemixthemes.com/'
        ),
        'breadcrumb-navxt' => array(
            'name' => 'Breadcrumb NavXT',
            'slug' => 'breadcrumb-navxt',
            'required' => false
        ),
        'masterstudy-lms-learning-management-system' => array(
            'name' => 'MasterStudy LMS',
            'slug' => 'masterstudy-lms-learning-management-system',
            'required' => false
        ),
        'contact-form-7' => array(
            'name' => 'Contact Form 7',
            'slug' => 'contact-form-7',
            'required' => false
        ),
        'instagram-feed' => array(
            'name' => 'Instagram Feed',
            'slug' => 'instagram-feed',
            'required' => false
        ),
        'mailchimp-for-wp' => array(
            'name' => 'MailChimp for WordPress',
            'slug' => 'mailchimp-for-wp',
            'required' => false
        ),
        'woocommerce' => array(
            'name' => 'WooCommerce',
            'slug' => 'woocommerce',
            'required' => false
        ),
        'tinymce-advanced' => array(
            'name' => 'TinyMCE Advanced',
            'slug' => 'tinymce-advanced',
            'required' => false
        ),
        'breadcrumb-navxt' => array(
            'name' => 'Breadcrumb NavXT',
            'slug' => 'breadcrumb-navxt',
            'required' => false
        ),
        'taxonomy-terms-order' => array(
            'name' => 'Taxonomy Terms Order',
            'slug' => 'taxonomy-terms-order',
            'required' => false
        )
    );

    if ($return) {
        return $plugins;
    } else {
        $config = array(
            'id' => 'pearl_theme_id',
            'is_automatic' => false
        );

        $layout_plugins = smarty_layout_plugins( smarty_get_layout_mode() );
        $recommended_plugins = smarty_premium_bundled_plugins();
        $layout_plugins = array_merge($layout_plugins, $recommended_plugins);

        $tgm_layout_plugins = array();
        foreach ( $layout_plugins as $layout_plugin ) {
            $tgm_layout_plugins[ $layout_plugin ] = $plugins[ $layout_plugin ];
        }

        tgmpa( $tgm_layout_plugins, $config );
    }
}
