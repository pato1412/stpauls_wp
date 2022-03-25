<?php
$header_view_style = get_theme_mod( 'header_view_style', 1 );
$top_bar_language = get_theme_mod( 'top_bar_language', true );
$sticky_header = get_theme_mod( 'sticky_header', false );

/* --- DEMO ---*/
if( isset( $_REQUEST[ 'header_style' ] ) ) {
    $header_view_style = intval( $_REQUEST[ 'header_style' ] );
}

$top_bar_show = get_theme_mod( 'top_bar_show', true );

$header_holder_class = 'header-holder';
if( !empty( $header_view_style ) ) {
    $header_holder_class .= ' header-holder_view-style_' . $header_view_style;
}

$header_class = 'header';
if( !empty( $header_view_style ) ) {
    $header_class .= ' header_view-style_' . $header_view_style;
}
?>

<div class="<?php echo esc_attr( $header_holder_class ); ?>">
    <?php
    /* --- Top Bar ---*/
    if( $top_bar_show ) {
        smarty_get_layout_file( '/parts', '/header/top-bar-' . $header_view_style );
    }
    ?>

    <header id="masthead" class="<?php echo esc_attr( $header_class ); ?>">
        <div class="container">
            <div class="header__content">
                <?php
                /* -- Navigation Menu --- */
                wp_nav_menu( array(
                    'theme_location' => 'stm-primary',
                    'menu_class' => 'stm-nav__menu stm-nav__menu_type_header',
                    'menu_id' => 'header-nav-menu',
                    'container_class' => 'stm-nav stm-nav_type_header',
                    'depth' => 3,
                    'fallback_cb' => false
                ) );
                ?>

                <!-- Logo -->
                <?php if( $logo = get_theme_mod( 'logo' ) ) : ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo"
                       title="<?php echo bloginfo( 'name' ); ?>"><img src="<?php echo esc_url( $logo ); ?>"
                                                                      alt="<?php echo esc_attr__( 'Logo', 'smarty' ); ?>"></a>
                <?php else: ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo logo_type_text"
                       title="<?php echo bloginfo( 'name' ); ?>">
                        <span class="logo__inner">
                            <span class="logo__title"><?php echo bloginfo( 'name' ); ?></span><br>
                            <span class="logo__description"><?php echo bloginfo( 'description' ); ?></span>
                        </span>
                    </a>
                <?php endif; ?>
            </div><!-- /header__content -->
        </div><!-- /container -->
    </header><!-- /header -->

    <!-- Mobile - Top Bar -->
    <div class="top-bar-mobile">
        <?php
        /* --- Search --- */
        if( get_theme_mod( 'top_bar_search', true ) ) : ?>
            <div class="top-bar-mobile__search">
                <?php echo get_search_form(); ?>
            </div>
        <?php endif; ?>

        <?php
        /* --- WPML --- */
        if( defined( 'ICL_SITEPRESS_VERSION' ) && $top_bar_language || (bool)get_option( '_wpml_inactive' ) === true && $top_bar_language ) : ?>
            <div class="top-bar-mobile__language"><?php do_action( 'wpml_add_language_selector' ); ?></div>
        <?php endif; ?>
    </div><!-- /top-bar-mobile -->

    <!-- Mobile - Header -->
    <div class="header-mobile">
        <div class="header-mobile__logo">
            <?php if( $logo = get_theme_mod( 'logo' ) ) : ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo"
                   title="<?php echo bloginfo( 'name' ); ?>"><img src="<?php echo esc_url( $logo ); ?>"
                                                                  alt="<?php echo esc_attr__( 'Logo', 'smarty' ); ?>"></a>
            <?php else: ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo logo_type_text"
                   title="<?php echo bloginfo( 'name' ); ?>">
                    <span class="logo__inner">
                        <span class="logo__title"><?php echo bloginfo( 'name' ); ?></span><br>
                        <span class="logo__description"><?php echo bloginfo( 'description' ); ?></span>
                    </span>
                </a>
            <?php endif; ?>
            <div class="header-mobile__nav-control">
                <span class="header-mobile__control-line"></span>
            </div>
        </div><!-- /header-mobile__logo -->

        <?php
        /* --- Navigation Menu --- */
        wp_nav_menu( array(
            'theme_location' => 'stm-primary',
            'menu_class' => 'stm-nav__menu stm-nav__menu_type_mobile-header',
            'menu_id' => 'header-mobile-nav-menu',
            'container_class' => 'stm-nav stm-nav_type_mobile-header',
            'depth' => 3,
            'fallback_cb' => false
        ) );
        ?>
    </div><!-- /header-mobile -->
</div><!-- /.header-holder -->

<?php if( $sticky_header === true ) : ?>
    <script>
        (function ($) {
            "use strict";

            $(document).ready(function () {
                $("#masthead").affix({
                    offset: {top: $(".header-holder").outerHeight(true)}
                });
            });

        })(jQuery);
    </script>
<?php endif; ?>