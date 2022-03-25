<?php
if(!function_exists('stm_set_html_content_type')){
    function stm_set_html_content_type() {
        return 'text/html';
    }
}


// Page ID
if( ! function_exists('smarty_page_id') ) {
    function smarty_page_id() {
        $page_id = '';

        if( class_exists('WooCommerce') && is_woocommerce() ) {
            $page_id = get_option('woocommerce_shop_page_id');
        } elseif( is_home() || is_single() && get_post_type() === 'post' || is_search() || is_archive() ) {
            $page_id = get_option( 'page_for_posts' );
        } else {
            $page_id = get_the_ID();
        }

        if ( smarty_get_layout_mode() === 'school' ) {
            if ( is_singular('stm_course') ) {
                $stm_post_types_options = get_option('stm_post_types_options');
                $page_id = $stm_post_types_options['stm_course']['page_for_courses'];
            }
        }

        if ( smarty_get_layout_mode() === 'university' ) {
            if ( is_singular('stm_course') ) {
                $stm_post_types_options = get_option('stm_post_types_options');
                $page_id = $stm_post_types_options['stm_course']['page_for_courses'];
            }
        }

        return $page_id;
    }
}

if( class_exists( 'WooCommerce' ) ) {
    add_action( 'after_setup_theme', 'stm_woo_setup' );
    function stm_woo_setup() {
        add_theme_support( 'wc-product-gallery-zoom' );
        add_theme_support( 'wc-product-gallery-lightbox' );
    }
}

/**
 * Remove the breadcrumbs
 */
add_action( 'init', 'woo_remove_wc_breadcrumbs' );
function woo_remove_wc_breadcrumbs() {
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}

// Custom Search Form
function smarty_search_form( $form ) {
    $form = '<form role="search" method="get" id="searchform' . rand(1, 1000) . '" class="stm-search-form" action="' . home_url( '/' ) . '">
    <input class="stm-search-form__field" type="search" value="' . get_search_query() . '" name="s" placeholder="'. esc_attr__('Search...', 'smarty') .'" required/>
    <button type="submit" class="stm-search-form__submit"><span class="stm-icon stm-icon-search"></span><span class="stm-search-form__submit-text">' . esc_html__( 'Search', 'smarty' ) . '</span></button>
    </form>';

    return $form;
}
add_filter( 'get_search_form', 'smarty_search_form' );


// Events Taxonomy
function smarty_events_tax_filter($query) {
    if ( is_tax('stm_event_category') && $query->is_main_query() ) {
        $query->set('orderby', 'meta_value_num');
        $query->set('meta_key', 'stm_event_date_start');
        $query->set('order', 'ASC');
    }
}

add_action('pre_get_posts','smarty_events_tax_filter');

// Mime Types
function smarty_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'smarty_mime_types');

// Hex To RGBA
function smarty_hex2rgba($color, $opacity = false) {

    $default = 'rgb(0,0,0)';

    if(empty($color))
        return $default;

    if ($color[0] == '#' ) {
        $color = substr( $color, 1 );
    }

    if (strlen($color) == 6) {
        $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
    } elseif ( strlen( $color ) == 3 ) {
        $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
    } else {
        return $default;
    }

    $rgb =  array_map('hexdec', $hex);

    if($opacity){
        if(abs($opacity) > 1)
            $opacity = 1.0;
        $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
    } else {
        $output = 'rgb('.implode(",",$rgb).')';
    }

    return $output;
}

// Inline Element Style
function smarty_element_style($stm_styles ) {
    $stm_css_property = array();
    $stm_inline_style = '';

    if( !empty( $stm_styles ) ) {
        foreach( $stm_styles as $stm_style ) {
            if( !empty( $stm_style ) ) {
                $stm_style_split = explode( ':', $stm_style );

                if( !empty( $stm_style_split[1] ) ) {
                    $stm_css_property[] = esc_attr( $stm_style );
                }
            }
        }
    }

    if( $stm_css_property ) {
        $stm_inline_style = 'style="'. implode( ';', $stm_css_property ) .'"';
    }

    return $stm_inline_style;
}

