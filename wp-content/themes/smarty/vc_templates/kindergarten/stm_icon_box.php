<?php
/* === VARIABLES === */
$title = '';
$title_link = '';
$title_small = '';
$descr = '';
$icon_position = '';
$img_id = '';
$img_single_id = '';
$view_style = '';
$separator_enable = '';
$button_enable = '';
$button_text = '';
$button_link = '';
$title_margin_b = '';
$title_line_height = '';
$descr_margin_t = '';
$descr_margin_b = '';
$descr_line_height = '';
$step_enable = '';
$step_number = '';
$step_number_size = '';
$step_number_color = '';
$step_number_pos_b = '';
$step_number_pos_r = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

/** Styles **/
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

// Box styles
$icon_box_classes = '';

if( $icon_position != '' ) {
    $icon_box_classes .= ' stm-icon-box_ic-pos_' . esc_attr( $icon_position );
}

if( $button_enable ) {
	$icon_box_classes .= ' stm-icon-box_has_button';
}

if( $view_style != '' ) {
	$icon_box_classes .= ' stm-icon-box_' . $view_style;
}

$icon_box_inline_styles = array(
  'text-align:' . esc_attr( $text_alignment )
);

$icon_box_inline_style = smarty_element_style( $icon_box_inline_styles );

// Icon styles
$icon_classes = '';

$icons_inline_styles = array(
    'font-size:' . esc_attr( $icon_size ),
    'margin-top:' . esc_attr( $top_indent )
);

if( $icon_color === 'custom' && !empty( $icon_color_custom ) ) {
    $icons_inline_styles[] = 'color:' . $icon_color_custom;
} elseif ( !empty( $icon_color ) && $icon_color !== 'custom' ) {
    $icon_classes .= ' stm-font_color_' . esc_attr( $icon_color );
}

$icon_inline_style = smarty_element_style( $icons_inline_styles );

$title_link = vc_build_link( $title_link );
if( !empty( $title_link['url'] ) && $title != '' ) {

    if( $title_link['target'] == '' ) {
        $title_link['target'] = '_self';
    }

    $title_link = '<a href="'. esc_url( $title_link['url'] ) .'" target="'. esc_attr( $title_link['target'] ) .'">'. esc_html( $title ) .'</a>';

} else {
    $title_link = '';
}

// Title - Style
$title_classes = '';

$title_inline_styles = array(
	'font-size:' . esc_attr( $title_font_size ),
	'line-height:' . esc_attr( $title_line_height ),
	'margin-bottom:' . esc_attr( $title_margin_b )
);

if( $title_color === 'custom' && !empty( $title_color_custom ) ) {
	$title_inline_styles[] = 'color:' . $title_color_custom;
} elseif ( !empty( $title_color ) && $title_color !== 'custom' ) {
	$title_classes .= ' stm-font_color_' . esc_attr( $title_color );
}

$title_inline_style = smarty_element_style( $title_inline_styles );

// Sub title - Classes
$sub_title_classes = array();

// Sub title - Style
$sub_title_styles = array(
	'font-size:' . esc_attr( $sub_title_font_size ),
	'line-height:' . esc_attr( $sub_title_line_height )
);

if( $sub_title_color == 'custom' ) {
	$sub_title_styles[] = 'color:' . esc_attr( $sub_title_color_custom );
} else {
	$sub_title_classes[] = 'stm-font_color_' . esc_attr( $sub_title_color );
}

if( $sub_title_classes ) {
	$sub_title_class = implode( ' ', $sub_title_classes );
}

$sub_title_style = smarty_element_style( $sub_title_styles );

// Descr styles
$descr_classes = '';

$descr_inline_styles = array(
    'font-size:' . esc_attr( $descr_font_size ),
		'margin-top:' . esc_attr( $descr_margin_t ),
		'margin-bottom:' . esc_attr( $descr_margin_b ),
		'line-height:' . esc_attr( $descr_line_height )
);

if( $descr_color === 'custom' && !empty( $descr_color_custom ) ) {
    $descr_inline_styles[] = 'color:' . $descr_color_custom;
} elseif ( !empty( $descr_color ) && $descr_color !== 'custom' ) {
    $descr_classes .= ' stm-font_color_' . esc_attr( $descr_color );
}

$descr_inline_style = smarty_element_style( $descr_inline_styles );

// Button
if( $button_link != '' ) {
	$button_link = vc_build_link( $button_link );
	if( $button_link['target'] == '' ) {
		$button_link['target'] = '_self';
	}
}

// Step
$step_styles = array(
	'font-size:' . esc_attr( $step_number_size ),
	'color:' . esc_attr( $step_number_color ),
	'bottom:' . esc_attr( $step_number_pos_b ),
	'right:' . esc_attr( $step_number_pos_r )
);
$step_style = smarty_element_style( $step_styles );

