<?php
/* --- Page ID --- */
$page_id = get_the_ID();

if( is_home() ) {
	$page_id = get_option('page_for_posts');
}

$footer_hide = get_post_meta( $page_id, 'stm_footer_hide', true );

$footer_id = get_post_meta( $page_id, 'stm_footer_id', true );

$footer_data = '';

if( !empty( $footer_id ) ) {
	$footer_data = get_post( $footer_id );
}
?>

<?php if( !empty( $footer_data ) && ! is_search() ) : ?>

	<footer class="stm-vc-footer">
		<div class="container">
            <style type="text/css" scoped>
                <?php echo get_post_meta( $footer_data->ID, '_wpb_shortcodes_custom_css', true ); ?>
            </style>
            <?php echo apply_filters( 'the_content', $footer_data->post_content ); ?>`
		</div>
	</footer>

<?php else : ?>

	<?php
	/* --- Class --- */
	$footer_class = '';

	if( !empty( $footer_style ) ) {
		$footer_class .= ' footer_style_' . $footer_style;
	}

	/* --- Style --- */
	$footer_bgcolor = get_post_meta( $page_id, 'stm_footer_bgcolor', true );

	$footer_css_styles = array();
	$footer_css_style = '';

	if( !empty( $footer_bgcolor ) ) {
		$footer_css_styles[] = 'background:' . esc_attr( $footer_bgcolor );
	}

	if( !empty( $footer_css_styles ) ) {
		$footer_css_style = 'style="' . implode( ';', $footer_css_styles ) . '"';
	}

	/* --- Widget --- */
	$col = 12 / get_theme_mod( 'footer_sidebar_count', 4 );
	$footer_widget = false;

	for ( $count = 1; $count <= get_theme_mod( 'footer_sidebar_count', 4 ); $count ++ ) {
		if( is_active_sidebar( SMARTY_THEME_SLUG . '-footer-' . $count ) && ! $footer_widget ) {
			$footer_widget = true;
		}
	}

	if( ! $footer_widget ) {
		$footer_class .= ' footer_compact';
	}
	?>

	<footer id="colophon" class="footer footer_type_default<?php echo esc_attr( $footer_class ); ?>">
		<div class="container">

			<?php
				/* --- Widgets --- */
				if( $footer_widget ) : ?>
					<div class="widget-area widget-area_type_footer">
						<div class="row">
							<?php for ( $count = 1; $count <= get_theme_mod( 'footer_sidebar_count', 4 ); $count ++ ): ?>
								<div class="col-lg-<?php echo esc_attr( $col ); ?> col-md-<?php echo esc_attr( $col ); ?> col-sm-6 col-xs-12">
									<?php dynamic_sidebar( SMARTY_THEME_SLUG . '-footer-' . $count ); ?>
								</div>
							<?php endfor; ?>
						</div>
					</div>
			<?php endif; ?>

			<?php $footer_copyright_default = sprintf( __('Copyright &copy; Secondary School Theme by <a href="%s" target="_blank">Stylemix Themes</a>', 'smarty'), 'http://stylemixthemes.com/' ); ?>
			<?php
				/* --- Copyright --- */
				if( $footer_copyright = get_theme_mod('footer_copyright', $footer_copyright_default) ) : ?>
					<div class="copyright"><?php echo wp_kses_post( $footer_copyright ); ?></div>
			<?php endif; ?>

		</div>
	</footer><!-- /.footer -->

<?php endif; ?>

</div><!-- /Wrapper -->

<?php
	/* --- Frontend Customizer --- */
	if( get_theme_mod( 'frontend_customizer_show', false ) ) {
		get_template_part( 'parts/frontend', 'customizer' );
	}
?>

<?php wp_footer(); ?>
</body>
</html>