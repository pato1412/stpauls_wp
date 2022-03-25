<?php
$slider_width = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

// Script & Style
wp_enqueue_style( 'owl-carousel' );
wp_enqueue_script( 'owl-carousel' );
//wp_enqueue_style( 'animate' );

// Style
$slider_styles = array(
	'max-width:' . esc_attr( $slider_width )
);
$slider_style = smarty_element_style( $slider_styles );

// ID
$slider_id = uniqid('stm-slider-');
?>

<div class="stm-slider<?php echo esc_attr( $css_class ); ?>" id="<?php echo esc_attr( $slider_id ); ?>" <?php echo sanitize_text_field( $slider_style ); ?>>
	<?php echo wpb_js_remove_wpautop( $content ); ?>
</div>

<script>
	(function($) {
		"use strict";

		$(document).ready(function() {
			var sliderId = '#<?php echo esc_js( $slider_id ); ?>';

			$(sliderId).owlCarousel({
				loop:true,
				nav:true,
				dots:false,
				items:1,
				navText:['&larr;', '&rarr;'],
				smartSpeed: 450
			});
		});

		$(document).on("click", ".stm-slider__video-play", function() {
			var $this = $(this),
					$videoContainer = $this.parent(),
					videoSrc = $videoContainer.find(".stm-slider__video-iframe").attr('src');

			$videoContainer.find('.stm-slider__video-iframe').attr( 'src', videoSrc + '?autoplay=1' );

			setTimeout(function() {
				$videoContainer.find('.stm-slider__video-poster').addClass('stm-slider__video-poster_state_hidden');
				$this.hide();
			}, 1000);

			return false;
		});

	})(jQuery);
</script>