// Separator
$sep_class = '';

if( !empty( $sep_color ) && $sep_color != 'custom' ) {
	$sep_class .= ' stm-border_color_' . esc_attr( $sep_color );
}

$sep_styles = array();

if( $sep_color == 'custom' && !empty( $sep_color_custom ) ) {
	$sep_styles[] = 'border-color:' . esc_attr( $sep_color_custom );
}

$sep_style = smarty_element_style( $sep_styles );
?>
<?php
// STYLE 1 or STYLE 2
if( $view_style == 'style-1' || $view_style == 'style-2' ) : ?>
<div class="stm-icon-box<?php echo esc_attr( $icon_box_classes ); ?><?php echo esc_attr( $css_class ); ?>" <?php echo sanitize_text_field( $icon_box_inline_style ); ?>>
    <?php if( !empty( ${'icon_' . $icon_library} ) && $icon_position == 'top' || !empty( ${'icon_' . $icon_library} ) && $icon_position == 'left' ) : ?>
        <div class="stm-icon-box__ic-container">
            <span class="<?php echo esc_attr( ${'icon_' . $icon_library} ) ?><?php echo esc_attr( $icon_classes ) ?>" <?php echo sanitize_text_field( $icon_inline_style ); ?>></span>
        </div>
	  <?php elseif( $img_id != '' && $icon_position == 'top' || $img_id != '' && $icon_position == 'left' ) : ?>
	    <div class="stm-icon-box__ic-container stm-icon-box__ic-container_img" <?php echo sanitize_text_field( $icon_inline_style ); ?>>
		    <?php echo wp_get_attachment_image( $img_id, 'full' ); ?>
	    </div>
    <?php endif; ?>

		<div class="stm-icon-box__content">
	    <?php if( !empty( $title_small ) ) : ?>
	        <div class="stm-icon-box__title-small"><?php echo esc_html( $title_small ); ?></div>
	    <?php endif; ?>
	    <?php if( !empty( $title ) ) : ?>
	        <div class="stm-icon-box__title<?php echo esc_attr( $title_classes ); ?>" <?php echo sanitize_text_field( $title_inline_style ); ?>><?php echo esc_html( $title ); ?></div>
	    <?php endif; ?>
			<?php if( $separator_enable ) : ?>
		    <div class="stm-icon-box__sep">
		        <hr class="stm-icon-box__sep-line<?php echo esc_attr( $sep_class ); ?>" <?php echo sanitize_text_field( $sep_style ); ?>>
		    </div>
			<?php endif; ?>
	    <?php if( !empty( $descr ) ) : ?>
	        <div class="stm-icon-box__descr<?php echo esc_attr( $descr_classes ); ?>" <?php echo sanitize_text_field( $descr_inline_style ); ?>><?php echo html_entity_decode( $descr ); ?></div>
	    <?php endif; ?>
			<?php if( $button_text != '' && $button_link['url'] && $button_enable ) : ?>
				<a class="stm-btn stm-btn_outline stm-btn_blue stm-btn_sm stm-btn_icon-right" href="<?php echo esc_url( $button_link['url'] ); ?>" target="<?php echo esc_attr( $button_link['target'] ); ?>"><?php echo esc_html( $button_text ); ?><i class="stm-icon stm-icon-arrow-right"></i></a>
			<?php endif; ?>
		</div>
	<?php if( $step_enable && $step_number != '' ) : ?>
		<div class="stm-icon-box__step" <?php echo sanitize_text_field( $step_style ); ?>><?php echo esc_html( $step_number ); ?></div>
	<?php endif; ?>
</div>
<?php endif; ?>

