<?php
$view_style = '';
$column_count = '';
$column_count_list = '';
$event_category = '';
$events_count = '';
$pagination_enable = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

// Thumbnail size
$thumb_size = '360x300';

// Box style
$box_styles = array(
    'margin-bottom:' . $box_margin_b
);

$box_inline_style = smarty_element_style($box_styles);

// Content box style
$content_box_styles = array(
    'padding-top:' . $content_padding_t,
    'padding-right:' . $content_padding_r,
    'padding-bottom:' . $content_padding_b,
    'padding-left:' . $content_padding_l,
    'margin-top:' . $content_margin_t,
    'margin-bottom:' . $content_margin_b,
    'background-color:' . esc_attr( $content_color_custom )
);
$content_box_inline_style = smarty_element_style($content_box_styles);

$meta_styles = array(
    'color:' . esc_attr( $meta_color_custom )
);
$meta_inline_style = smarty_element_style($meta_styles);

$meta_icons_styles = array(
    'color:' . esc_attr( $meta_icons_color_custom )
);
$meta_icons_inline_style = smarty_element_style($meta_icons_styles);

$title_styles = array(
    'color:' . esc_attr( $title_color_custom )
);

$title_inline_style = smarty_element_style($title_styles);

// Events - WP Query
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$events_q_args = array(
	'post_type' 	 => 'stm_event',
	'posts_per_page' => -1,
	'paged' 		 => $paged,
	'orderby' => 'meta_value_num',
	'meta_key' => 'stm_event_date_start',
    'order' => 'ASC'
);

if( $events_count ) {
	$events_q_args['posts_per_page'] = $events_count;
}

if( $event_category ) {
	$events_q_args['stm_event_category'] = $event_category;
}

$events_q = new WP_Query( $events_q_args );

