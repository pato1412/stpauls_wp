<?php
/* === VARIABLES === */
$btn_link = '';
$btn_link_text = '';
$btn_style = '';
$btn_color = '';
$btn_color_custom = '';
$btn_size = '';
$btn_icon_enable = '';
$btn_position = '';
$btn_disabled = '';
$btn_alignment = '';
$btn_margin_t = '';
$btn_margin_r = '';
$btn_margin_b = '';
$btn_margin_l = '';
$btn_icon_size = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

/* === BUTTON ===
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
$btn_container_styles = array(
	'margin-left:' . esc_attr( $btn_margin_l ),
	'margin-right:' . esc_attr( $btn_margin_r ),
	'margin-top:' . esc_attr( $btn_margin_t ),
	'margin-bottom:' . esc_attr( $btn_margin_b )
);
$btn_container_style = smarty_element_style( $btn_container_styles );

// 1.1. Container - Class
$btn_container_class = '';
if( !empty( $btn_alignment ) ) {
	$btn_container_class .= ' stm-btn-container_' . esc_attr( $btn_alignment );
}

// 2. Class
$btn_class = 'stm-btn';

if( !empty( $btn_style ) ) {
	$btn_class .= ' stm-btn_' . esc_attr( $btn_style );
}

if( !empty( $btn_color ) ) {
	$btn_class .= ' stm-btn_' . esc_attr( $btn_color );
}

if( !empty( $btn_size ) ) {
	$btn_class .= ' stm-btn_' . esc_attr( $btn_size );
}

if( $btn_icon_enable && !empty( $btn_icon_position ) ) {
	$btn_class .= ' stm-btn_icon-' . esc_attr( $btn_icon_position );
}

if( $btn_disabled ) {
	$btn_class .= ' stm-btn_disabled';
}

// 3. Link
$btn_link = vc_build_link( $btn_link );

if( $btn_link['url'] ) {
	if( empty( $btn_link['target'] ) ) {
		$btn_link['target'] = '_self';
	}
}

// 4. Icon
if( !empty( ${'btn_icon_'. $btn_icon_library} ) ) {
	$btn_icon_class = ${'btn_icon_'. $btn_icon_library};
} else {
	$btn_icon_class = 'stm-icon stm-icon-arrow-right';
}

// 4.1. Icon - Style
$btn_icon_styles = array(
	'font-size:' . esc_attr( $btn_icon_size ),
	'top:' . esc_attr( $btn_icon_vspace ),
);

if( $btn_icon_position == 'left' ) {
	$btn_icon_styles[] = 'margin-right:' . esc_attr( $btn_icon_hspace );
}

if( $btn_icon_position == 'right' ) {
	$btn_icon_styles[] = 'margin-left:' . esc_attr( $btn_icon_hspace );
}

$btn_icon_style = smarty_element_style( $btn_icon_styles );

$btn_icon = '<i class="'. esc_attr( $btn_icon_class ) .'" '. $btn_icon_style .'></i>';

// 5. Custom
$btn_attrs = array();
$btn_attr = '';

if( $btn_color == 'custom' ) {
	if( !empty( $btn_color_custom_bg ) ) {
		$btn_attrs[] = 'data-bg="'. esc_attr( $btn_color_custom_bg ) .'"';
	}

	if( !empty( $btn_color_custom_hover_bg ) ) {
		$btn_attrs[] = 'data-bg-hover="'. esc_attr( $btn_color_custom_hover_bg ) .'"';
	}

	if( !empty( $btn_color_custom_active_bg ) ) {
		$btn_attrs[] = 'data-bg-active="'. esc_attr( $btn_color_custom_active_bg ) .'"';
	}

	if( !empty( $btn_color_custom_border ) ) {
		$btn_attrs[] = 'data-border="'. esc_attr( $btn_color_custom_border ) .'"';
	}

	if( !empty( $btn_color_custom_hover_border ) ) {
		$btn_attrs[] = 'data-border-hover="'. esc_attr( $btn_color_custom_hover_border ) .'"';
	}

	if( !empty( $btn_color_custom_border_active ) ) {
		$btn_attrs[] = 'data-border-active="'. esc_attr( $btn_color_custom_border_active ) .'"';
	}

	if( !empty( $btn_color_custom_text ) ) {
		$btn_attrs[] = 'data-text="'. esc_attr( $btn_color_custom_text ) .'"';
	}

	if( !empty( $btn_color_custom_hover_text ) ) {
		$btn_attrs[] = 'data-text-hover="'. esc_attr( $btn_color_custom_hover_text ) .'"';
	}

	if( !empty( $btn_color_custom_active_text ) ) {
		$btn_attrs[] = 'data-text-active="'. esc_attr( $btn_color_custom_active_text ) .'"';
	}

	if( !empty( $btn_icon_color_custom ) ) {
		$btn_attrs[] = 'data-icon="'. esc_attr( $btn_icon_color_custom ) .'"';
	}

	if( !empty( $btn_icon_color_custom_hover ) ) {
		$btn_attrs[] = 'data-icon-hover="'. esc_attr( $btn_icon_color_custom_hover ) .'"';
	}

	if( !empty( $btn_icon_color_custom_active ) ) {
		$btn_attrs[] = 'data-icon-active="'. esc_attr( $btn_icon_color_custom_active ) .'"';
	}
}

if( !empty( $btn_attrs ) ) {
	$btn_attr = implode( ' ', $btn_attrs );
}

// 6. Style
$btn_css_styles = array();

if( $btn_size == 'size-custom' ) {
	$btn_css_styles = array(
		'padding-left:' . esc_attr( $btn_custom_padd_l ),
		'padding-right:' . esc_attr( $btn_custom_padd_r ),
		'font-size:' . esc_attr( $btn_custom_text_size ),
		'line-height:' . esc_attr( $btn_custom_height )
	);

	if( $btn_custom_width == '100%' ) {
		$btn_css_styles[] = 'width:' . esc_attr( $btn_custom_width );
	} elseif( !empty( $btn_custom_width ) ) {
		$btn_css_styles[] = 'min-width:' . esc_attr( $btn_custom_width );
	}
}

$btn_css_style = smarty_element_style( $btn_css_styles );

?>

<?php if( !empty( $btn_link_text ) && isset( $btn_link['url'] ) && !empty( $btn_link['url'] ) ) : ?>
	<div class="stm-btn-container<?php echo esc_attr( $btn_container_class ); ?>" <?php echo sanitize_text_field( $btn_container_style ); ?>>
		<?php if( $btn_icon_enable && $btn_icon_position === 'left' ) : ?>
			<a href="<?php echo esc_url( $btn_link['url'] ); ?>" target="<?php echo esc_attr( $btn_link['target'] ); ?>" class="<?php echo esc_attr( $btn_class ); ?>" <?php echo sanitize_text_field( $btn_attr ); ?> <?php echo sanitize_text_field( $btn_css_style ); ?>><?php echo wp_kses_post( $btn_icon ); ?><?php echo esc_html( $btn_link_text ); ?></a>
		<?php elseif( $btn_icon_enable ): ?>
			<a href="<?php echo esc_url( $btn_link['url'] ); ?>" target="<?php echo esc_attr( $btn_link['target'] ); ?>" class="<?php echo esc_attr( $btn_class ); ?>" <?php echo sanitize_text_field( $btn_attr ); ?> <?php echo sanitize_text_field( $btn_css_style ); ?>><?php echo esc_html( $btn_link_text ); ?><?php echo wp_kses_post( $btn_icon ); ?></a>
		<?php else: ?>
			<a href="<?php echo esc_url( $btn_link['url'] ); ?>" target="<?php echo esc_attr( $btn_link['target'] ); ?>" class="<?php echo esc_attr( $btn_class ); ?>" <?php echo sanitize_text_field( $btn_attr ); ?> <?php echo sanitize_text_field( $btn_css_style ); ?>><?php echo esc_html( $btn_link_text ); ?></a>
		<?php endif; ?>
	</div>
<?php endif; ?>
