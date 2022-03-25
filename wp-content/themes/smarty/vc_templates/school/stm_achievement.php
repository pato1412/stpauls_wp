<?php
$img_size = $posts_count = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

if( empty( $img_size ) ) {
	$img_size = '548x342';
}

wp_enqueue_style( 'owl-carousel' );
wp_enqueue_script( 'owl-carousel' );

wp_enqueue_script( 'fancybox' );
wp_enqueue_style( 'fancybox' );

$stm_achievement_q_args = array(
	'post_type' => 'stm_achievement',
	'posts_per_page' => -1
);

if( !empty( $posts_count ) ) {
	$stm_achievement_q_args['posts_per_page'] = $posts_count;
}

$achievement_cat_terms = get_terms( 'stm_achievement_category' );

if( !empty( $achievement_cat_terms ) ) {

	foreach( $achievement_cat_terms as $achievement_cat_term ) {
		if( ${'stm_cat_'.$achievement_cat_term->slug} ) {
			$stm_achievement_cat_enable[] = $achievement_cat_term->slug;
		}
	}
}

if( !empty( $posts_count ) ) {
	$stm_achievement_q_args['posts_per_page'] = $posts_count;
}

if( isset( $stm_achievement_cat_enable ) && !empty( $stm_achievement_cat_enable ) ) {
	$stm_achievement_q_args['stm_achievement_category'] = implode(',', $stm_achievement_cat_enable);
}

$stm_achievement_q = new WP_Query($stm_achievement_q_args);

$stm_achievement_item_class = '';

$stm_carousel_id = uniqid('stm_carousel_');
?>

<?php if( $stm_achievement_q->have_posts() ) : ?>

	<div class="stm-vc-container<?php echo esc_attr( $css_class ); ?>">
		<div class="stm-images-carousel stm-images-carousel_achievement" id="<?php echo esc_attr( $stm_carousel_id ); ?>">
			<?php while( $stm_achievement_q->have_posts() ) : $stm_achievement_q->the_post(); ?>
				<div class="stm-images-carousel__item">
					<?php if( has_post_thumbnail() ) : ?>

						<?php
							$img = wpb_getImageBySize( array(
								'attach_id' => get_post_thumbnail_id(),
								'thumb_size' => $img_size
							) );
							$img_full = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
						?>

						<div class="stm-image stm-image_achievement stm-image_style-1">
							<div class="stm-image__content">
								<a class="stm-image__link stm-fancybox" href="<?php echo esc_url( $img_full[0] ); ?>"><?php echo wp_kses_post( $img['thumbnail'] ); ?></a>
							</div>
						</div>

					<?php endif; ?>
				</div>
			<?php endwhile; ?>
		</div>
		<?php wp_reset_postdata(); ?>
	</div>

	<script>
		(function($) {
			"use strict";

			$(document).ready(function() {
				var carouselId = '<?php echo esc_js( $stm_carousel_id ); ?>';

				$('#'+carouselId).owlCarousel({
					loop    : false,
					margin  : 30,
					nav     : false,
					responsive : {
						0 : {
							items : 1
						},
						480 : {
							items : 2
						},
						992 : {
							items : 3
						}
					}
				});
			});

		})(jQuery);
	</script>

<?php endif; ?>