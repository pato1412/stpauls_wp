<?php
$title = '';
$icon_library = '';
$img_id = '';
$icon_size = '';
$icon_color = '';
$icon_color_picker = '';
$items = '';
$item_title = '';
$item_sub_title = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if ( isset( $atts['items'] ) && strlen( $atts['items'] ) > 0 ) {
	$items = vc_param_group_parse_atts( $atts['items'] );
	if ( ! is_array( $items ) ) {
		$temp = explode( ',', $atts['items'] );
		$paramValues = array();
		if( !empty( $temp ) ) {
			foreach ( $temp as $value ) {
				$data = explode( '|', $value );
				$newLine = array();
				$newLine['title'] = isset( $data[0] ) ? $data[0] : 0;
				$newLine['sub_title'] = isset( $data[1] ) ? $data[1] : '';
				if ( isset( $data[1] ) && preg_match( '/^\d{1,3}\%$/', $data[1] ) ) {
					$newLine['title'] = (float) str_replace( '%', '', $data[1] );
					$newLine['sub_title'] = isset( $data[2] ) ? $data[2] : '';
				}
				$paramValues[] = $newLine;
			}
		}
		$atts['items'] = urlencode( json_encode( $paramValues ) );
	}
}

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
// Icon
$icon = '';
if( !empty( $img_id ) ) {
	$icon = wp_get_attachment_image( $img_id );
} elseif( !empty( ${'icon_'.$icon_library} ) ) {
	$icon = '<i class="' . esc_attr(  ${'icon_'.$icon_library} ) . '"></i>';
}

// Icon - Style
$icon_styles = array(
	'color:' . esc_attr( $icon_color_picker ),
	'font-size:' . esc_attr( $icon_size )
);
$icon_style = smarty_element_style( $icon_styles );

// Icon - Class
$icon_classes = array();
if( $icon_color != 'picker' ) {
	$icon_classes[] = 'stm-font_color_' . esc_attr( $icon_color );
}
$icon_class = implode( ' ', $icon_classes );
?>
<div class="stm-icon-list<?php echo esc_attr( $css_class ); ?>">
	<?php if( !empty( $title ) ) : ?>
		<div class="stm-icon-list__heading">
		<?php if( !empty( $icon ) ) : ?>
			<div class="stm-icon-list__icon <?php echo esc_attr( $icon_class ); ?>" <?php echo sanitize_text_field( $icon_style ); ?>><?php echo wp_kses_post( $icon ); ?></div>
		<?php endif; ?>
		<h5 class="stm-icon-list__title"><?php echo esc_html( $title ); ?></h5>
		</div>
	<?php endif; ?>
	<?php if( !empty( $items ) ) : ?>
	<ul class="stm-icon-list__list">
		<?php foreach( $items as $item ) : ?>
			<li class="stm-icon-list__list-item">
				<div class="stm-icon-list__item-title"><?php echo esc_html( $item['item_title'] ); ?></div>
				<div class="stm-icon-list__item-sub-title"><?php echo esc_html( $item['item_sub_title'] ); ?></div>
			</li>
		<?php endforeach; ?>
	</ul>
	<?php endif; ?>
</div>
