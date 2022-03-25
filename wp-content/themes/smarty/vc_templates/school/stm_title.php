<?php
$title = $title_tag = $title_margin = $title_font = $title_color = $title_color_custom = $title_align = '';
$sub_title = $subtitle_css = $subtitle_color = $subtitle_color_custom = '';
$sep_enable = $sep_css = $sep_color = $sep_color_custom = $sep_position = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$stm_page_title = '';

if( $page_title_enable ) {
	$stm_page_title = get_the_title();
} elseif( !empty( $title ) ) {
	$stm_page_title = $title;
}

$title_inline_style = array();

$title_classes = array();
$title_class = '';

$title_inline_styles = array(
	'text-align:' . esc_attr( $title_align ),
	'font-size:' . esc_attr( $title_font_size ),
	'font-weight:' . esc_attr( $title_font_weight ),
	'font-style:' . esc_attr( $title_font_style ),
	'line-height:' . esc_attr( $title_line_height ),
	'text-indent:' . esc_attr( $title_text_indent ),
	'margin-top:' . esc_attr( $title_margin_t ),
	'margin-bottom:' . esc_attr( $title_margin_b )
);

if( !empty( $title_color ) && $title_color === 'custom' && !empty( $title_color_custom ) ) {
	$title_inline_styles[] = 'color:' . esc_attr( $title_color_custom );
}

if( !empty( $title_color ) && $title_color !== 'custom' ) {
	$title_classes[] = 'stm-font_color_' . esc_attr( $title_color );
}

$title_classes[] = 'stm-title_sep_' . $sep_position;

$title_inline_style = smarty_element_style( $title_inline_styles );


if( !empty( $title_classes ) ) {
	$title_class = implode( ' ', $title_classes );
}

if( $sep_enable ) {

	$sep_class = '';
	$separator_classes = '';

	$sep_inline_styles = array(
		'margin-bottom:' . $sep_margin_b
	);

	$sep_inline_style = smarty_element_style( $sep_inline_styles );

	$sep_line_inline_styles = array(
		'height:' . $sep_line_height,
		'width:' . $sep_line_width
	);

	if( !empty( $sep_color ) && $sep_color !== 'custom' ) {
		$sep_class .= ' stm-border-b_color_' . $sep_color;
	} elseif( !empty( $sep_color ) && $sep_color === 'custom' && !empty( $sep_color_custom ) ) {
		$sep_line_inline_styles[] = 'border-bottom-color:' . esc_attr( $sep_color_custom );
	}

	if( $title_align === 'right' && $sep_position == 'bottom' ) {
		$sep_line_inline_styles[] = 'float:right';
	} elseif( $title_align === 'center' ) {
		$sep_line_inline_styles[] = 'margin-left:auto';
		$sep_line_inline_styles[] = 'margin-right:auto';
	}

	$sep_line_inline_style = smarty_element_style( $sep_line_inline_styles );
}

if( $subtitle_enable && !empty( $content ) ) {
	$subtitle_class = '';

	$subtitle_inline_styles = array(
		'text-align:' . esc_attr( $title_align ),
		'font-size:' . esc_attr( $subtitle_font_size ),
		'font-weight:' . esc_attr( $subtitle_font_weight ),
		'font-style:' . esc_attr( $subtitle_font_style ),
		'line-height:' . esc_attr( $subtitle_line_height ),
		'margin-bottom:' . esc_attr( $subtitle_margin_b )

	);

	if( !empty( $subtitle_color ) && $subtitle_color === 'custom' ) {
		$subtitle_inline_styles[] = 'color:' . esc_attr( $subtitle_color_custom );
	} elseif( !empty( $subtitle_color ) && $subtitle_color !== 'custom' ) {
		$subtitle_class .= ' stm-font_color_' . $subtitle_color;
	}

	$subtitle_inline_style = smarty_element_style( $subtitle_inline_styles );

	if( $sep_enable ) {
		$separator_classes .= ' stm-separator_has_subtitle';
	}
}

?>
<?php if( !empty( $stm_page_title ) ) : ?>
<<?php echo esc_attr( $title_tag ); ?> class="stm-title <?php echo esc_attr( $title_class ); ?>" <?php echo sanitize_text_field( $title_inline_style ); ?>>
<?php if( $sep_enable && $sep_position == 'left' ) : ?>
	<div class="stm-separator__line<?php echo esc_attr( $sep_class ); ?>" <?php echo sanitize_text_field( $sep_line_inline_style ); ?>></div>
<?php endif; ?>

<?php echo esc_html( $stm_page_title ); ?>

<?php if( $sep_enable && $sep_position == 'right' ) : ?>
	<div class="stm-separator__line<?php echo esc_attr( $sep_class ); ?>" <?php echo sanitize_text_field( $sep_line_inline_style ); ?>></div>
<?php endif; ?>
</<?php echo esc_attr( $title_tag ) ?>>
<?php endif; ?>
<?php if( $sep_enable && $sep_position == 'bottom' ) : ?>
	<div class="stm-separator stm-clearfix stm-separator_type_title<?php echo esc_attr( $separator_classes ); ?>" <?php echo sanitize_text_field( $sep_inline_style ); ?>>
		<div class="stm-separator__line<?php echo esc_attr( $sep_class ); ?>" <?php echo sanitize_text_field( $sep_line_inline_style ); ?>></div>
	</div>
<?php endif; ?>
<?php if( $subtitle_enable && !empty( $content ) ) : ?>
	<div class="stm-subtitle<?php echo esc_attr( $subtitle_class ); ?>" <?php echo sanitize_text_field( $subtitle_inline_style ); ?>>
		<?php echo wpb_js_remove_wpautop( $content ); ?>
	</div>
<?php endif; ?>
