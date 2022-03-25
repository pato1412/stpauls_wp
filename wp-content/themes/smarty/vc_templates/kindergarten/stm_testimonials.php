<?php
/* === VARIABLES === */
$stm_testimonial_type = '';
$stm_carousel_color = '';
$stm_carousel_items = '';
$stm_carousel_dots = '';
$stm_carousel_thumb = '';
$title = '';
$enable_cite_customization = '';
$img_size = '144x144';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

if( ! wp_script_is( 'fancybox' ) ) {
    wp_enqueue_script( 'fancybox' );
    wp_enqueue_style( 'fancybox' );
}

if( $stm_testimonial_type === 'carousel' ) :
	/* === SCRIPT & STYLE === */
	if( ! wp_script_is( 'owl-carousel' ) ) {
		wp_enqueue_style( 'owl-carousel' );
		wp_enqueue_script( 'owl-carousel' );
	}

	/* === CLASS === */
	$stm_testimonial_class = '';

	if( !empty( $stm_carousel_color ) ) {
		$stm_testimonial_class .= ' stm-testimonial_color_' . esc_attr( $stm_carousel_color );
	}

	// Carousel - Class
	$carousel_class = '';

	if( !empty( $stm_dots_color ) ) {
		$carousel_class .= ' stm-carousel_dots_'. esc_attr( $stm_dots_color );
	}

	/* === QUERY === */
	$stm_testimonial_q = new WP_Query( array(
		'post_type' => 'stm_testimonial',
		'posts_per_page' => -1
	) );

	?>
	<?php if( $stm_testimonial_q->have_posts() ) : ?>
		<!-- TESTIMONIALS -->
		<div class="stm-testimonials<?php echo esc_attr( $css_class ); ?>">
			<div class="stm-carousel stm-carousel_type_testimonials<?php echo esc_attr( $carousel_class ); ?> <?php if( $stm_carousel_thumb ) : ?>stm-testimonials__has_thumb<?php endif; ?>">
				<?php while( $stm_testimonial_q->have_posts() ) : $stm_testimonial_q->the_post(); ?>
					<div class="stm-testimonial stm-testimonial_style_1<?php echo esc_attr( $stm_testimonial_class ); ?>">
                        <?php if( $stm_carousel_thumb ) : ?>
                            <?php if( has_post_thumbnail() ) : ?>
                                <div class="stm-testimonial__avatar">
                                    <?php $img = wpb_getImageBySize( array( 'attach_id' => get_post_thumbnail_id(), 'thumb_size' => $img_size ) ); ?>
                                    <?php echo wp_kses_post( $img['thumbnail'] ); ?>
                                </div>
                            <?php endif; ?>
						<?php endif; ?>
						<div class="stm-testimonial__content">
							<div class="stm-testimonial__text"><?php the_content(); ?></div>
							<div class="stm-testimonial__author"><?php the_title(); ?></div>
						</div>
					</div>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			</div>
		</div>

		<!-- SCRIPT -->
		<script>
			(function($) {
				"use strict";
				var carouselItems = <?php echo esc_js( $stm_carousel_items ); ?>,
					carouselDots = <?php echo esc_js( $stm_carousel_dots ); ?>,
					carouselAutoPlay = <?php echo esc_js( $stm_carousel_autoplay ); ?>,
					carouselLoop = <?php echo esc_js( $stm_carousel_loop ); ?>,
					carouselOptions = {
						lazyLoad:true,
						dots: false,
						dotsEach: true,
						smartSpeed: 700
					};

				if( carouselDots ) {
					carouselOptions.dots = carouselDots;
				}

				if( carouselItems ) {
					carouselOptions.items = carouselItems;
				}

				if( carouselAutoPlay ) {
					carouselOptions.autoplay = carouselAutoPlay;
				}

				if( carouselLoop ) {
					carouselOptions.loop = carouselLoop;
				}

				$(document).ready(function() {
					$('.stm-carousel_type_testimonials')
						.owlCarousel(carouselOptions);
				});

			})(jQuery);
		</script>

	<?php endif; ?>

<?php elseif( $stm_testimonial_type === 'single_static' ): ?>
	<?php
		$cite_inline_style = '';

		if( $enable_cite_customization ) {
			$cite_inline_styles = array();

			if( $cite_space_top ) {
				$cite_inline_styles[] = 'padding-top:' . esc_attr( $cite_space_top );
			}

			if( $cite_inline_styles ) {
				$cite_inline_style = 'style="' . implode( ';', $cite_inline_styles ) . '"';
			}
		}
	?>
	<div class="stm-blockquote">
		<div class="stm-blockquote__content">
			<?php if( $avatar_id ) : ?>
				<?php
					if( ! $avatar_size ) {
						$avatar_size = 'full';
					}

					$avatar = wpb_getImageBySize( array(
						'attach_id' => $avatar_id,
						'thumb_size' => $avatar_size
					) );
				?>

				<div class="stm-blockquote__avatar">

					<?php echo wp_kses_post( $avatar['thumbnail'] ); ?>

				</div>

			<?php endif; ?>

			<div class="stm-blockquote__body">
				<?php if( $content ): ?>
					<?php echo wpautop($content); ?>
				<?php endif; ?>

				<?php if( $cite ) : ?>
					<footer <?php echo sanitize_text_field( $cite_inline_style ); ?>><?php echo wp_kses_post( $cite ); ?></footer>
				<?php endif; ?>
			</div>
		</div>
	</div>
<?php endif; ?>