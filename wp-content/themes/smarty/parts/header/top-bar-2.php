<?php
	/* Top Bar - Style 2 */

	$top_bar_language = get_theme_mod( 'top_bar_language', true );
?>

<div class="top-bar top-bar_view-style_2">
	<div class="container">
		<div class="top-bar__content">

			<?php
			/* --- Search --- */
			if( get_theme_mod( 'top_bar_search', true ) ) : ?>
				<div class="top-bar__search">
					<?php echo get_search_form(); ?>
				</div>
			<?php endif; ?>

			<?php
			/* --- WPML --- */
			if( defined( 'ICL_SITEPRESS_VERSION' ) && $top_bar_language || (bool) get_option( '_wpml_inactive' ) === true && $top_bar_language ) : ?>
				<div class="top-bar__language">
					<?php smarty_topbar_lang(); ?>
				</div>
			<?php endif; ?>

			<?php
			/* --- Socials --- */
			if( get_theme_mod( 'top_bar_socials', true ) ) {
				$socials = smarty_get_top_bar_socials();

				if( !empty( $socials ) ) : ?>
					<ul class="top-bar__socials list list_inline list_social-networks_simple">
						<?php foreach( $socials as $social_key => $social_val ) : ?>
							<li class="list__item"><a class="list__item-link list__item-link_<?php echo esc_attr( $social_key ); ?>" href="<?php echo esc_url($social_val); ?>" target="_blank"><i class="fa fa-<?php echo esc_attr( $social_key ); ?>"></i></a></li>
						<?php endforeach; ?>
					</ul>
				<?php endif;
			}
			?>

		</div><!-- / top-bar__content -->
	</div><!-- / container -->
</div><!-- / top-bar -->