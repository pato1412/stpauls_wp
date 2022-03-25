<?php
	/* Top Bar - Style 1 */

	$top_bar_language = get_theme_mod( 'top_bar_language', true );
?>

<div class="top-bar top-bar_view-style_1">
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
            /* --- Account action --- */
            $top_bar_account = get_theme_mod( 'top_bar_account', true );
            if( $top_bar_account && class_exists('WooCommerce') ) : ?>
                <?php $account_page_id = get_option('woocommerce_myaccount_page_id'); ?>
                <?php if( !empty( $account_page_id ) ) : ?>
                    <div class="top-bar__account stm-nav">
                        <ul class="stm-nav__menu">
                            <?php if ( is_user_logged_in() ) : ?>
                                <li><a class="top-bar__account-action top-bar__account-action_login" href="<?php echo esc_url( get_permalink( $account_page_id ) ); ?>" title="<?php echo get_the_author() ?>"><?php echo get_the_author() ?></a></li>
                            <?php else: ?>
                                <li><a class="top-bar__account-action top-bar__account-action_logout" href="<?php echo esc_url( get_permalink( $account_page_id ) ); ?>" title="<?php esc_attr_e('Staff/Parents', 'smarty'); ?>"><?php esc_html_e('Staff/Parents', 'smarty'); ?></a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <?php
            /* --- Contact Details --- */
            if( get_theme_mod( 'top_bar_contacts', true ) ) : ?>
                <?php $contact_details = get_theme_mod( 'contact_details', false ); ?>
                <?php if( !empty( $contact_details ) ): ?>
                    <ul class="contact_details__box">
                        <?php foreach( $contact_details as $contact_key => $contact_val ): ?>
                            <?php if( $contact_key == 'phone' && !empty( $contact_val ) ) : ?>
                                <?php if( !empty( $contact_val ) ) : ?>
                                    <li class="top-bar__contact top-bar__contact_<?php echo esc_attr( $contact_key ); ?>"><a href="tel:<?php echo esc_attr( str_replace( ' ', '', $contact_val ) ); ?>"><?php echo wp_kses_data( $contact_val ); ?></a></li>
                                <?php endif; ?>
                            <?php elseif( $contact_key == 'email' && !empty( $contact_val ) ): ?>
                                <?php if( !empty( $contact_val ) ) : ?>
                                    <li class="top-bar__contact top-bar__contact_<?php echo esc_attr( $contact_key ); ?>"><a href="mailto:<?php echo esc_attr( str_replace( ' ', '', $contact_val ) ); ?>"><?php echo wp_kses_data( $contact_val ); ?></a></li>
                                <?php endif; ?>
                            <?php elseif( $contact_key == 'schedule' && !empty( $contact_val ) ): ?>
                                <?php if( !empty( $contact_val ) ) : ?>
                                    <li class="top-bar__contact top-bar__contact_<?php echo esc_attr( $contact_key ); ?>"><?php echo wp_kses_data( $contact_val ); ?></li>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            <?php endif; ?>
		</div><!-- / top-bar__content -->
	</div><!-- / container -->
</div><!-- / top-bar -->