// JS Variables
function smarty_js_variables(){
    $variables = array (
        'ajax_url' => admin_url('admin-ajax.php'),
        'is_mobile' => wp_is_mobile(),
        'load_meal' => wp_create_nonce('load_meal'),
        'review_status' => wp_create_nonce('review_status'),
    );
    echo( '<script type="text/javascript">window.wp_data = '. json_encode( $variables ). ';</script>' );
}
add_action('wp_head','smarty_js_variables');
add_action('admin_head','smarty_js_variables');

function smarty_custom_css() {
    global $post;

    // Footer
    if( ! is_404() && ! is_search() && ! is_user_logged_in() && !defined( 'STM_LMS_DB_VERSION' ) ) {
        $footer_id = get_post_meta( $post->ID, 'stm_footer_id', true );

        if( !empty( $footer_id ) ) {
            $footer_custom_css = get_post_meta( $footer_id, '_wpb_shortcodes_custom_css', true );

            if(!empty( $footer_custom_css ) ) {
                wp_add_inline_style( 'js_composer_front', $footer_custom_css );
            }
        }
    }

    // Posts Sidebar
    $posts_sidebar_id = get_theme_mod( 'posts_sidebar_id', 'wp' );

    if( !empty( $posts_sidebar_id ) && $posts_sidebar_id != 'wp' ) {
        $posts_sidebar_custom_css = get_post_meta( $posts_sidebar_id, '_wpb_shortcodes_custom_css', true );

        if(!empty( $posts_sidebar_custom_css ) ) {
            wp_add_inline_style( 'js_composer_front', $posts_sidebar_custom_css );
        }
    }

    // Post Sidebar
    $post_sidebar_id = get_theme_mod( 'post_sidebar_id', 'wp' );

    if( !empty( $post_sidebar_id ) && $post_sidebar_id != 'wp' ) {
        $post_sidebar_custom_css = get_post_meta( $post_sidebar_id, '_wpb_shortcodes_custom_css', true );

        if(!empty( $post_sidebar_custom_css ) ) {
            wp_add_inline_style( 'js_composer_front', $post_sidebar_custom_css );
        }
    }

    // Events Sidebar
    $event_sidebar_id = get_theme_mod('event_sidebar', 'wp');

    if( !empty( $event_sidebar_id ) && $event_sidebar_id != 'wp' ) {
        $event_sidebar_custom_css = get_post_meta( $event_sidebar_id, '_wpb_shortcodes_custom_css', true );

        if(!empty( $event_sidebar_custom_css ) ) {
            wp_add_inline_style( 'js_composer_front', $event_sidebar_custom_css );
        }
    }

    // Donation Sidebar
    $donation_sidebar_id = get_theme_mod('donation_sidebar', 'wp');

    if( !empty( $donation_sidebar_id ) && $donation_sidebar_id != 'wp' ) {
        $donation_sidebar_custom_css = get_post_meta( $donation_sidebar_id, '_wpb_shortcodes_custom_css', true );

        if(!empty( $donation_sidebar_custom_css ) ) {
            wp_add_inline_style( 'js_composer_front', $donation_sidebar_custom_css );
        }
    }
}
add_action( 'wp_enqueue_scripts', 'smarty_custom_css' );

