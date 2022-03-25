<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$icon_style = array();

?>

<?php if ( $slider_id ): ?>

	<a href="javascript:void(0);" onclick="revapi<?php echo esc_js( $slider_id ); ?>.revshowslide(<?php echo esc_js( $slide_number ); ?>);" class="rev_slider_nav rev_slider_<?php echo esc_attr( $slider_id ); ?> rev_slide_<?php echo esc_js( $slide_number ); ?>">
		<?php if ( ! empty( $item_sub_title ) ): ?>
            <span class="sub__title">
				<?php echo esc_html( $item_sub_title ); ?>
			</span>
        <?php endif; ?>
		<?php if ( ! empty( $title ) ): ?>
			<span class="title">
				<?php echo esc_html( $title ); ?>
			</span>
		<?php endif; ?>
	</a>

<?php endif; ?>

<script>
    (function($) {
        "use strict";

        $(document).ready(function() {
            $(".rev_slider_nav").on("click", function () {
                $(this).parents().find(".rev_slider_nav.active").removeClass("active");
                $(this).addClass("active");
                return false;
            });

        });

    })(jQuery);
</script>