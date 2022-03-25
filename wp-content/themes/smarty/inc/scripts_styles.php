<?php
// Register Google fonts
if ( ! function_exists('smarty_fonts_url') ) :
    function smarty_fonts_url() {
        $fonts_url = '';
        $fonts     = array();
        $subsets   = 'latin,latin-ext';

        if ( smarty_get_layout_mode() === 'school' ) {
            if ( 'off' !== _x( 'on', 'Lato font: on or off', 'smarty' ) ) {
                $fonts[] = 'Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic';
            }
        }
        else if(smarty_get_layout_mode() === 'university') {
            if ( 'off' !== _x( 'on', 'Lato font: on or off', 'smarty' ) ) {
                $fonts[] = 'Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic';
            }
        }
        else if(smarty_get_layout_mode() === 'kindergarten') {
            if ( 'off' !== _x( 'on', 'Dosis font: on or off', 'smarty' ) ) {
                $fonts[] = 'Dosis:400,200,200italic,300,300italic,400italic,500,500italic,600,600italic,700,700italic,800,800italic';
            }

            if ( 'off' !== _x( 'on', 'Grand Hotel font: on or off', 'smarty' ) ) {
                $fonts[] = 'Grand Hotel:400,400italic';
            }
        }
        else if(smarty_get_layout_mode() === 'school-two') {
            if ( 'off' !== _x( 'on', 'Poppins font: on or off', 'smarty' ) ) {
                $fonts[] = 'Poppins:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i';
            }

            if ( 'off' !== _x( 'on', 'Libre Caslon Text font: on or off', 'smarty' ) ) {
                $fonts[] = 'Libre Caslon Text:400,400i,700';
            }
        }
        else if(smarty_get_layout_mode() === 'university-two') {
            if ( 'off' !== _x( 'on', 'Exo 2 font: on or off', 'smarty' ) ) {
                $fonts[] = 'Exo 2:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i';
            }
        }

        else if(smarty_get_layout_mode() === 'kindergarten-two') {
            if ( 'off' !== _x( 'on', 'Quicksand font: on or off', 'smarty' ) ) {
                $fonts[] = 'Quicksand:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i';
            }

            if ( 'off' !== _x( 'on', 'Patrick Hand font: on or off', 'smarty' ) ) {
                $fonts[] = 'Patrick Hand:400,400i,700';
            }
        }

        if ( $fonts ) {
            $fonts_url = add_query_arg( array(
                'family' => urlencode( implode( '|', $fonts ) ),
                'subset' => urlencode( $subsets ),
            ), 'https://fonts.googleapis.com/css' );
        }

        return $fonts_url;
    }
endif;