// Donation
if (!function_exists('smarty_donate_action')) {
    function smarty_donate_action()
    {
        check_ajax_referer( 'donate', 'security' );
        $json = array();
        $json['errors'] = array();

        if ( ! filter_var( $_POST['donor']['amount'], FILTER_VALIDATE_INT ) ) {
            $json['errors']['amount'] = true;
        }

        if ( ! empty( $_POST['donor']['custom_amount'] ) ) {
            if ( ! filter_var( $_POST['donor']['custom_amount'], FILTER_SANITIZE_STRING ) ) {
                $json['errors']['custom_amount'] = true;
            }else{
                $_POST['donor']['amount'] = smarty_sanitize_text_field($_POST['donor']['custom_amount']);
            }
        }

        if( !empty( $_POST['donor']['first_name'] ) ) {
            if ( ! filter_var( $_POST['donor']['first_name'], FILTER_SANITIZE_STRING ) ) {
                $json['errors']['first_name'] = esc_html__( 'Please confirm the "Name" field.', 'smarty' );
            }
        } else {
            $json['errors']['first_name'] = esc_html__( 'Please fill in the field.', 'smarty' );
        }

        if( !empty( $_POST['donor']['email'] ) ) {
            if ( ! is_email( $_POST['donor']['email'] ) ) {
                $json['errors']['email'] = esc_html__( 'Please confirm the "E-Mail" field.', 'smarty' );
            }
        } else {
            $json['errors']['email'] = esc_html__( 'Please fill in the field.', 'smarty' );
        }

        if( !empty( $_POST['donor']['phone'] ) ) {
            if ( ! is_numeric( $_POST['donor']['phone'] ) ) {
                $json['errors']['phone'] = esc_html__( 'Please confirm the "Phone" field.', 'smarty' );
            }
        } else {
            $json['errors']['phone'] =  esc_html__( 'Please fill in the field.', 'smarty' );
        }

        if (empty($json['errors'])) {
            $json['success'] = generatePayment( $_POST['donor'] );
        }

        echo json_encode($json);
        exit;
    }
}

add_action('wp_ajax_donate', 'smarty_donate_action');
add_action('wp_ajax_nopriv_donate', 'smarty_donate_action');

/*
 * #Event:
 *
 * 1. Member info
 * 2. Event join
 *
 * */

// 1. Member info
if( ! function_exists('smarty_event_member_info') ) {

    function smarty_event_member_info($data ){

        $return['result'] = true;

        $event_member_data['post_title'] = $data['name'] . esc_html__( ' joined the event: ', 'smarty' ) . '"' . get_the_title( $data['event_id'] ) . '"';
        $event_member_data['post_content'] = $data['message'];
        $event_member_data['post_type']  = 'event_member';
        $event_member_id = wp_insert_post( $event_member_data );

        update_post_meta( $event_member_id, 'event_member_email', $data['email'] );
        update_post_meta( $event_member_id, 'event_member_phone', $data['phone'] );
        update_post_meta( $event_member_id, 'event_member_eventID', $data['event_id'] );
        $event_attended = get_post_meta($data['event_id'], 'event_attended', true );
        update_post_meta( $data['event_id'], 'event_attended', $event_attended + 1 );

        return $return;

    }
}


