<?php
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
									<li><span class="stm-event__time"><i class="fa fa-clock-o"></i><?php echo esc_html( $stm_event_time_text ); ?></span></li>
								<?php else: ?>
									<?php
										$stm_event_time_end = get_post_meta( get_the_ID(), 'stm_event_time_end', true );
										$stm_event_time_start = get_post_meta( get_the_ID(), 'stm_event_time_start', true );
									?>
									<?php if( !empty( $stm_event_time_start ) || !empty( $stm_event_time_end ) ) : ?>
										<li>
											<span class="stm-event__time"><i class="fa fa-clock-o"></i>
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
									<li><span class="stm-event__venue"><i class="fa fa-map-marker"></i><?php echo esc_html($stm_event_venue); ?></span></li>
								<?php endif; ?>
								</ul>
							</div>
							<h5 class="stm-event__title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h5>
							<div class="stm-event__summary"><?php the_excerpt(); ?></div>
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