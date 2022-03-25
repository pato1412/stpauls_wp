<?php
$donations_count = '';
$pagination_enable = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

// Donations - WP Query
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$donations_q_args = array(
	'post_type' => 'stm_donation',
	'posts_per_page' => -1,
	'paged' => $paged
);

if( $donations_count ) {
	$donations_q_args['posts_per_page'] = $donations_count;
}

$donations_q = new WP_Query( $donations_q_args );

?>
<?php if( $donations_q->have_posts() ) : ?>

	<div class="stm-donations<?php echo esc_attr( $css_class ); ?>">
		<div class="row">
			<?php while( $donations_q->have_posts() ) : $donations_q->the_post(); ?>
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
				<div class="stm-donation stm-donation_view_grid">
					<?php if( has_post_thumbnail() ): ?>
						<div class="stm-donation__thumbnail">
							<?php
								$thumbnail = wpb_getImageBySize( array(
									'attach_id'  => get_post_thumbnail_id(),
									'thumb_size' => '350x240'
								) );
							?>
							<a href="<?php the_permalink(); ?>"><?php echo wp_kses_post( $thumbnail['thumbnail'] ); ?></a>
						</div>
					<?php else : ?>
						<div class="stm-donation__thumbnail">
							<a href="<?php the_permalink() ?>"><img src="<?php echo esc_url( SMARTY_TEMPLATE_URI . '/assets/img/tmp/placeholder.jpg' ); ?>" alt="<?php echo esc_attr__('Placeholder', 'smarty'); ?>"></a>
						</div>
					<?php endif; ?>
					<div class="stm-donation__body">
						<div class="stm-donation__content">
							<h5 class="stm-donation__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
							<?php
								// Data
								$stm_donation_goal = get_post_meta( get_the_ID(), 'stm_donation_goal', true );
								$stm_donation_raised = get_post_meta( get_the_ID(), 'stm_donation_raised', true );
								$stm_donation_currency = get_post_meta( get_the_ID(), 'stm_donation_currency', true );
								$stm_donation_donors = get_post_meta( get_the_ID(), 'stm_donation_donors', true );
								$stm_donation_currency_pos = get_post_meta( get_the_ID(), 'stm_donation_currency_pos', true );

								// Progress
							  $stm_donation_progress = 0;
								if( $stm_donation_goal != '' && $stm_donation_raised != '' ) {
									$stm_donation_progress = round(( $stm_donation_raised / $stm_donation_goal ) * 100);
									if ( $stm_donation_progress > 100 || $stm_donation_progress == 100 ) {
										$stm_donation_progress = 100;
									}
								}
							?>

							<?php if( $stm_donation_goal != '' ) : ?>
								<?php
									// Donated
									$stm_donation_donated = $stm_donation_progress . esc_html__('%' , 'smarty');
									$stm_donation_donated .= '&nbsp;' . esc_html__( 'Donated of', 'smarty' );

									if( $stm_donation_currency_pos == 'right' ) {
										$stm_donation_donated .= '&nbsp;' . number_format($stm_donation_goal) . $stm_donation_currency;
									} else {
										$stm_donation_donated .= '&nbsp;' . $stm_donation_currency . number_format($stm_donation_goal);
									}
								?>
								<div class="stm-donation__donated"><?php echo esc_html( $stm_donation_donated ); ?></div>
							<?php else: ?>
								<div class="stm-donation__donated"><?php esc_html_e( 'Please, Set goal', 'smarty' ); ?></div>
							<?php endif; ?>

							<div class="stm-donation__progress">
									<div class="stm-donation__progress-bar" style="width:<?php echo esc_attr( $stm_donation_progress ) . '%' ; ?>"></div>
							</div>

							<?php
								// Time
								$stm_donation_time = strtotime( get_post_meta( get_the_ID(), 'stm_donation_time', true ) );
								$stm_donation_time_today = strtotime( date( get_option('date_format') . get_option('time_format') ) );
								$stm_donation_time_difference = $stm_donation_time - $stm_donation_time_today;

								if( $stm_donation_time_difference > 0 ) {
									$stm_donation_time_left =  floor( $stm_donation_time_difference/(60*60*24) );
								} else {
									$stm_donation_time_left = 0;
								}

								// State
								$stm_donation_state = get_post_meta( get_the_ID(), 'stm_donation_state', true );
								if( $stm_donation_state === 'completed' ) {
									$stm_donation_time_left = 0;
								}
							?>
							<div class="stm-donation__time">
								<?php
									if( $stm_donation_time_left <= 0 && $stm_donation_progress == 100 ) {
										esc_html_e( 'Thank You!', 'smarty' );
									} elseif( $stm_donation_time_left > 0 ) {
										echo esc_html( $stm_donation_time_left ) . '&nbsp;' . esc_html__( 'Days left to achieve target', 'smarty' );
									} elseif( $stm_donation_time_left <= 0 && $stm_donation_progress < 100 ) {
										esc_html_e( 'No Days left to achieve target', 'smarty' );
									}
								?>
							</div>
							<div class="stm-donation__action">
								<?php if( $stm_donation_time_left > 0 ) : ?>
									<a class="stm-btn stm-btn_outline stm-btn_blue stm-btn_md stm-btn_icon-right" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Donate Now', 'smarty' ); ?><i class="stm-icon stm-icon-arrow-right"></i></a>
								<?php else : ?>
									<button type="button" class="stm-btn stm-btn_outline stm-btn_blue stm-btn_md stm-btn_icon-right stm-btn_disabled"><?php esc_html_e( 'Has been completed', 'smarty' ); ?></button>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php endwhile; ?>
			<?php
			if( $pagination_enable ) {
				//Pagination
				smarty_paging_nav( 'paging_view_posts-list', $donations_q );
			}
			?>
			<?php wp_reset_postdata(); ?>
		</div>
	</div>

<?php endif; ?>