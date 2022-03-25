<?php
$event_style = '';
$view_style = '';
$event_category = '';
$events_count = '';
$pagination_enable = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

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

	<div class="stm-events<?php echo esc_attr( $css_class ); ?> <?php echo esc_attr( $event_style ); ?>">
		<div class="row">
            <?php while( $events_q->have_posts() ) : $events_q->the_post(); ?>

            <?php if( $view_style == 'grid' ) : ?>
            <div class="col-md-6 col-sm-12">
            <?php else : ?>
            <div class="col-xs-12">
            <?php endif; ?>
            <?php get_template_part('vc_templates/'. smarty_get_layout_mode() . '/stm_events/' . $event_style ); ?>
            </div>

			<?php endwhile; ?>

			<?php
                if( $pagination_enable ) { smarty_paging_nav( 'paging_view_posts-list', $events_q ); }
                wp_reset_postdata();
			?>
		</div>
	</div>

<?php endif; ?>