<?php
	/* Top Bar - Style 4 */

	$top_bar_language = get_theme_mod( 'top_bar_language', true );
?>

<div class="top-bar top-bar_view-style_4">
	<div class="container">
		<div class="top-bar__content">

			<?php
				/* --- WPML --- */
				if( defined( 'ICL_SITEPRESS_VERSION' ) && $top_bar_language || (bool) get_option( '_wpml_inactive' ) === true && $top_bar_language ) : ?>
				<div class="top-bar__language">
					<?php smarty_topbar_lang(); ?>
				</div>
			<?php endif; ?>

			<?php
				/* --- Contact Details --- */
				if( get_theme_mod( 'top_bar_contacts', true ) ) : ?>
					<?php $contact_details = get_theme_mod( 'contact_details', false ); ?>
					<?php if( !empty( $contact_details ) ): ?>
						<?php foreach( $contact_details as $contact_key => $contact_val ): ?>
							<?php if( $contact_key == 'phone' && !empty( $contact_val ) ) : ?>
								<li class="top-bar__contact top-bar__contact_<?php echo esc_attr( $contact_key ); ?>"><a href="tel:<?php echo esc_attr( str_replace( ' ', '', $contact_val ) ); ?>"><?php echo wp_kses_data( $contact_val ); ?></a></li>
							<?php elseif( $contact_key == 'email' && !empty( $contact_val ) ): ?>
								<li class="top-bar__contact top-bar__contact_<?php echo esc_attr( $contact_key ); ?>"><a href="mailto:<?php echo esc_attr( str_replace( ' ', '', $contact_val ) ); ?>"><?php echo wp_kses_data( $contact_val ); ?></a></li>
							<?php endif; ?>
						<?php endforeach; ?>
					<?php endif; ?>
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

			<?php
				/* --- Search --- */
				if( get_theme_mod( 'top_bar_search', true ) ) : ?>
					<div class="top-bar__search">
						<?php echo get_search_form(); ?>
					</div>
			<?php endif; ?>

		</div><!-- / top-bar__content -->
	</div><!-- / container -->
</div><!-- / top-bar -->