// Load More Meal
if( !function_exists('smarty_load_meal') ) {
    function smarty_load_meal() {
        check_ajax_referer('load_meal', 'security');
        $weekday_id = intval( $_REQUEST['weekday_id'] );
        $offset = intval( $_REQUEST['offset'] );
        $result['result'] = false;

        $meal_time = get_terms('stm_meal_time');
        if( !empty( $meal_time ) && ! is_wp_error( $meal_time ) ) {
            foreach ( $meal_time as $meal_time_val ) {
                if( $meal_time_val->count > 0 ) {
                    $weekdays_items = get_posts( array(
                        'posts_per_page' => 3,
                        'offset' => $offset,
                        'post_type' => 'stm_meal',
                        'tax_query' => array(
                            'relation' => 'AND',
                            array(
                                'taxonomy' => 'stm_meal_weekdays',
                                'field'    => 'term_id',
                                'terms'    => array( $weekday_id ),
                            ),
                            array(
                                'taxonomy' => 'stm_meal_time',
                                'field'    => 'term_id',
                                'terms'    => array( $meal_time_val->term_id ),
                            )
                        ),
                    ));

                    if( !empty( $weekdays_items ) && ! is_wp_error( $weekdays_items ) ) {
                        foreach ( $weekdays_items as $weekdays_item ) {
                            $post_class = get_post_class( array('stm-meal', 'animated fadeInUp'), $weekdays_item->ID );
                            $result[$meal_time_val->term_id] = '<li class="' . esc_attr( implode( ' ', $post_class ) ) . '">';
                            $result[$meal_time_val->term_id] .= '<div class="stm-meal__content">';
                            if( has_post_thumbnail( $weekdays_item->ID ) ) {
                                $item_image = wpb_getImageBySize(array('attach_id' => get_post_thumbnail_id( $weekdays_item->ID ), 'thumb_size' => '105x105'));
                                $result[$meal_time_val->term_id] .= '<div class="stm-meal__thumbnail">' . wp_kses( $item_image['thumbnail'], array('img'=> array('src' => array(), 'width' => array(), 'height' => array())) ) . '</div>';
                            }
                            $result[$meal_time_val->term_id] .= '<div class="stm-meal__body">';
                            $result[$meal_time_val->term_id] .= '<div class="stm-meal__title">' . get_the_title( $weekdays_item->ID ) . '</div>';
                            $weekdays_item_summary = apply_filters( 'get_the_excerpt', get_post_field('post_excerpt', $weekdays_item->ID, 'raw'));
                            if( !empty( $weekdays_item_summary ) ) {
                                $result[$meal_time_val->term_id] .= '<div class="stm-metal__summary">'. esc_html( $weekdays_item_summary ) .'</div>';
                            }
                            $result[$meal_time_val->term_id] .= '</div>';
                            $result[$meal_time_val->term_id] .= '</div>';
                            $result[$meal_time_val->term_id] .= '</li>';
                        }
                    }
                }
            }
        }

        $result['result'] = true;
        $result = json_encode( $result );
        echo smarty_sanitize_text_field($result);

        wp_die();
    }
}
add_action( 'wp_ajax_smarty_load_meal', 'smarty_load_meal' );
add_action( 'wp_ajax_nopriv_smarty_load_meal', 'smarty_load_meal' );

// Content Layout
function smarty_content_layout($sidebar, $class_custom = '' ) {
    $layout = array();
    $layout['sidebar'] = false;
    $layout['content_class'] = '';
    $layout['main_before'] = '';
    $layout['main_after'] = '';
    $layout['sidebar_before'] = '';
    $layout['sidebar_after'] = '';

    if( $sidebar != 'hide' ) {
        $layout['sidebar'] = true;
        $layout['content_class'] .= ' content_has_sidebar';

        // Main Before
        $layout['main_before'] .= '<div class="row">';
        if( $sidebar == 'left' ) {
            if( !empty( $class_custom['main_before'] ) ) {
                $layout['main_before'] .= '<div class="'. $class_custom['main_before'] .'">';
            } else {
                if( is_singular('stm_donation') || is_singular('stm_event') || is_singular('post') || get_post_type() == 'post' ) {
                    $layout['main_before'] .= '<div class="col-lg-9 col-md-8 col-lg-push-3 col-md-push-4 col-sm-12">';
                } else {
                    $layout['main_before'] .= '<div class="col-md-9 col-md-push-3 col-sm-12">';
                }
            }
            $layout['main_after'] .= '</div>';
            if( !empty( $class_custom['sidebar_before'] ) ) {
                $layout['sidebar_before'] .= '<div class="'. $class_custom['sidebar_before'] .'">';
            } else {
                if( is_singular('stm_donation') || is_singular('stm_event') || is_singular('post') || get_post_type() == 'post' ) {
                    $layout['sidebar_before'] .= '<div class="col-lg-3 col-md-4 col-md-pull-9 hidden-sm hidden-xs">';
                } else {
                    $layout['sidebar_before'] .= '<div class="col-md-3 col-md-pull-9 hidden-sm hidden-xs">';
                }
            }
            $layout['sidebar_after'] .= '</div>';
        } else {
            if( !empty( $class_custom['main_before'] ) ) {
                $layout['main_before'] .= '<div class="'. $class_custom['main_before'] .'">';
            } else {
                if( is_singular('stm_donation') || is_singular('stm_event') || is_singular('post') || get_post_type() == 'post' ) {
                    $layout['main_before'] .= '<div class="col-lg-9 col-md-8 col-sm-12">';
                } else {
                    $layout['main_before'] .= '<div class="col-md-9 col-sm-12">';
                }
            }
            $layout['main_after'] .= '</div>';
            if( !empty( $class_custom['sidebar_before'] ) ) {
                $layout['sidebar_before'] .= '<div class="'. $class_custom['sidebar_before'] .'">';
            } else {
                if( is_singular('stm_donation') || is_singular('stm_event') || is_singular('post') || get_post_type() == 'post' ) {
                    $layout['sidebar_before'] .= '<div class="col-lg-3 col-md-4 hidden-sm hidden-xs">';
                } else {
                    $layout['sidebar_before'] .= '<div class="col-md-3 hidden-sm hidden-xs">';
                }
            }
            $layout['sidebar_after'] .= '</div>';
        }
        $layout['sidebar_after'] .= '</div>';
    }

    return $layout;
}