<?php
// STYLE 3
if( $view_style == 'style-3' ) : ?>
	<div class="stm-icon-box<?php echo esc_attr( $icon_box_classes ); ?><?php echo esc_attr( $css_class ); ?>" <?php echo sanitize_text_field( $icon_box_inline_style ); ?>>
		<?php if( !empty( ${'icon_' . $icon_library} ) && $icon_position == 'top' || !empty( ${'icon_' . $icon_library} ) && $icon_position == 'left' ) : ?>
			<div class="stm-icon-box__ic-container">
				<span class="<?php echo esc_attr( ${'icon_' . $icon_library} ) ?><?php echo esc_attr( $icon_classes ) ?>" <?php echo sanitize_text_field( $icon_inline_style ); ?>></span>
			</div>
		<?php elseif( $img_id != '' && $icon_position == 'top' || $img_id != '' && $icon_position == 'left' ) : ?>
			<div class="stm-icon-box__ic-container stm-icon-box__ic-container_img" <?php echo sanitize_text_field( $icon_inline_style ); ?>>
				<?php echo wp_get_attachment_image( $img_id, 'full' ); ?>
			</div>
		<?php endif; ?>

		<div class="stm-icon-box__content">
			<?php if( empty ($title_link) ) : ?>
				<div class="stm-icon-box__title<?php echo esc_attr( $title_classes ); ?>" <?php echo sanitize_text_field( $title_inline_style ); ?>><?php echo wp_kses_post( $title_link ); ?></div>
            <?php endif; ?>
            <?php if( !empty ($title_link) ) : ?>
				<div class="stm-icon-box__title<?php echo esc_attr( $title_classes ); ?>" <?php echo sanitize_text_field( $title_inline_style ); ?>><?php echo esc_html( $title ); ?></div>
			<?php endif; ?>

			<?php if( !empty( $sub_title ) ) : ?>
				<div class="stm-icon-box__sub-title <?php echo esc_attr( $sub_title_class ); ?>" <?php echo sanitize_text_field( $sub_title_style ); ?>><?php echo esc_html( $sub_title ); ?></div>
			<?php endif; ?>
		</div>
	</div>
<?php endif; ?>

<?php
// STYLE 4
if( $view_style == 'style-4' ) : ?>
<?php $id = rand(0, 999); ?>
	<div class="stm-icon-box<?php echo esc_attr( $icon_box_classes ); ?><?php echo esc_attr( $css_class ); ?>" <?php echo sanitize_text_field( $icon_box_inline_style ); ?>>
		<?php if( $icon_position == 'top' || $icon_position == 'left' ) : ?>
			<?php if( $icon_type == 'font_icons' && !empty( ${'icon_' . $icon_library}) ) : ?>
				<div class="stm-icon-box__ic-container" <?php echo sanitize_text_field( $icon_inline_style ); ?>>
					<span class="<?php echo esc_attr( ${'icon_' . $icon_library} ); ?><?php echo esc_attr( $icon_classes ) ?>"></span>
				</div>
			<?php elseif( $icon_type == 'img' && $img_id ): ?>
				<div class="stm-icon-box__ic-container stm-icon-box__ic-container_img" <?php echo sanitize_text_field( $icon_inline_style ); ?>>
					<?php echo wp_get_attachment_image( $img_id, 'full' ); ?>
				</div>
			<?php elseif( $icon_type == 'svg' && $svg_id ): ?>
				<div class="stm-icon-box__ic-container stm-icon-box__ic-container_svg <?php echo esc_attr( $icon_classes ) ?>" <?php echo sanitize_text_field( $icon_inline_style ); ?>>
					<?php $svg_src = wp_get_attachment_image_src( $svg_id, 'full' ); ?>
					<object id="stm-icon-box-svg-<?php echo esc_attr( $id ); ?>" type="image/svg+xml" data="<?php echo esc_url( $svg_src[0] ); ?>"></object>
				</div>
			<?php endif; ?>
		<?php endif; ?>

		<div class="stm-icon-box__content">
            <?php if( $title_link != '' ) : ?>
                <div class="stm-icon-box__title<?php echo esc_attr( $title_classes ); ?>" <?php echo sanitize_text_field( $title_inline_style ); ?>><?php echo wp_kses_post( $title_link ); ?></div>
            <?php elseif( $title != '' ) : ?>
                <div class="stm-icon-box__title<?php echo esc_attr( $title_classes ); ?>" <?php echo sanitize_text_field( $title_inline_style ); ?>><?php echo esc_html( $title ); ?></div>
            <?php endif; ?>

			<?php if( !empty( $descr ) ) : ?>
				<div class="stm-icon-box__descr<?php echo esc_attr( $descr_classes ); ?>" <?php echo sanitize_text_field( $descr_inline_style ); ?>><?php echo html_entity_decode( $descr ); ?></div>
			<?php endif; ?>
			<?php if( !empty( $button_text ) && $button_link['url'] ) : ?>
				<a class="stm-btn stm-btn_outline stm-btn_blue stm-btn_sm stm-btn_icon-right" href="<?php echo esc_url( $button_link['url'] ); ?>" target="<?php echo esc_attr( $button_link['target'] ); ?>"><?php echo esc_html( $button_text ); ?><i class="stm-icon stm-icon-arrow-right"></i></a>
			<?php endif; ?>
		</div>
		<?php if( $step_enable && !empty( $step_number ) ) : ?>
			<div class="stm-icon-box__step" <?php echo sanitize_text_field( $step_style ); ?>><?php echo esc_html( $step_number ); ?></div>
		<?php endif; ?>
	</div>
<?php endif; ?>

