<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
?>
<footer id="colophon" class="footer footer_type_vc<?php echo esc_attr( $css_class ); ?>">
	<div class="row">
		<div class="container">
			<div class="widget-area widget-area_type_footer">
				<div class="row">
                    <?php
                    $col = 12 / get_theme_mod( 'footer_sidebar_count', 4 );
                    for ( $count = 1; $count <= get_theme_mod( 'footer_sidebar_count' ); $count ++ ): ?>
                        <div class="col-lg-<?php echo esc_attr( $col ); ?> col-md-<?php echo esc_attr( $col ); ?> col-sm-6 col-xs-12">
                            <?php dynamic_sidebar( SMARTY_THEME_SLUG . '-footer-' . $count ); ?>
                        </div>
                    <?php endfor; ?>
				</div>
			</div>
			<?php
			$footer_copyright_default = __('Copyright &copy; Secondary School Theme by <a href="%s" target="_blank">Stylemix Themes</a>', 'smarty');
			if( $footer_copyright = get_theme_mod('footer_copyright', $footer_copyright_default) ) : ?>
				<!-- Copyright -->
				<div class="copyright"><?php echo wp_kses_post($footer_copyright); ?></div>
			<?php endif; ?>

		</div>
	</div>
</footer>