// Disable WPML CSS
if ( defined( 'ICL_SITEPRESS_VERSION' ) || (bool) get_option( '_wpml_inactive' ) === true ) {
    define( 'ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true );
}

// Header Switcher
function smarty_topbar_lang(){
    $languages = icl_get_languages('skip_missing=0&orderby=code');

    if(!empty($languages)) : ?>

        <div id="top-bar-language" class="wpml-switcher wpml-switcher_type_top-bar">
            <div class="wpml-switcher__languages">
                <?php foreach($languages as $l) : ?>
                <?php if($l['active']) : ?>
                <span class="wpml-switcher__active"><?php echo icl_disp_language( $l['translated_name'] ); ?></span>
                <ul class="wpml-switcher__list">
                    <?php endif; ?>
                    <?php endforeach; ?>

                    <?php foreach( $languages as $l ) : ?>
                        <?php if( !$l['active'] ) : ?>
                            <li>
                                <a href="<?php echo esc_url( $l['url'] ); ?>"><?php echo icl_disp_language( $l['translated_name'] ); ?></a>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

    <?php endif; ?>

    <?php
}

function smarty_topbar_lang_flag(){
    $languages = icl_get_languages('skip_missing=0&orderby=code');

    if(!empty($languages)) : ?>

        <div id="top-bar-language" class="wpml-switcher-flag wpml-switcher_type_top-bar">
            <div class="wpml-switcher__languages">
                <?php foreach($languages as $l) : ?>
                <?php if($l['active']) : ?>
                <span class="wpml-switcher__active"><img src="<?php echo icl_disp_language( $l['country_flag_url'] ); ?>" class="iclflag" width="22" height="16" /> <i class="fa fa-angle-down" aria-hidden="true"></i></span>
                <ul class="wpml-switcher__list">
                    <?php endif; ?>
                    <?php endforeach; ?>

                    <?php foreach( $languages as $l ) : ?>
                        <?php if( !$l['active'] ) : ?>
                            <li>
                                <a href="<?php echo esc_url( $l['url'] ); ?>">
                                    <span class="top-bar-language-table">
                                        <span class="top-bar-language-td"><img src="<?php echo icl_disp_language( $l['country_flag_url'] ); ?>" width="22" height="16" /></span>
                                        <span class="top-bar-language-td"><?php echo icl_disp_language( $l['translated_name'] ); ?></span>
                                    </span>
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

    <?php endif; ?>

    <?php
}

// Footer Socials
function smarty_get_footer_socials() {
    $socials_array = array();

    $footer_socials_enable = get_theme_mod( 'footer_socials_enable' );
    $footer_socials_enable = explode( ',', $footer_socials_enable );

    $socials = get_theme_mod( 'socials' );
    $socials_values = array();
    if ( ! empty( $socials ) ) {
        parse_str( $socials, $socials_values );
    }

    if ( !empty( $footer_socials_enable ) ) {
        foreach ( $footer_socials_enable as $social ) {
            if ( ! empty( $socials_values[ $social ] ) ) {
                $socials_array[ $social ] = $socials_values[ $social ];
            }
        }
    }

    return $socials_array;
}

// Top Bar Socials
function smarty_get_top_bar_socials() {
    $socials_array = array();

    $topbar_socials_enable = get_theme_mod( 'topbar_socials_enable' );
    $topbar_socials_enable = explode( ',', $topbar_socials_enable );

    $socials = get_theme_mod( 'socials' );
    $socials_values = array();
    if ( ! empty( $socials ) ) {
        parse_str( $socials, $socials_values );
    }

    if ( !empty( $topbar_socials_enable ) ) {
        foreach ( $topbar_socials_enable as $social ) {
            if ( ! empty( $socials_values[ $social ] ) ) {
                $socials_array[ $social ] = $socials_values[ $social ];
            }
        }
    }

    return $socials_array;
}

// Paging nav
if ( ! function_exists('smarty_paging_nav') ) :
    function smarty_paging_nav($paging_extra_class = '', $current_query = '' ) {
        global $wp_query, $wp_rewrite;

        if( ! $current_query ) {
            $paged = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
            $pages = $wp_query->max_num_pages;
        } else {
            $paged = $current_query->query_vars['paged'];
            $pages = $current_query->max_num_pages;
        }

        if ( $pages < 2 ) {
            return;
        }

        $pagenum_link = html_entity_decode( get_pagenum_link() );
        $query_args   = array();
        $url_parts    = explode( '?', $pagenum_link );

        if ( isset( $url_parts[1] ) ) {
            wp_parse_str( $url_parts[1], $query_args );
        }

        $pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
        $pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

        $format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
        $format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

        $links = paginate_links( array(
            'base'     => $pagenum_link,
            'format'   => $format,
            'total'    => $pages,
            'current'  => $paged,
            'mid_size' => 1,
            'add_args' => array_map( 'urlencode', $query_args ),
            'prev_text' => '&larr;',
            'next_text' => '&rarr;'
        ) );

        if ( $links ) :

            ?>
            <nav class="navigation paging-navigation <?php echo esc_attr( $paging_extra_class ) ?>" role="navigation">
                <h1 class="screen-reader-text"><?php esc_html_e( 'Posts navigation', 'smarty' ); ?></h1>
                <div class="pagination loop-pagination"><?php echo wp_kses_post( $links ); ?></div><!-- .pagination -->
            </nav><!-- .navigation -->
        <?php
        endif;
    }
endif;

// Custom comment display
function smarty_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);

    $add_below = 'div-comment';

    ?>

    <li <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
        <div id="div-comment-<?php comment_ID() ?>" class="comment__body">
            <div class="comment__author-avatar">
                <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
            </div>
            <div class="comment__right">
                <div class="comment__heading">
                    <div class="comment__author-title">
                        <?php printf( wp_kses(__( '<cite class="fn">%s</cite>', 'smarty' ), array( 'cite' => array( 'class' => array() ) )), get_comment_author_link() ); ?>
                    </div>
                    <div class="comment__meta">
                        <?php
                        $d = "F j, Y";
                        ?>
                        <time class="comment__date" datetime="<?php echo esc_attr( get_comment_date() ); ?>"><?php echo get_comment_date($d); ?></a></time>
                        <?php edit_comment_link( esc_html__( '(Edit)', 'smarty' ), '  ', '' ); ?>
                        <span class="comment__meta-separator"><?php echo esc_html('/'); ?></span>
                        <span class="comment__reply">
							<i class="fa fa-reply"></i><?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
						</span>
                    </div>
                </div>
                <?php if ( $comment->comment_approved == '0' ) : ?>
                    <em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'smarty' ); ?></em>
                    <br />
                <?php endif; ?>
                <div class="comment__content">
                    <?php comment_text(); ?>
                </div>
            </div>
        </div>
    </li>

    <?php
}

