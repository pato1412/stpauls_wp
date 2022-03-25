<?php
function stm_importer_done_function($layout){

    $plugin_path = dirname( __FILE__ );

    global $wp_filesystem;

    if ( empty( $wp_filesystem ) ) {
        require_once ABSPATH . '/wp-admin/includes/file.php';
        WP_Filesystem();
    }

    $locations = get_theme_mod( 'nav_menu_locations' );
    $menus = wp_get_nav_menus();

    if ( ! empty( $menus ) ) {
        foreach ( $menus as $menu ) {
            if ( is_object( $menu ) ) {
                switch ($menu->name) {
                    case 'Header menu':
                        $locations['stm-primary'] = $menu->term_id;
                        break;
                    case 'Top bar':
                        $locations['stm-topbar'] = $menu->term_id;
                        break;
                    case 'About':
                        $locations['stm-about'] = $menu->term_id;
                        break;
                }
            }
        }
    }

    set_theme_mod( 'nav_menu_locations', $locations );

    if ( $layout === 'university' ) {
        update_option('blogdescription', 'university');
    }

    update_option( 'show_on_front', 'page' );

    $front_page = get_page_by_title( 'Home' );
    if ( isset( $front_page->ID ) ) {
        update_option( 'page_on_front', $front_page->ID );
    }

    $blog_page = get_page_by_title( 'News' );
    if ( isset( $blog_page->ID ) ) {
        update_option( 'page_for_posts', $blog_page->ID );
    }

    $shop_page = get_page_by_title( 'Shop' );
    if( isset( $shop_page->ID ) ) {
        if ( $layout === 'school' ) {
            update_option( 'woocommerce_shop_page_id', $shop_page->ID );
            update_option( 'shop_catalog_image_size[width]', 174 );
            update_option( 'shop_catalog_image_size[height]', 174 );
            update_option( 'shop_single_image_size[width]', 247 );
            update_option( 'shop_single_image_size[height]', 266 );
            update_option( 'shop_thumbnail_image_size[width]', 50 );
            update_option( 'shop_thumbnail_image_size[height]', 50 );
        }
        else if($layout === 'university') {
            update_option( 'woocommerce_shop_page_id', $shop_page->ID );
            update_option( 'shop_catalog_image_size[width]', 138 );
            update_option( 'shop_catalog_image_size[height]', 202 );
            update_option( 'shop_single_image_size[width]', 600 );
            update_option( 'shop_single_image_size[height]', 600 );
            update_option( 'shop_thumbnail_image_size[width]', 42 );
            update_option( 'shop_thumbnail_image_size[height]', 64 );
        }
    }

    $checkout_page = get_page_by_title( 'Checkout' );
    if ( isset( $checkout_page->ID ) ) {
        update_option( 'woocommerce_checkout_page_id', $checkout_page->ID );
    }
    $cart_page = get_page_by_title( 'Cart' );
    if ( isset( $cart_page->ID ) ) {
        update_option( 'woocommerce_cart_page_id', $cart_page->ID );
    }
    $account_page = get_page_by_title( 'My Account' );
    if ( isset( $account_page->ID ) ) {
        update_option( 'woocommerce_myaccount_page_id', $account_page->ID );
    }

    $classes_page = get_page_by_title( 'Classes' );
    if( isset( $classes_page->ID ) ) {
        update_option( 'stm_post_types_options[stm_course][page_for_courses]', $classes_page->ID );
    }

    $donations_page = get_page_by_title( 'Donations' );
    if( isset( $donations_page->ID ) ) {
        update_option( 'stm_post_types_options[stm_donation][page_for_donations]', $donations_page->ID );
    }

    if ( class_exists( 'RevSlider' ) ) {
        if ( $layout === 'school' ) {
            $home = $plugin_path . '/demo/home.zip';

            if ( file_exists( $home ) ) {
                $slider = new RevSlider();
                $slider->importSliderFromPost( true, true, $home );
            }

            $home_2 = $plugin_path . '/demo/home-2.zip';

            if ( file_exists( $home_2 ) ) {
                $slider = new RevSlider();
                $slider->importSliderFromPost( true, true, $home_2 );
            }

            $home_3 = $plugin_path . '/demo/home-3.zip';

            if ( file_exists( $home_3 ) ) {
                $slider = new RevSlider();
                $slider->importSliderFromPost( true, true, $home_3 );
            }

            $home_4 = $plugin_path . '/demo/home-4.zip';

            if ( file_exists( $home_4 ) ) {
                $slider = new RevSlider();
                $slider->importSliderFromPost( true, true, $home_4 );
            }
        }

        else if($layout === 'university') {
            $home = $plugin_path . '/demo/home_slider_university.zip';

            if ( file_exists( $home ) ) {
                $slider = new RevSlider();
                $slider->importSliderFromPost( true, true, $home );
            }
        }

        else if($layout === 'kindergarten') {
            $home = $plugin_path . '/demo/home_slider_kindergarten.zip';

            if ( file_exists( $home ) ) {
                $slider = new RevSlider();
                $slider->importSliderFromPost( true, true, $home );
            }
        }

        else if($layout === 'university-two') {
            $home = $plugin_path . '/demo/home_slider_university-two.zip';

            if ( file_exists( $home ) ) {
                $slider = new RevSlider();
                $slider->importSliderFromPost( true, true, $home );
            }
        }

        else if($layout === 'kindergarten-two') {
            $home = $plugin_path . '/demo/home_slider_kindergarten-two.zip';

            if ( file_exists( $home ) ) {
                $slider = new RevSlider();
                $slider->importSliderFromPost( true, true, $home );
            }
        }
    }
}