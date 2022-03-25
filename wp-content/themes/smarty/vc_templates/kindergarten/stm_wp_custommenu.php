<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$nav_menu = $width = $position = $position_top = $position_left = $el_class = '';
$menu_items = '';
$create_custom_menu = '';
$hidden_sm = '';
$hidden_xs = '';
$output = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if( !empty( $nav_menu ) ) {

	if( !empty( $menu_id ) ) {
		$atts['nav_menu'] = $menu_id;
	}
}

$class_to_filter = '';

if( $hidden_sm ) {
	$class_to_filter .= ' hidden-sm';
}

if( $hidden_xs ) {
	$class_to_filter .= ' hidden-xs';
}

$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

$el_class = $this->getExtraClass( $el_class );

/* === MENU ITEMS === */
if ( isset( $atts['menu_items'] ) && strlen( $atts['menu_items'] ) > 0 ) {
	$menu_items = vc_param_group_parse_atts( $atts['menu_items'] );
	if ( ! is_array( $menu_items ) ) {
		$temp = explode( ',', $atts['menu_items'] );
		$paramValues = array();
		foreach ( $temp as $value ) {
			$data = explode( '|', $value );
			$newLine = array();
			$newLine['menu_item_url'] = isset( $data[0] ) ? $data[0] : 0;
			$newLine['menu_item_link_text'] = isset( $data[1] ) ? $data[1] : '';
			if ( isset( $data[1] ) && preg_match( '/^\d{1,3}\%$/', $data[1] ) ) {
				$newLine['menu_item_url'] = (float) str_replace( '%', '', $data[1] );
				$newLine['menu_item_link_text'] = isset( $data[2] ) ? $data[2] : '';
			}
			$paramValues[] = $newLine;
		}
		$atts['menu_items'] = urlencode( json_encode( $paramValues ) );
	}
}

/* === INLINE STYLE === */
$custom_menu_inline_styles = array();
$custom_menu_inline_style = '';

if( $width ) {
	$custom_menu_inline_styles[] = 'max-width:' . esc_attr( $width );
}

if( $position === 'absolute' ) {
	$custom_menu_inline_styles[] = 'position:' . esc_attr( $position );
}

if( $position_top ) {
	$custom_menu_inline_styles[] = 'top:' . esc_attr( $position_top );
}

if( $position_left ) {
	$custom_menu_inline_styles[] = 'left:' . esc_attr( $position_left );
}

if( $custom_menu_inline_styles ) {
	$custom_menu_inline_style = 'style="' . implode( ';', $custom_menu_inline_styles ) . '"';
}

if( $create_custom_menu == false ) {
if( !empty( $nav_menu ) ) {

	$output = '<div class="stm_wp_custom-menu wpb_content_element' . esc_attr( $el_class ) . '' . $css_class . '" '. $custom_menu_inline_style .'>';
	$type = 'WP_Nav_Menu_Widget';
	$args = array();
	global $wp_widget_factory;
	if ( is_object( $wp_widget_factory ) && isset( $wp_widget_factory->widgets, $wp_widget_factory->widgets[ $type ] ) ) {
		ob_start();
		the_widget( $type, $atts, $args );
		$output .= ob_get_clean();

		$output .= '</div>';

		echo smarty_sanitize_text_field($output);
	} else {
		echo smarty_sanitize_text_field($this->debugComment( 'Widget ' . esc_attr( $type ) . 'Not found in : vc_wp_custommenu' ));
	}

}
}
if( $create_custom_menu && is_array( $menu_items ) && !empty( $menu_items ) ) : ?>
	<?php $menu_id = uniqid('menu-'); ?>
	<div id="<?php echo esc_attr( $menu_id ); ?>" class="stm_wp_custom-menu wpb_content_element<?php echo esc_attr( $el_class ); ?><?php echo esc_attr( $css_class ); ?>" <?php echo sanitize_text_field( $custom_menu_inline_style ); ?>>
		<ul class="menu">
            <li class="menu-item"><h4 class="widget__title"><?php echo esc_html( $custommenu_title ); ?></h4></li>
			<?php foreach( $menu_items as $menu_item ) : ?>
				<?php if( isset( $menu_item['menu_item_url'] ) && isset( $menu_item['menu_item_link_text'] ) ): ?>
					<li class="menu-item">
						<?php
							$menu_item_url = vc_build_link( $menu_item['menu_item_url'] );

							if( ! $menu_item_url['target'] ) {
								$menu_item_url['target'] = '_self';
							}
						?>
						<?php if( !empty( $menu_item_url['url'] ) && !empty( $menu_item['menu_item_link_text'] ) ) : ?>
							<a href="<?php echo esc_url( $menu_item_url['url'] ); ?>"><?php echo esc_html( $menu_item['menu_item_link_text'] ); ?></a>
						<?php endif; ?>
					</li>
				<?php endif; ?>
			<?php endforeach; ?>
		</ul>
		<script>
			(function($) {
				"use strict";
				var menuId = '#<?php echo esc_js( $menu_id ); ?>';

				function animateScroll(el, offset, speed){
					if ( typeof( offset ) === 'undefined' ) offset = 0;
					if ( typeof( speed ) === 'undefined' ) speed = 500;

					$('html, body').animate({
						scrollTop: el.offset().top - offset
					}, speed);
				}

				$( menuId + ' a[href^="#"]').on('click', function(event) {

					var targetId = $(this).attr('href'),
							$target = $(targetId),
							isTab = $(".vc_tta-tab > a[href='"+ targetId +"']");

					if( $target.length ) {
						if( isTab.length ) {
							isTab.trigger("click");
							event.preventDefault();

							setTimeout( function() {
								animateScroll( $target, 150 );
							}, 200 );

						} else {
							event.preventDefault();
							animateScroll( $target );
						}
					}

				});
			})(jQuery);
		</script>
	</div>
<?php endif; ?>