// Move comment field
function smarty_move_comment_field($fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
}
add_filter( 'comment_form_fields', 'smarty_move_comment_field' );

/*
 * #Woocommerce
 *
 * 1. Action
 * 2. Filter
 * 3. Update Cart
 *
 * */

// 1. Action

// - Action: Add Theme Support
add_action( 'after_setup_theme', 'smarty_woocommerce_support' );
function smarty_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

// - Action: Remove
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);

// 2. Filter

// - Filter: Remove Scripts and Styles
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

// - Filter: Loop Product Title
function woocommerce_template_loop_product_title() {
    echo '<h5>' . get_the_title() . '</h5>';
}

// - Filter: Loop Shop Columns
add_filter('loop_shop_columns', 'smarty_loop_columns');
if ( !function_exists('smarty_loop_columns') ) {
    function smarty_loop_columns() {
        return 3;
    }
}

// - Filter: Remove Checkout Fields Label
add_filter('woocommerce_checkout_fields','smarty_wc_checkout_fields_no_label');
function smarty_wc_checkout_fields_no_label($fields) {
    // loop by category
    if( !empty( $fields ) ) {
        foreach ($fields as $category => $value) {
            // loop by fields
            if( !empty( $fields[$category] ) ) {
                foreach ($fields[$category] as $field => $property) {
                    // remove label property
                    unset($fields[$category][$field]['label']);
                    if( isset( $property['label'] ) ) {
                        if( isset( $property['required'] ) && $property['required'] ) {
                            $fields[$category][$field]['placeholder'] = $property['label'] . ' *';
                        } else {
                            $fields[$category][$field]['placeholder'] = $property['label'];
                        }
                    }
                }
            }
        }
    }
    return $fields;
}

