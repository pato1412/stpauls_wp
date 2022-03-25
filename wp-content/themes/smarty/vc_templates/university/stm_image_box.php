<?php
/* Variables */
$title_position = '';
$title = '';
$title_link = '';
$description = '';
$img_id = '';
$img_size = '';
$img_position = '';
$sep_enable = '';
$sep_color = '';
$sep_color_custom = '';
$title_color = '';
$title_color_custom = '';
$title_font_size = '';
$title_line_height = '';
$title_margin_t = '';
$title_margin_b = '';
$description_color = '';
$description_color_custom = '';
$description_font_size = '';
$description_line_height = '';
$description_margin_b = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

/* Styles */
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

$box_classes = array();

if( !empty( $img_id ) && $img_id > 0 ) {
	$box_classes[] = 'stm-image-box_img_' . esc_attr( $img_position );
}

if( !empty( $title_position ) ) {
	$box_classes[] = 'stm-image-box_title_' . esc_attr( $title_position );
}

if( is_array( $box_classes ) && !empty( $box_classes ) ) {
	$box_class = implode( ' ', $box_classes );
}

/* === Image === */
if( !empty( $img_id ) && $img_id > 0 ) {

	if( empty( $img_size ) ) {
		$img_size = '160x160';
	}

	$img = wpb_getImageBySize(array(
		'attach_id' => $img_id,
		'thumb_size' => $img_size
	));

}

/*
 * === Title ===
 *
 * 1. Link
 * 2. Style
 * 3. Class
 *
 * */

// 1. Link
if( !empty( $title_link ) ) {
	$title_link = vc_build_link( $title_link );

	if( ! isset( $title_link['target'] ) ) {
		$title_link['target'] = '_self';
	}
}

// 2. Style
$title_styles = array(
	'font-size:' . esc_attr( $title_font_size ),
	'line-height:' . esc_attr( $title_line_height ),
	'margin-top:' . esc_attr( $title_margin_t ),
	'margin-bottom:' . esc_attr( $title_margin_b )
);

if( $title_color === 'custom' && !empty( $title_color_custom ) ) {
	$title_styles[] = 'color:' . esc_attr( $title_color_custom );
}

$title_style = smarty_element_style( $title_styles );

// 3. Class
$title_class = '';
if( $title_color != 'custom' ) {
	$title_class .= ' stm-font_color_' . esc_attr( $title_color );
}

if( !empty( $title_position ) ) {
	$title_class .= ' stm-image-box__title_' . esc_attr( $title_position );
}

/*
 * === Separator ===
 *
 * 1. Class
 * 2. Style
 *
 * */

if( $sep_enable ) {

// 1. Class
	$sep_classes = array();

	if( $sep_color != 'custom' ) {
		$sep_classes[] = 'stm-border_color_' . esc_attr( $sep_color );
	}

	if( is_array( $sep_classes ) && !empty( $sep_classes ) ) {
		$sep_class = implode( ' ', $sep_classes );
	}

// 2. Style
	$sep_styles = array(
		'border-color:' . esc_attr( $sep_color_custom )
	);

	$sep_style = smarty_element_style( $sep_styles );
}

/*
 * === Description ===
 *
 * 1. Style
 * 2. Class
 *
 * */

// 1. Style
$description_styles = array(
	'font-size:' . esc_attr( $description_font_size ),
	'line-height:' . esc_attr( $description_line_height ),
	'margin-bottom:' . esc_attr( $description_margin_b )
);

if( $description_color === 'custom' && !empty( $description_color_custom ) ) {
	$description_styles[] = 'color:' . esc_attr( $description_color_custom );
}

$description_style = smarty_element_style( $description_styles );

// 2. Class
$description_class = '';
if( $description_color != 'custom' ) {
	$description_class .= ' stm-font_color_' . esc_attr( $description_color );
}

?>
<div class="stm-image-box<?php echo esc_attr( $css_class ); ?> <?php echo esc_attr( $box_class ); ?>">

	<?php if( !empty( $title ) && $title_position == 'outside' ) : ?>
		<?php if( isset( $title_link['url'] ) ) : ?>
			<h4 class="stm-image-box__title<?php echo esc_attr( $title_class ); ?>" <?php echo sanitize_text_field( $title_style ); ?>><a href="<?php echo esc_url( $title_link['url'] ); ?>" target="<?php echo esc_attr( $title_link['target'] ); ?>"><?php echo esc_html( $title ); ?></a></h4>
		<?php else: ?>
			<h4 class="stm-image-box__title<?php echo esc_attr( $title_class ); ?>" <?php echo sanitize_text_field( $title_style ); ?><?php echo esc_html( $title ); ?></h4>
		<?php endif; ?>
	<?php endif; ?>
	<?php if( $sep_enable && $title_position == 'outside' ) : ?>
		<hr class="stm-image-box__sep stm-image-box__sep_outside" <?php echo sanitize_text_field( $sep_style ); ?>>
	<?php endif; ?>
	<div class="stm-image-box__content">
		<?php if( isset( $img['thumbnail'] ) && !empty( $img['thumbnail'] ) && $img_position != 'right' ) : ?>
			<div class="stm-image-box__image">
                <a href="<?php echo esc_url( $title_link['url'] ); ?>" target="<?php echo esc_attr( $title_link['target'] ); ?>">
                    <?php
                        echo wp_kses( $img['thumbnail'], array(
                            'img' => array(
                                'src' => array(),
                                'width' => array(),
                                'height' => array(),
                                'class' => array()
                            )
                        ));
                    ?>
                </a>
			</div>
		<?php endif; ?>
		<div class="stm-image-box__body">
			<?php if( !empty( $title ) && $title_position == 'inside' ) : ?>
				<?php if( isset( $title_link['url'] ) ) : ?>
					<h4 class="stm-image-box__title<?php echo esc_attr( $title_class ); ?>" <?php echo sanitize_text_field( $title_style ); ?>><a href="<?php echo esc_url( $title_link['url'] ); ?>" target="<?php echo esc_attr( $title_link['target'] ); ?>"><?php echo esc_html( $title ); ?></a></h4>
				<?php else: ?>
					<h4 class="stm-image-box__title<?php echo esc_attr( $title_class ); ?>" <?php echo sanitize_text_field( $title_style ); ?><?php echo esc_html( $title ); ?></h4>
				<?php endif; ?>
			<?php endif; ?>
			<?php if( $sep_enable && $title_position == 'inside' ) : ?>
				<hr class="stm-image-box__sep" <?php echo sanitize_text_field( $sep_style ); ?>>
			<?php endif; ?>
			<?php if( !empty( $content ) ) : ?>
				<div class="stm-image-box__description<?php echo esc_attr( $description_class ); ?>" <?php echo sanitize_text_field( $description_style ); ?>><?php echo wpb_js_remove_wpautop( $content, true ); ?></div>
			<?php endif; ?>
		</div>
	</div>
</div>
