<?php
/* === VARIABLES === */
$link_link = '';
$link_link_text = '';
$link_color = '';
$link_color_custom = '';
$link_size = '';
$link_position = '';
$link_alignment = '';
$link_margin_t = '';
$link_margin_r = '';
$link_margin_b = '';
$link_margin_l = '';
$link_icon_size = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

/* === Link ===
 *
 * 1. Container - Style
 * 1.1. Container - Class
 * 2. Class
 * 3. Link
 * 4. Icon
 * 4.1. Icon - Style
 *
 *
 * */

// 1. Container - Style
$link_container_styles = array(
	'margin-left:' . esc_attr( $link_margin_l ),
	'margin-right:' . esc_attr( $link_margin_r ),
	'margin-top:' . esc_attr( $link_margin_t ),
	'margin-bottom:' . esc_attr( $link_margin_b )
);
$link_container_style = smarty_element_style( $link_container_styles );

// 1.1. Container - Class
$link_container_class = '';
if( !empty( $link_alignment ) ) {
	$link_container_class .= ' stm-link-container_' . esc_attr( $link_alignment );
}

// 2. Class
$link_class = 'stm-link';

if( !empty( $link_color ) ) {
	$link_class .= ' stm-link_' . esc_attr( $link_color );
}

if( $link_icon_enable && !empty( $link_icon_position ) ) {
	$link_class .= ' stm-link_icon-' . esc_attr( $link_icon_position );
}

// 3. Link
$link = vc_build_link( $link );

if( $link['url'] ) {
	if( empty( $link['target'] ) ) {
		$link['target'] = '_self';
	}
}

// 4. Icon
if( !empty( ${'link_icon_'. $link_icon_library} ) ) {
	$link_icon_class = ${'link_icon_'. $link_icon_library};
} else {
	$link_icon_class = 'stm-icon stm-icon-arrow-right';
}

// 4.1. Icon - Style
$link_icon_styles = array(
	'font-size:' . esc_attr( $icon_size )
);

if( $link_icon_position == 'left' ) {
	$link_icon_styles[] = 'margin-right:' . esc_attr( $icon_hspace );
}

if( $link_icon_position == 'right' ) {
	$link_icon_styles[] = 'margin-left:' . esc_attr( $icon_hspace );
}

$link_icon_style = smarty_element_style( $link_icon_styles );

$link_icon = '<i class="'. esc_attr( $link_icon_class ) .'" '. $link_icon_style .'></i>';

// 6. Style
$link_css_styles = array(
	'font-size:' . esc_attr( $link_size )
);

if( !empty( $link_color_custom ) ) {
	$link_css_styles[] = 'color:' . esc_attr( $link_color_custom ) . ' !important';
}

$link_css_style = smarty_element_style( $link_css_styles );

?>

<?php if( !empty( $link_text ) && isset( $link['url'] ) && !empty( $link['url'] ) ) : ?>
	<div class="stm-link-container<?php echo esc_attr( $link_container_class ); ?>" <?php echo sanitize_text_field( $link_container_style ); ?>>
		<?php if( $link_icon_enable && $link_icon_position === 'left' ) : ?>
			<a href="<?php echo esc_url( $link['url'] ); ?>" class="<?php echo esc_attr( $link_class ); ?>" target="<?php echo esc_attr( $link['target'] ); ?>" <?php echo sanitize_text_field( $link_css_style ); ?>><?php echo wp_kses_post( $link_icon ); ?><?php echo esc_html( $link_text ); ?></a>
		<?php elseif( $link_icon_enable ): ?>
			<a href="<?php echo esc_url( $link['url'] ); ?>" class="<?php echo esc_attr( $link_class ); ?>" target="<?php echo esc_attr( $link['target'] ); ?>" <?php echo sanitize_text_field( $link_css_style ); ?>><?php echo esc_html( $link_text ); ?><?php echo wp_kses_post( $link_icon ); ?></a>
		<?php else: ?>
			<a href="<?php echo esc_url( $link['url'] ); ?>" class="<?php echo esc_attr( $link_class ); ?>" target="<?php echo esc_attr( $link['target'] ); ?>" <?php echo sanitize_text_field( $link_css_style ); ?>><?php echo esc_html( $link_text ); ?></a>
		<?php endif; ?>
	</div>
<?php endif; ?>