// - Filter: Remove Billing Fields Label
add_filter('woocommerce_billing_fields','smarty_wc_billing_fields');
function smarty_wc_billing_fields($fields) {
    if( !empty( $fields ) ) {
        foreach ($fields as $field => $property) {
            unset($fields[$field]['label']);
            if( isset( $property['label'] ) ) {
                if( isset( $property['required'] ) && $property['required'] ) {
                    $fields[$field]['placeholder'] = $property['label'] . ' *';
                } else {
                    $fields[$field]['placeholder'] = $property['label'];
                }
            }
        }
    }
    return $fields;
}

// - Filter: Remove Shipping Fields Label
add_filter('woocommerce_shipping_fields','smarty_wc_shipping_fields');
function smarty_wc_shipping_fields($fields) {
    foreach ($fields as $field => $property) {
        unset($fields[$field]['label']);
        if( isset( $property['label'] ) ) {
            if( isset( $property['required'] ) && $property['required'] ) {
                $fields[$field]['placeholder'] = $property['label'] . ' *';
            } else {
                $fields[$field]['placeholder'] = $property['label'];
            }
        }
    }
    return $fields;
}

// Filter: Related Products Args
add_filter( 'woocommerce_output_related_products_args', 'smarty_related_products_args' );
function smarty_related_products_args($args ) {
    $args['posts_per_page'] = 3;
    return $args;
}