?>
<?php if( $events_q->have_posts() ) : ?>
    <?php if( $view_style == 'grid2' ) : ?>
        <div class="stm-events<?php echo esc_attr( $css_class ); ?>">
            <div class="row">
                <?php while( $events_q->have_posts() ) : $events_q->the_post(); ?>
                <div class="col-md-<?php echo esc_attr($column_count); ?> col-sm-12">
                    <div class="stm-event stm-event_view_grid2" <?php echo sanitize_text_field( $box_inline_style ); ?>>
                        <div class="stm-event__body">
                            <?php if( $thumbnail_enable ) : ?>
                                <?php if( has_post_thumbnail() ) : ?>
                                <div class="stm-event__width_thumb">
                                    <?php
                                        $thumb = wpb_getImageBySize( array(
                                            'attach_id'  => get_post_thumbnail_id(),
                                            'thumb_size' => $thumb_size
                                        ) );
                                        ?>
                                        <div class="stm-event__thumbnail">
                                            <a href="<?php the_permalink() ?>"><?php echo wp_kses_post( $thumb['thumbnail'] ); ?></a>
                                        </div>
                                    <?php else : ?>
                                        <div class="stm-event__thumbnail">
                                            <a href="<?php the_permalink() ?>"><img src="<?php echo esc_url( SMARTY_TEMPLATE_URI . '/assets/img/tmp/placeholder.jpg' ); ?>" alt="<?php echo esc_attr__('Placeholder', 'smarty'); ?>"></a>
                                        </div>
                                    <?php endif; ?>
                                    <?php if( $stm_event_date_start = get_post_meta( get_the_ID(), 'stm_event_date_start', true ) ) : ?>
                                        <div class="stm-event__date">
                                            <div class="stm-event__date_day"><?php echo date_i18n( 'j', $stm_event_date_start ); ?></div>
                                            <div class="stm-event__date_month"><?php echo date_i18n( 'M', $stm_event_date_start ); ?></div>
                                        </div>
                                    <?php endif; ?>
                                    <h5 class="stm-event__title"><a href="<?php the_permalink() ?>" <?php echo sanitize_text_field( $title_inline_style ); ?>><?php the_title(); ?></a></h5>
                                </div>
                            <?php else : ?>
                                <div class="event-content-box" <?php echo sanitize_text_field( $content_box_inline_style ); ?>>
                                    <div class="stm-event__left <?php if( $separator_enable ) : ?>stm-event__left_separator<?php endif; ?>">
                                        <?php if( $stm_event_date_start = get_post_meta( get_the_ID(), 'stm_event_date_start', true ) ) : ?>
                                            <div class="stm-event__date">
                                                <div class="stm-event__date-month"><?php echo date_i18n( 'F', $stm_event_date_start ); ?></div>
                                                <div class="stm-event__date-day"><?php echo date_i18n( 'j', $stm_event_date_start ); ?></div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="stm-event__content">
                                        <?php if( $separator_enable ) : ?>
                                            <div class="stm-event__content_separator"></div>
                                        <?php endif; ?>
                                        <div class="stm-event__meta">
                                            <ul>
                                                <?php if( $stm_event_time_text = get_post_meta( get_the_ID(), 'stm_event_time_text', true ) ) : ?>
                                                    <li><span class="stm-event__time" <?php echo sanitize_text_field( $meta_inline_style ); ?>><span class="stm-icon stm-icon-clock" <?php echo sanitize_text_field( $meta_icons_inline_style ); ?>></span> <?php echo esc_html( $stm_event_time_text ); ?></span></li>
                                                <?php else: ?>
                                                    <?php
                                                    $stm_event_time_end = get_post_meta( get_the_ID(), 'stm_event_time_end', true );
                                                    $stm_event_time_start = get_post_meta( get_the_ID(), 'stm_event_time_start', true );
                                                    ?>
                                                    <?php if( !empty( $stm_event_time_start ) || !empty( $stm_event_time_end ) ) : ?>
                                                        <li>
                                                    <span class="stm-event__time" <?php echo sanitize_text_field( $meta_inline_style ); ?>><span class="stm-icon stm-icon-clock" <?php echo sanitize_text_field( $meta_icons_inline_style ); ?>></span>
                                                        <?php
                                                        if( $stm_event_time_start != '' && $stm_event_time_end != '' ) {
                                                            echo esc_html( $stm_event_time_start ) . ' ' . esc_html__('to', 'smarty') . ' ' . esc_html( $stm_event_time_end );
                                                        } elseif( $stm_event_time_start == '' ) {
                                                            echo esc_html( $stm_event_time_end );
                                                        } elseif( $stm_event_time_end == '' ) {
                                                            echo esc_html( $stm_event_time_start );
                                                        }
                                                        ?>
                                                    </span>
                                                        </li>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                <?php if( $stm_event_venue = get_post_meta( get_the_ID(), 'stm_event_venue', true ) ) : ?>
                                                    <li><span class="stm-event__venue" <?php echo sanitize_text_field( $meta_inline_style ); ?>><span class="stm-icon stm-icon-location" <?php echo sanitize_text_field( $meta_icons_inline_style ); ?>></span><?php echo esc_html($stm_event_venue); ?></span></li>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                        <h5 class="stm-event__title"><a href="<?php the_permalink() ?>" <?php echo sanitize_text_field( $title_inline_style ); ?>><?php the_title(); ?></a></h5>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
            <div class="clearfix"></div>
            <?php
            if( $pagination_enable ) {
                //Pagination
                smarty_paging_nav( 'paging_view_posts-list', $events_q );
            }
            ?>
            <?php wp_reset_postdata(); ?>
        </div>
    <?php elseif( $view_style == 'list2' ) : ?>
        <div class="stm-events<?php echo esc_attr( $css_class ); ?>">
            <div class="row">
                <?php while( $events_q->have_posts() ) : $events_q->the_post(); ?>
                    <div class="col-md-<?php echo esc_attr($column_count_list); ?> col-sm-12">
                        <div class="stm-event stm-event_view_list2">
                            <div class="stm-event__body">
                                <?php if( $thumbnail_enable ) : ?>
                                    <?php if( has_post_thumbnail() ) : ?>
                                        <?php
                                        $thumb = wpb_getImageBySize( array(
                                            'attach_id'  => get_post_thumbnail_id(),
                                            'thumb_size' => $thumb_size
                                        ) );
                                        ?>
                                        <div class="stm-event__thumbnail">
                                            <a href="<?php the_permalink() ?>"><?php echo wp_kses_post( $thumb['thumbnail'] ); ?></a>
                                        </div>
                                    <?php else : ?>
                                        <div class="stm-event__thumbnail">
                                            <a href="<?php the_permalink() ?>"><img src="<?php echo esc_url( SMARTY_TEMPLATE_URI . '/assets/img/tmp/placeholder.jpg' ); ?>" alt="<?php echo esc_attr__('Placeholder', 'smarty'); ?>"></a>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <div class="event-content-box" <?php echo sanitize_text_field( $content_box_inline_style ); ?>>
                                    <div class="stm-event__left <?php if( $separator_enable ) : ?>stm-event__left_separator<?php endif; ?>">
                                        <?php if( $stm_event_date_start = get_post_meta( get_the_ID(), 'stm_event_date_start', true ) ) : ?>
                                            <div class="stm-event__date">
                                                <div class="stm-event__date-month"><?php echo date_i18n( 'F', $stm_event_date_start ); ?></div>
                                                <div class="stm-event__date-day"><?php echo date_i18n( 'j', $stm_event_date_start ); ?></div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="stm-event__content">
                                        <?php if( $separator_enable ) : ?>
                                            <div class="stm-event__content_separator"></div>
                                        <?php endif; ?>
                                        <div class="stm-event__meta">
                                            <ul>
                                                <?php if( $stm_event_time_text = get_post_meta( get_the_ID(), 'stm_event_time_text', true ) ) : ?>
                                                    <li><span class="stm-event__time" <?php echo sanitize_text_field( $meta_inline_style ); ?>><span class="stm-icon stm-icon-clock" <?php echo sanitize_text_field( $meta_icons_inline_style ); ?>></span> <?php echo esc_html( $stm_event_time_text ); ?></span></li>
                                                <?php else: ?>
                                                    <?php
                                                    $stm_event_time_end = get_post_meta( get_the_ID(), 'stm_event_time_end', true );
                                                    $stm_event_time_start = get_post_meta( get_the_ID(), 'stm_event_time_start', true );
                                                    ?>
                                                    <?php if( !empty( $stm_event_time_start ) || !empty( $stm_event_time_end ) ) : ?>
                                                        <li>
                                                        <span class="stm-event__time" <?php echo sanitize_text_field( $meta_inline_style ); ?>><span class="stm-icon stm-icon-clock" <?php echo sanitize_text_field( $meta_icons_inline_style ); ?>></span>
                                                            <?php
                                                            if( $stm_event_time_start != '' && $stm_event_time_end != '' ) {
                                                                echo esc_html( $stm_event_time_start ) . ' ' . esc_html__('to', 'smarty') . ' ' . esc_html( $stm_event_time_end );
                                                            } elseif( $stm_event_time_start == '' ) {
                                                                echo esc_html( $stm_event_time_end );
                                                            } elseif( $stm_event_time_end == '' ) {
                                                                echo esc_html( $stm_event_time_start );
                                                            }
                                                            ?>
                                                        </span>
                                                        </li>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                <?php if( $stm_event_venue = get_post_meta( get_the_ID(), 'stm_event_venue', true ) ) : ?>
                                                    <li><span class="stm-event__venue" <?php echo sanitize_text_field( $meta_inline_style ); ?>><span class="stm-icon stm-icon-location" <?php echo sanitize_text_field( $meta_icons_inline_style ); ?>></span><?php echo esc_html($stm_event_venue); ?></span></li>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                        <h5 class="stm-event__title"><a href="<?php the_permalink() ?>" <?php echo sanitize_text_field( $title_inline_style ); ?>><?php the_title(); ?></a></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <?php
            if( $pagination_enable ) {
                //Pagination
                smarty_paging_nav( 'paging_view_posts-list', $events_q );
            }
            ?>
            <?php wp_reset_postdata(); ?>
        </div>
    <?php else : ?>
        <div class="stm-events<?php echo esc_attr( $css_class ); ?>">
            <div class="row">
                <?php while( $events_q->have_posts() ) : $events_q->the_post(); ?>
                <?php if( $view_style == 'grid' ) : ?>
                    <div class="col-md-6 col-sm-12">
                <?php else : ?>
                    <div class="col-xs-12">
                <?php endif; ?>
                    <div class="stm-event stm-event_view_grid">
                        <div class="stm-event__body">
                            <div class="stm-event__left">
                                <?php if( $stm_event_date_start = get_post_meta( get_the_ID(), 'stm_event_date_start', true ) ) : ?>
                                    <div class="stm-event__date">
                                        <div class="stm-event__date-day"><?php echo date_i18n( 'j', $stm_event_date_start ); ?></div>
                                        <div class="stm-event__date-month"><?php echo date_i18n( 'F', $stm_event_date_start ); ?></div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="stm-event__content">
                                <div class="stm-event__meta">
                                    <ul>
                                    <?php if( $stm_event_time_text = get_post_meta( get_the_ID(), 'stm_event_time_text', true ) ) : ?>
                                        <li><span class="stm-event__time"><span class="stm-icon stm-icon-clock"></span> <?php echo esc_html( $stm_event_time_text ); ?></span></li>
                                    <?php else: ?>
                                        <?php
                                            $stm_event_time_end = get_post_meta( get_the_ID(), 'stm_event_time_end', true );
                                            $stm_event_time_start = get_post_meta( get_the_ID(), 'stm_event_time_start', true );
                                        ?>
                                        <?php if( !empty( $stm_event_time_start ) || !empty( $stm_event_time_end ) ) : ?>
                                            <li>
                                                <span class="stm-event__time"><span class="stm-icon stm-icon-clock"></span>
                                                <?php
                                                    if( $stm_event_time_start != '' && $stm_event_time_end != '' ) {
                                                        echo esc_html( $stm_event_time_start ) . ' ' . esc_html__('to', 'smarty') . ' ' . esc_html( $stm_event_time_end );
                                                    } elseif( $stm_event_time_start == '' ) {
                                                        echo esc_html( $stm_event_time_end );
                                                    } elseif( $stm_event_time_end == '' ) {
                                                        echo esc_html( $stm_event_time_start );
                                                    }
                                                ?>
                                                </span>
                                            </li>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if( $stm_event_venue = get_post_meta( get_the_ID(), 'stm_event_venue', true ) ) : ?>
                                        <li><span class="stm-event__venue"><span class="stm-icon stm-icon-location"></span><?php echo esc_html($stm_event_venue); ?></span></li>
                                    <?php endif; ?>
                                    </ul>
                                </div>
                                <h5 class="stm-event__title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
                <?php
                if( $pagination_enable ) {
                    //Pagination
                    smarty_paging_nav( 'paging_view_posts-list', $events_q );
                }
                ?>
                <?php wp_reset_postdata(); ?>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>