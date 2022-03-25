<?php
/* === VARIABLES === */
$btn_link = '';
$btn_size = '';
$btn_color = '';
$btn_icon_enable = '';
$btn_width = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

/* === BUTTON ===
 *
 * 1. Link
 * 2. Icon
 * 2.1 Style
 * 3. Style
 * 4. Class
 * 5. Content
 *
*/

// 1. Link
$btn_link = vc_build_link( $btn_link );

if( $btn_link['url'] ) {
	if( empty( $btn_link['target'] ) ) {
		$btn_link['target'] = '_self';
	}
}

/* --- Icon --- */

// 2.1. Icon - Style
$icon_styles = array(
	'font-size:' . esc_attr( $btn_icon_size ),
	'top:' . esc_attr( $btn_icon_vspacing ),
	'color:' . esc_attr( $icon_color_custom )
);

$icon_style = smarty_element_style( $icon_styles );

// 2.2 Icon - Class

$icon_class = '';

if( !empty( $icon_color ) && $icon_color != 'custom' ) {
	$icon_class .= 'stm-font_color_' . esc_attr( $icon_color );
}

// 2. Icon
$btn_icon = '';

$btn_icon .= '<span class="stm-btn-download__icon" '. $icon_style .'>';

if( $icon_img_id ) {
	$btn_icon_img = wp_get_attachment_image( $icon_img_id, 'full' );
	$btn_icon .=  wp_kses($btn_icon_img, array(
			'img' => array(
				'src' => array(),
				'width' => array(),
				'height' => array()
			)
		));
} elseif( ${'btn_icon_'.$btn_icon_library} ) {
	$btn_icon .= '<i class="'. ${'btn_icon_'.$btn_icon_library}.'"></i>';
} else {
	$btn_icon .= '<i class="stm-icon stm-icon-arrow-right"></i>';
}

$btn_icon .= '</span>';


// 3. Style
$btn_styles = array(
	'text-align:' . esc_attr( $btn_text_align ),
);

$btn_style = smarty_element_style( $btn_styles );

// 4. Class
$btn_class = 'stm-btn-download';

if( !empty( $btn_download_color )) {
	$btn_class .= ' stm-btn-download_' . esc_attr( $btn_download_color );
}

if( $btn_icon_enable ) {
	$btn_class .= ' stm-btn-download_icon-' . esc_attr( $btn_icon_position );
}

if( !empty( $btn_width ) ) {
	$btn_class .= ' stm-btn-download_'. esc_attr( $btn_width );
}

/* --- Content --- */

// 5.1. Content - Style
$content_styles = array();

if( 'left' === $btn_icon_position ) {
	$content_styles[] = 'padding-right:' . esc_attr( $btn_icon_hspacing );
}

if( 'right' === $btn_icon_position ) {
	$content_styles[] = 'padding-left:' . esc_attr( $btn_icon_hspacing );
}

$content_style = smarty_element_style( $content_styles );

?>

<?php if( isset( $btn_link['url'] ) && !empty( $btn_link['url'] ) ) : ?>
	<div class="stm-btn-download-container<?php echo esc_attr( $css_class ); ?>">
		<a href="<?php echo esc_url( $btn_link['url'] ); ?>" class="<?php echo esc_attr( $btn_class ); ?>" <?php echo sanitize_text_field( $btn_style ); ?> target="<?php echo esc_attr( $btn_link['target'] ); ?>">
			<span class="stm-btn-download__body">
				<?php echo ( ( $btn_icon_enable && 'left' === $btn_icon_position ) ? $btn_icon : '' ); ?>
				<span class="stm-btn-download__content" <?php echo sanitize_text_field( $content_style ); ?>>
					<span class="stm-btn-download__text"><?php echo esc_html( $btn_link['title'] ); ?></span>
					<?php if( !empty( $btn_secondary_text ) ) : ?>
					<em class="stm-btn-download__subtext"><?php echo esc_html( $btn_secondary_text ); ?></em>
					<?php endif; ?>
				</span>
				<?php echo ( ( $btn_icon_enable && 'right' === $btn_icon_position ) ? $btn_icon : '' ); ?>
			</span>
		</a>
	</div>
<?php endif; ?>