// 3. Update Cart
add_filter( 'woocommerce_add_to_cart_fragments', 'smarty_cart_fragments' );
function smarty_cart_fragments() {
    ob_start();
    ?>
    <div class="shopping-cart__products">
        <?php if ( ! WC()->cart->is_empty() ) : ?>
            <?php echo sprintf (_n( '%d product for', '%d products for', WC()->cart->get_cart_contents_count(), 'smarty' ), WC()->cart->get_cart_contents_count() ); ?> <?php echo WC()->cart->get_cart_total(); ?>
        <?php else : ?>
            <?php esc_html_e( 'No products in the cart.', 'smarty' ); ?>
        <?php endif; ?>
    </div>
    <?php if ( smarty_get_layout_mode() === 'kindergarten' || smarty_get_layout_mode() === 'kindergarten-two') : ?>
        <?php if ( ! WC()->cart->is_empty() ) : ?>
            <div class="shopping-cart__products shopping-cart__product"><?php echo sprintf (_n( '%d', '%d', WC()->cart->get_cart_contents_count(), 'smarty' ), WC()->cart->get_cart_contents_count() ); ?></div>
        <?php else : ?>

        <?php endif; ?>
    <?php endif; ?>
    <?php

    $fragments['.shopping-cart__products'] = ob_get_clean();

    return $fragments;
}

// Body Class
if ( ! function_exists('smarty_body_class') ) {
    function smarty_body_class($classes ) {
        if( get_theme_mod( 'site_layout_boxed', false ) ) {
            $classes[] = "site-layout_boxed";

            if( get_theme_mod( 'site_bg_type', 'image' ) == 'image' ) {
                $classes[] = 'site-bg_image';

                $site_bg_image = get_theme_mod( 'site_bg_image' );
                if( !empty( $site_bg_image ) && $site_bg_image != 'custom' ) {
                    $classes[] = 'site-' . $site_bg_image;
                }
            }

            $site_bg_pattern = get_theme_mod( 'site_bg_pattern' );
            if( get_theme_mod( 'site_bg_type', 'image' ) == 'pattern' && !empty( $site_bg_pattern ) && $site_bg_pattern != 'custom' ) {
                $classes[] = 'site-' . $site_bg_pattern;
            }
        }
        return $classes;
    }
}
add_filter( 'body_class', 'smarty_body_class' );

// Header Style4 Nav Walker
class Split_Menu_Walker extends Walker_Nav_Menu {

    public $break_point = null;
    public $displayed = 0;
    private $logoWasSplitted = false;

    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0 ) {

        global $wp_query;

        if( !isset( $this->break_point ) ) {
            $menu_elements = wp_get_nav_menu_items( $args->menu );
            $top_level_elements = 0;

            foreach( $menu_elements as $el ) {
                if( $el->menu_item_parent === '0' ) {
                    $top_level_elements++;
                }
            }
            $this->break_point = ceil( $top_level_elements / 2 ) + 1;
        }



        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $class_names = $value = '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = ' class="' . esc_attr( $class_names ) . '"';

        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

        if( $item->menu_item_parent === '0' ) {
            $this->displayed++;
        }
// echo $this->break_point .'= ' . $this->displayed . "\n";

        if( $this->break_point == $this->displayed  && $this->logoWasSplitted == false) {
            $this->logoWasSplitted = true;
            $output .= $indent . '</li></ul><div class="logo-center-box"></div><ul class="stm-nav__menu stm-nav__menu_type_header"><li' . $id . $value . $class_names . '>';
        }
        else
            $output .= $indent . '<li' . $id . $value . $class_names .'>';

        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args, $id=0 );
    }
}

function smarty_get_teachers($id) {
    return explode(',' ,get_post_meta( $id, 'course_teacher', true ) );
}

function smarty_get_layout_file( $path, $file ) {
    if (file_exists(get_template_directory() . $path . '/' . smarty_get_layout_mode() . $file . '.php' )) {
        get_template_part( $path . '/' . smarty_get_layout_mode() . $file );
    } else {
        get_template_part( $path . $file );
    }
}