// Register Scripts
if ( ! function_exists('smarty_register_scripts') ) {
    function smarty_register_scripts() {
        $upload_dir = wp_upload_dir();
        $stm_upload_dir = $upload_dir['baseurl'] . '/stm_uploads';

        // Style
        wp_register_style( 'stm-style', get_stylesheet_uri(), array(), SMARTY_THEME_VERSION, 'all' );

        // Main Style
        wp_register_style( 'stm-skin-default', get_template_directory_uri() . '/assets/css/'.smarty_get_layout_mode().'/main.css', array(), SMARTY_THEME_VERSION, 'all' );

        // STM Icon
        wp_register_style( 'stm-icon', get_template_directory_uri() . '/assets/fonts/stm-icon/style.css', array(), SMARTY_THEME_VERSION, 'all' );

        // Animate
        wp_register_style( 'animate', get_template_directory_uri() . '/assets/css/animate.css', array(), SMARTY_THEME_VERSION, 'all' );

        // FancyBox
        wp_register_style( 'fancybox', get_template_directory_uri() . '/assets/js/vendor/fancybox/jquery.fancybox.css', array(), SMARTY_THEME_VERSION, 'all' );
        wp_register_script( 'fancybox', get_template_directory_uri() . '/assets/js/vendor/fancybox/jquery.fancybox.pack.js', array( 'jquery' ), SMARTY_THEME_VERSION, true );

        // FontAwesome
        wp_register_style( 'font-awesome', get_template_directory_uri() . '/assets/fonts/font-awesome/css/font-awesome.min.css', array(), SMARTY_THEME_VERSION, 'all' );

        wp_register_style( 'owl-carousel', get_template_directory_uri() . '/assets/js/vendor/owl-carousel/owl.carousel.css', array(), SMARTY_THEME_VERSION, 'all' );
        wp_register_script( 'owl-carousel', get_template_directory_uri() . '/assets/js/vendor/owl-carousel/owl.carousel.min.js', array( 'jquery' ), SMARTY_THEME_VERSION, true );

        // Font Icon Picker
        wp_register_style( 'fonticonpicker', get_template_directory_uri() . '/assets/js/vendor/font-iconpicker/css/jquery.fonticonpicker.min.css', array(), SMARTY_THEME_VERSION, 'all' );
        wp_register_style( 'fonticonpicker-bootstrap', get_template_directory_uri() . '/assets/js/vendor/font-iconpicker/css/jquery.fonticonpicker.bootstrap.min.css', array(), SMARTY_THEME_VERSION, 'all' );
        wp_register_script( 'fonticonpicker', get_template_directory_uri() . '/assets/js/vendor/font-iconpicker/jquery.fonticonpicker.min.js', array( 'jquery' ), SMARTY_THEME_VERSION, true );

        // Select2
        wp_register_style( 'stm-select2', get_template_directory_uri() . '/assets/js/vendor/select2/css/select2.min.css', array(), SMARTY_THEME_VERSION, 'all' );
        wp_register_script( 'stm-select2', get_template_directory_uri() . '/assets/js/vendor/select2/js/select2.min.js', array( 'jquery' ), SMARTY_THEME_VERSION, true );

        // Skins
        wp_register_style( 'stm-skin-orange', get_template_directory_uri() . '/assets/css/'.smarty_get_layout_mode().'/skin-orange.css', null, SMARTY_THEME_VERSION, 'all' );
        wp_register_style( 'stm-skin-purple', get_template_directory_uri() . '/assets/css/'.smarty_get_layout_mode().'/skin-purple.css', null, SMARTY_THEME_VERSION, 'all' );
        wp_register_style( 'stm-skin-red', get_template_directory_uri() . '/assets/css/'.smarty_get_layout_mode().'/skin-red.css', null, SMARTY_THEME_VERSION, 'all' );
        if( is_dir( $upload_dir['basedir'] . '/stm_uploads' ) ) {
            wp_register_style( 'stm-skin-custom', $stm_upload_dir . '/skin-custom.css', null, SMARTY_THEME_VERSION, 'all' );
        }

        // Bootstrap
        wp_register_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), SMARTY_THEME_VERSION, 'all' );
        wp_register_script( 'bootstrap', get_template_directory_uri() . '/assets/js/vendor/bootstrap.min.js', array( 'jquery' ), SMARTY_THEME_VERSION, true );

        // CountUp
        wp_register_script( 'count-up', get_template_directory_uri() . '/assets/js/vendor/countUp.min.js', array( 'jquery' ), SMARTY_THEME_VERSION, true );

        // CountDown
        wp_register_script( 'countdown', get_template_directory_uri() . '/assets/js/vendor/jquery.countdown.js', array( 'jquery' ), SMARTY_THEME_VERSION, true );

        // Isotope
        wp_register_script( 'isotope', get_template_directory_uri() . '/assets/js/vendor/isotope.pkgd.min.js', array( 'jquery' ), SMARTY_THEME_VERSION, true );

        // ImagesLoaded
        wp_register_script( 'imagesloaded', get_template_directory_uri() . '/assets/js/vendor/imagesloaded.pkgd.min.js', array( 'jquery' ), SMARTY_THEME_VERSION, true );

        // HoverDir
        wp_register_script( 'hoverdir', get_template_directory_uri() . '/assets/js/vendor/jquery.hoverdir.js', array( 'jquery' ), SMARTY_THEME_VERSION, true );

        // Ajax Submit
        wp_register_script( 'ajaxsubmit', get_template_directory_uri() . '/assets/js/vendor/ajax.submit.js', array( 'jquery' ), SMARTY_THEME_VERSION, true );

        // Vivus
        wp_register_script( 'vivus', get_template_directory_uri() . '/assets/js/vendor/vivus/vivus.min.js', array( 'jquery' ), SMARTY_THEME_VERSION, true );

        // Custom
        wp_register_script( 'stm-custom', get_template_directory_uri() . '/assets/js/custom.js', array( 'jquery' ), SMARTY_THEME_VERSION, true );

    }
}
add_action( 'wp_loaded', 'smarty_register_scripts' );

// Enqueue Scripts
if ( ! function_exists('smarty_enqueue_scripts') ) {
    function smarty_enqueue_scripts() {
        $upload_dir = wp_upload_dir();

        // STM Fonts
        if( ! wp_script_is( 'stm-custom-fonts' ) ) {
            wp_enqueue_style( 'stm-fonts', smarty_fonts_url(), array(), null );
        }

        // Bootstrap
        wp_enqueue_style( 'bootstrap' );
        wp_enqueue_script( 'bootstrap' );

        // FontAwesome
        wp_enqueue_style( 'font-awesome' );

        // STM Icon
        wp_enqueue_style( 'stm-icon' );

        // Select2
        wp_enqueue_style( 'stm-select2' );
        wp_enqueue_script( 'stm-select2' );

        // Site Colors
        wp_enqueue_style( 'stm-skin-' . get_theme_mod( 'site_skin_color', 'default' ) );

        // Comment Replay
        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }

        // Style
        wp_enqueue_style( 'stm-style' );

        // Custom
        wp_enqueue_script( 'stm-custom' );
    }
}
add_action( 'wp_enqueue_scripts', 'smarty_enqueue_scripts' );

// Enqueue Admin Scripts
if ( ! function_exists('smarty_enqueue_admin_scripts') ) {
    function smarty_enqueue_admin_scripts() {

	    wp_enqueue_style( 'stm-fonts', smarty_fonts_url(), array(), null );
	    wp_enqueue_style( 'stm-gutenberg', get_template_directory_uri() . '/assets/admin/css/gutenberg.css', array(), SMARTY_THEME_VERSION, 'all' );
        // STM Icon
        wp_enqueue_style( 'stm-icon' );

        // Font Icon Picker
        wp_enqueue_style( 'fonticonpicker' );
        wp_enqueue_script( 'fonticonpicker' );
        wp_enqueue_style( 'fonticonpicker-bootstrap' );
    }
}
add_action( 'admin_enqueue_scripts', 'smarty_enqueue_admin_scripts' );