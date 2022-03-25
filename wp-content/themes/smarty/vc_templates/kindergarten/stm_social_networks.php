<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );


$socials = smarty_get_footer_socials();

if( !empty( $socials ) ) : ?>
	<ul class="list list_inline list_social-networks<?php echo esc_attr( $css_class ); ?>">
		<?php foreach( $socials as $social_key => $social_val ) : ?>
			<li class="list__item"><a class="list__item-link list__item-link_<?php echo esc_attr( $social_key ); ?>" href="<?php echo esc_url($social_val); ?>" target="_blank"><i class="fa fa-<?php echo esc_attr( $social_key ); ?>"></i></a></li>
		<?php endforeach; ?>
	</ul>
<?php endif; ?>