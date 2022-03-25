<?php

if ( ! function_exists('smarty_print_styles') ) {
	function smarty_print_styles() {
		$post_id        = get_the_ID();
		$page_for_posts = get_option( 'page_for_posts' );
		if ( is_home() || is_category() || is_search() || is_tag() || is_tax() ) {
			$post_id = $page_for_posts;
		}

		$front_css = '';

		if( get_theme_mod( 'site_layout_boxed' ) ) {
			$site_bg_image_custom = get_theme_mod('site_bg_image_custom');
			$site_bg_pattern_custom = get_theme_mod('site_bg_pattern_custom');

			if( get_theme_mod('site_bg_type', 'image') == 'image' && get_theme_mod('site_bg_image') == 'custom' && !empty( $site_bg_image_custom ) ) {
				$site_bg = $site_bg_image_custom;
			} elseif( get_theme_mod('site_bg_type', 'image') == 'pattern' && get_theme_mod('site_bg_pattern') == 'custom' && !empty( $site_bg_pattern_custom ) ) {
				$site_bg = $site_bg_pattern_custom;
			}

			if( isset( $site_bg ) && !empty( $site_bg ) ) {
				$front_css .= '
						body.site-layout_boxed {
							background-image: url( ' . esc_url( $site_bg ) . ' ) !important;
						}
					';
			}
		}

		$custom_css = get_theme_mod( 'custom_css' );

        if( !empty( $custom_css ) ){
            $front_css .= $custom_css;
        }

        if( !empty( $front_css ) ) {
            $vc_status = get_post_meta( get_the_ID(), '_wpb_vc_js_status', true );
            if( is_404() or is_post_type_archive() or is_search()  or is_single() or $vc_status == "false"){
                wp_add_inline_style( 'stm-style', $front_css );
            }else{
                wp_add_inline_style( 'js_composer_front', $front_css );
            }
        }
	}
}

add_action( 'wp_enqueue_scripts', 'smarty_print_styles' );

if( ! function_exists('smarty_skin_custom') ) {
	function smarty_skin_custom() {
		$site_color = get_theme_mod( 'site_skin_color', 'default' );

		if( $site_color == 'custom' ) {
			global $wp_filesystem;

			if ( empty( $wp_filesystem ) ) {
				require_once ABSPATH . '/wp-admin/includes/file.php';
				WP_Filesystem();
			}

			$custom_style_css = $wp_filesystem->get_contents( get_template_directory() . '/assets/css/'.smarty_get_layout_mode().'/main.css' );
			$base_color = get_theme_mod( 'skin_color_base', '#81ca00' );
			$secondary_color = get_theme_mod( 'skin_color_secondary', '#00aaff' );
			$third_color = get_theme_mod( 'skin_color_third', '#011b3a' );

			$colors_arr = array();
			$colors_arr[] = $base_color;
			$colors_arr[] .= $secondary_color;
			$colors_arr[] .= $third_color;
			$colors_differences = false;

            $styles = array(
                '#81ca00',
                '#0af',
                '#011b3a',
                'rgba(1, 27, 58, 0.85)',
                'rgba(1, 27, 58, 0.1)',
                'rgba(1, 27, 58, 0.25)',
                'rgba(1, 27, 58, 0.5)',
                'rgba(1, 27, 58, 0.75)',
                'rgba(1, 27, 58, 0.58)',
                'rgba(129, 202, 0, 0.8)',
                'rgba(0, 170, 255, 0.75)',
                'rgba(0, 170, 255, 0.4)',
                'rgba(0, 170, 255, 0.5)',
                'rgba(0, 170, 255, 0.8)'
            );

            $custom_style_css = str_replace(
                $styles,
                array(
                    $base_color,
                    $secondary_color,
                    $third_color,
                    smarty_hex2rgba( $base_color, .85 ),
                    smarty_hex2rgba( $base_color, .1 ),
                    smarty_hex2rgba( $base_color, .25 ),
                    smarty_hex2rgba( $base_color, .5 ),
                    smarty_hex2rgba( $base_color, .75 ),
                    smarty_hex2rgba( $base_color, .58 ),
                    smarty_hex2rgba( $secondary_color, .8 ),
                    smarty_hex2rgba( $third_color, .4 ),
                    smarty_hex2rgba( $third_color, .5 ),
                    smarty_hex2rgba( $third_color, .8 ),
                    smarty_hex2rgba( $third_color, .75 )
                ),
                $custom_style_css
            );

            if(smarty_get_layout_mode() == 'university') {
                $styles = array(
                    '#8c1515',
                    '#002147',
                    '#fff'
                );

                $custom_style_css = str_replace(
                    $styles,
                    array(
                        $base_color,
                        $secondary_color,
                        $third_color
                    ),
                    $custom_style_css
                );
            }

            if(smarty_get_layout_mode() == 'kindergarten') {
                $styles = array(
                    '#ff6682',
                    '#56509f',
                    '#ffdd00',
                    'rgba(86, 80, 159, 0.85)',
                    'rgba(86, 80, 159, 0.5)'
                );

                $custom_style_css = str_replace(
                    $styles,
                    array(
                        $base_color,
                        $secondary_color,
                        $third_color,
                        smarty_hex2rgba( $base_color, .85 ),
                        smarty_hex2rgba( $secondary_color, .5 )
                    ),
                    $custom_style_css
                );
            }

            if(smarty_get_layout_mode() == 'school-two') {
                $styles = array(
                    '#1b7344',
                    '#ff9232',
                    '#333333'
                );

                $custom_style_css = str_replace(
                    $styles,
                    array(
                        $base_color,
                        $secondary_color,
                        $third_color
                    ),
                    $custom_style_css
                );
            }

            if(smarty_get_layout_mode() == 'university-two') {
                $styles = array(
                    '#1f2533',
                    '#0c51ff',
                    '#0c51ff'
                );

                $custom_style_css = str_replace(
                    $styles,
                    array(
                        $base_color,
                        $secondary_color,
                        $third_color
                    ),
                    $custom_style_css
                );
            }

            if(smarty_get_layout_mode() == 'kindergarten-two') {
                $styles = array(
                    '#007eff',
                    '#fea633',
                    '#333333'
                );

                $custom_style_css = str_replace(
                    $styles,
                    array(
                        $base_color,
                        $secondary_color,
                        $third_color
                    ),
                    $custom_style_css
                );
            }



			$upload_dir = wp_upload_dir();

			if( ! $wp_filesystem->is_dir( $upload_dir['basedir'] . '/stm_uploads' ) ) {
				wp_mkdir_p( $upload_dir['basedir'] . '/stm_uploads' );
			}

			if( $custom_style_css ) {
				$css_to_filter = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $custom_style_css );
				$css_to_filter = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $css_to_filter );

				$custom_style_file = $upload_dir['basedir'] . '/stm_uploads/skin-custom.css';

				if( $custom_style_file ) {
					$custom_style_content = $wp_filesystem->get_contents( $custom_style_file );

					if( is_array( $colors_arr ) && !empty( $colors_arr ) ) {
						foreach( $colors_arr as $color ) {
							$color_find = strpos( $custom_style_content, $color );
							if( ! $color_find && ! $colors_differences ) {
								$colors_differences = true;
							}
						}
					}

					if( $colors_differences ) {
						$wp_filesystem->put_contents( $custom_style_file, $css_to_filter, FS_CHMOD_FILE );
					}
				} else {
					$wp_filesystem->put_contents( $custom_style_file, $css_to_filter, FS_CHMOD_FILE );
				}
			}
		}
	}
}

add_action( 'customize_save_after', 'smarty_skin_custom', 20 );