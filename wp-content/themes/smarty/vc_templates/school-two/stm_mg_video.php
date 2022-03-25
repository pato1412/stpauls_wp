<?php
/* === VARIABLES === */
$title = '';
$item_count = '';
$view_type = '';
$button_link = '';
$button_text = '';

/* === GET ATTRIBUTES === */
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

/* === CSS CLASS === */
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

/* === ENQUEUE SCRIPT & STYLE === */
if( $view_type == 'carousel' ) {
	wp_enqueue_style( 'animate' );
	wp_enqueue_style( 'owl-carousel' );
	wp_enqueue_script( 'owl-carousel' );
}

/* === QUERY === */
$items_query_args = array(
	'post_type' => 'stm_media_gallery',
	'posts_per_page' => -1,
	'meta_query' => array(
		'relation' => 'AND',
		array(
			'key'     => 'media_featured',
			'value'   => 'on',
			'compare' => 'LIKE',
		),
		array(
			'key'     => 'media_type',
			'value'   => 'video',
			'compare' => 'LIKE',
		)
	)
);

if( $item_count ) {
	$items_query_args['posts_per_page'] = $item_count;
}

$items_query = new WP_Query( $items_query_args );

/* === ID === */
$media_gallery_id = uniqid('stm-media-gallery-');
$text_carousel_id = uniqid('stm-text-carousel-');
$video_carousel_id = uniqid('stm-video-carousel-');
$text_carousel_dots_id = uniqid('stm-text-carousel-dots-');

/* === BUTTON ===
 *
 * 1. Link
 *
*/

// 1. Link
if( !empty( $button_link ) ) {
	$button_link = vc_build_link( $button_link );
	if( empty( $button_link['target'] ) ) $button_link['target'] = '_self';
}
?>

<?php if( $items_query->have_posts() ) : ?>

	<!-- Stm Media Gallery - Video -->
	<div class="stm-media-gallery stm-media-gallery_format_video stm-media-gallery_view_carousel<?php echo esc_attr( $css_class ); ?>">
		<div class="row">
			<div class="col-md-7 col-md-push-5 col-sm-12">
				<div class="hidden-md hidden-lg">
					<?php if( !empty( $title ) ) : ?>
						<h2 class="stm-media-gallery__title"><?php echo esc_html( $title ); ?></h2>
						<hr class="stm-media-gallery__title-separator stm-border_color_green">
					<?php endif; ?>
				</div>
				<!-- Stm Video Carousel -->
				<div class="stm-video-carousel stm-video-carousel_view_media-gallery" id="<?php echo esc_attr( $video_carousel_id ); ?>">
					<?php while( $items_query->have_posts() ) : $items_query->the_post(); ?>
						<div class="stm-video-carousel__item">
							<?php
								$img_id = get_post_meta( get_the_ID() ,'media_item_img', true );
								$img_src = wp_get_attachment_image_src( $img_id, 'full' );
							?>
							<?php if( $item_link = get_post_meta( get_the_ID() ,'media_item_link', true ) ) : ?>
								<?php if( !empty( $img_src[0] ) ) : ?>
									<div class="stm-video-carousel__item-poster" <?php echo 'style="background-image: url('. esc_url( $img_src[0] ) .')"'; ?>>
										<a href="#" class="stm-video-carousel__item-play"><span class="stm-icon stm-icon-play"></span></a>
									</div>
								<?php endif; ?>
								<iframe class="stm-video-carousel__item-video stm-iframe stm-iframe_format_video stm-iframe_view_media-gallery" width="635" height="450" src="<?php echo esc_url( $item_link ); ?>" frameborder="0" allowfullscreen></iframe>
							<?php endif; ?>
						</div>
					<?php endwhile; ?>
				</div>
			</div>
			<div class="col-md-5 col-md-pull-7 col-sm-12">
				<div class="hidden-sm hidden-xs">
					<?php if( !empty( $title ) ) : ?>
						<h2 class="stm-media-gallery__title"><?php echo esc_html( $title ); ?></h2>
						<hr class="stm-media-gallery__title-separator stm-border_color_green">
					<?php endif; ?>
				</div>
				<!-- Stm Text Carousel -->
				<div class="stm-text-carousel stm-text-carousel_view_media-gallery" id="<?php echo esc_attr( $text_carousel_id ); ?>">
					<?php while( $items_query->have_posts() ) : $items_query->the_post(); ?>
						<div class="stm-text-carousel__item">
							<h4 class="stm-text-carousel__item-title"><?php the_title(); ?></h4>
							<?php if( $item_description = get_post_meta( get_the_ID() ,'media_item_descr', true ) ) : ?>
								<p class="stm-text-carousel__item-description"><?php echo esc_html( $item_description ); ?></p>
							<?php endif; ?>
						</div>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				</div>
				<div class="stm-text-carousel__controls stm-text-carousel__controls_view_media-gallery">
					<div class="stm-text-carousel__dots" id="<?php echo esc_attr( $text_carousel_dots_id ); ?>"></div>
				</div>
				<!-- Stm Media Gallery - Action -->
				<?php if( isset( $button_link['url'] ) && !empty( $button_link['url'] ) && $button_text ) : ?>
					<div class="stm-media-gallery__action">
						<a href="<?php echo esc_url( $button_link['url'] ); ?>" class="stm-btn stm-btn_error stm-btn_outline stm-btn_md stm-btn_icon-left"><i class="fa fa-youtube-play"></i><?php echo esc_html( $button_text ); ?></a>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<?php wp_reset_postdata(); ?>
<?php endif; ?>

<?php
/* === SCRIPT ===
 *
 * - Owl carousel
 * - Play video
 *
*/
if( $view_type == 'carousel' ) :  ?>
<script>
	(function($) {
		"use strict";

		$(document).ready(function() {
			var carouselId = '#<?php echo esc_js( $text_carousel_id ); ?>',
			    videoCarouselId = '#<?php echo esc_js( $video_carousel_id ); ?>',
			    textCarouselDotsId = '#<?php echo esc_js( $text_carousel_dots_id ); ?>',
				  carouselOptions = {
						items:1,
						dotsContainer: textCarouselDotsId,
					  animateOut: 'fadeOutLeft',
					  animateIn: 'fadeInRight',
					  smartSpeed: 450,
					  autoHeight:true
					};

			$(carouselId).owlCarousel(carouselOptions);

			$(videoCarouselId).owlCarousel({
				items: 1,
				smartSpeed: 450,
				dots: false,
				animateOut: 'fadeOut',
				animateIn: 'fadeIn'

			});

			$(carouselId).on("translate.owl.carousel", function(event) {
				$(videoCarouselId).trigger('to.owl.carousel', [event.item.index, 300, true]);
			});

		});

		$(document).on("click", ".stm-video-carousel__item-play", function() {
			var $this = $(this),
				$videoContainer = $this.closest('.stm-video-carousel__item'),
				videoSrc = $videoContainer.find(".stm-video-carousel__item-video").attr('src');

			$videoContainer.find('.stm-video-carousel__item-video').attr( 'src', videoSrc + '?autoplay=1' );

			setTimeout(function() {
				$videoContainer.find('.stm-video-carousel__item-poster').addClass('stm-video-carousel__item-poster_state_hidden');
				$this.hide();
			}, 1000);

			return false;
		});

	})(jQuery);
</script>
<?php endif; ?>