<?php
// STYLE 5
if( $view_style == 'style-5' ) : ?>
<?php $id = rand(0, 999); ?>
    <div class="stm-icon-box<?php echo esc_attr( $icon_box_classes ); ?><?php echo esc_attr( $css_class ); ?>" <?php echo sanitize_text_field( $icon_box_inline_style ); ?>>
        <?php if( $img_single_id ) : ?>
            <div class="stm-icon-box__image">
                <?php echo wp_get_attachment_image( $img_single_id, 'full' ); ?>
            </div>
        <?php endif; ?>
        <div class="stm-icon-box__content">
            <?php if( $icon_position == 'top' || $icon_position == 'left' ) : ?>
                <?php if( $icon_type == 'font_icons' && !empty( ${'icon_' . $icon_library}) ) : ?>
                    <div class="stm-icon-box__ic-container" <?php echo sanitize_text_field( $icon_inline_style ); ?>>
                        <span class="<?php echo esc_attr( ${'icon_' . $icon_library} ); ?><?php echo esc_attr( $icon_classes ) ?>" <?php echo sanitize_text_field( $icon_inline_style ); ?>></span>
                    </div>
                <?php elseif( $icon_type == 'img' && $img_id ): ?>
                    <div class="stm-icon-box__ic-container stm-icon-box__ic-container_img" <?php echo sanitize_text_field( $icon_inline_style ); ?>>
                        <?php echo wp_get_attachment_image( $img_id, 'full' ); ?>
                    </div>
                <?php elseif( $icon_type == 'svg' && $svg_id ): ?>
                    <div class="stm-icon-box__ic-container stm-icon-box__ic-container_svg <?php echo esc_attr( $icon_classes ) ?>" <?php echo sanitize_text_field( $icon_inline_style ); ?>>
                        <?php $svg_src = wp_get_attachment_image_src( $svg_id, 'full' ); ?>
                        <object id="stm-icon-box-svg-<?php echo esc_attr( $id ); ?>" type="image/svg+xml" data="<?php echo esc_url( $svg_src[0] ); ?>"></object>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <?php if( !empty( $title ) ) : ?>
                <div class="stm-icon-box__title<?php echo esc_attr( $title_classes ); ?>" <?php echo sanitize_text_field( $title_inline_style ); ?>><?php echo esc_html( $title ); ?></div>
            <?php endif; ?>

            <?php if( !empty( $title_small ) ) : ?>
                <div class="stm-icon-box__title-small" <?php echo sanitize_text_field( $title_inline_style ); ?>><?php echo esc_html( $title_small ); ?></div>
            <?php endif; ?>

            <?php if( !empty( $descr ) ) : ?>
                <div class="stm-icon-box__descr<?php echo esc_attr( $descr_classes ); ?>" <?php echo sanitize_text_field( $descr_inline_style ); ?>><?php echo html_entity_decode( $descr ); ?></div>
            <?php endif; ?>
        </div>
        <?php if( $title_link != '' ) : ?>
            <div class="stm-icon-box__title_link<?php echo esc_attr( $title_classes ); ?>" <?php echo sanitize_text_field( $title_inline_style ); ?>><?php echo wp_kses_post( $title_link ); ?></div>
        <?php endif; ?>
    </div>
<?php endif; ?>

<?php if( $icon_type == 'svg' ) : ?>
	<?php
		if( ! wp_script_is( 'vivus' ) ) {
			wp_enqueue_script( 'vivus' );
		}
	?>
	<script>

		(function($) {
			"use strict";

			$(document).ready(function () {
				var iconID      = '<?php echo esc_js( $id ); ?>',
						svgAnimated = '<?php echo esc_js( $svg_animated ); ?>',
						svgWidth    = '<?php echo esc_js( $icon_size ); ?>',
						iconColor   = $("#stm-icon-box-svg-" + iconID).parent().css("color");

				if( svgAnimated ) {
					var svgPath;
					new Vivus('stm-icon-box-svg-' + iconID, {
						type: 'async',
						duration: 200,
						pathTimingFunction: Vivus.EASE_OUT,
						animTimingFunction: Vivus.EASE_OUT,
						onReady: function (svgInit) {
							if( svgWidth ) {
								svgInit.el.setAttribute('width', svgWidth);
							}

							svgPath = svgInit.el.getElementsByTagName('path');
							for( var i = 0; i < svgPath.length; i++ ) {
								svgPath[i].style.stroke = iconColor;
							}
						}
					});

					if( $("#site-skin-color").length ) {
						$(document).on("click", "#site-skin-color span", function() {
							setTimeout(function() {
								for( var i = 0; i < svgPath.length; i++ ) {
									svgPath[i].style.stroke = $("#stm-icon-box-svg-" + iconID).parent().css("color");
								}
							}, 500);
						});
					}
				}
			});
		})(jQuery);

	</script>
<?php endif; ?>
