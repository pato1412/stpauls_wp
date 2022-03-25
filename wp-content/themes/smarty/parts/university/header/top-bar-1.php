<?php
	/* Top Bar - Style 1 */

	$top_bar_language = get_theme_mod( 'top_bar_language', true );
?>

<div class="top-bar top-bar_view-style_1">
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
                    <?php smarty_topbar_lang_flag(); ?>
                </div>
            <?php endif; ?>

            <?php
            /* --- Navigation --- */
            if( get_theme_mod( 'top_bar_nav', true ) ) {
                wp_nav_menu( array(
                    'theme_location' => 'stm-topbar',
                    'menu_class' => 'top-bar__nav-menu stm-nav__menu',
                    'menu_id' => 'topbar-nav-menu',
                    'container_class' => 'top-bar__nav stm-nav',
                    'depth' => 1,
                    'fallback_cb' => false
                ) );
            }
            ?>

            <?php
            /* --- Account action --- */
            $top_bar_account = get_theme_mod( 'top_bar_account', true );
            if( $top_bar_account && class_exists('WooCommerce') ) : ?>
                <?php $account_page_id = get_option('woocommerce_myaccount_page_id'); ?>
                <?php if( !empty( $account_page_id ) ) : ?>
                    <div class="top-bar__account stm-nav">
                        <ul class="stm-nav__menu">
                            <?php if ( is_user_logged_in() ) : ?>
                                <li><a class="top-bar__account-action top-bar__account-action_login" href="<?php echo esc_url( get_permalink( $account_page_id ) ); ?>" title="<?php esc_attr_e('My account', 'smarty'); ?>"><?php esc_html_e('My account', 'smarty'); ?></a></li>
                            <?php else: ?>
                                <li><a class="top-bar__account-action top-bar__account-action_logout" href="<?php echo esc_url( get_permalink( $account_page_id ) ); ?>" title="<?php esc_attr_e('Login', 'smarty'); ?>"><?php esc_html_e('Login', 'smarty'); ?></a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
		</div><!-- / top-bar__content -->
	</div><!-- / container -->
</div><!-- / top-bar -->