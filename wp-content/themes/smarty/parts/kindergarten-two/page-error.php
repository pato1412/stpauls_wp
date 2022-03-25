<?php
get_header();

$page_404_bg_img = get_theme_mod( 'page_404_bg_img' );
$page_404_styles = array();

if( !empty( $page_404_bg_img ) ) {
    $page_404_styles[] = 'background-image:' . 'url(' . esc_url( $page_404_bg_img ) . ')';
}

$page_404_style = smarty_element_style( $page_404_styles );
?>

<div class="content stm-border_color_pink" <?php echo sanitize_text_field( $page_404_style ); ?>>
    <div class="container">
        <main class="main">
            <section class="error-404 not-found">
                <!-- Logo -->
                <?php if( $logo = get_theme_mod( 'logo' ) ) : ?>
                    <div class="logo_box">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo"
                           title="<?php echo bloginfo( 'name' ); ?>"><img src="<?php echo esc_url( $logo ); ?>"
                                                                          alt="<?php echo esc_attr__( 'Logo', 'smarty' ); ?>"></a>
                    </div>
                <?php else: ?>
                    <div class="logo_box">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo logo_type_text"
                           title="<?php echo bloginfo( 'name' ); ?>">
                            <span class="logo__inner">
                                <span class="logo__title"><?php echo bloginfo( 'name' ); ?></span><br>
                                <span class="logo__description"><?php echo bloginfo( 'description' ); ?></span>
                            </span>
                        </a>
                    </div>
                <?php endif; ?>
                <h1><?php esc_html_e( 'Error 404: Page not found', 'smarty' ); ?></h1>
                <p><?php esc_html_e( "We're sorry, but the page you requested can't be found.", 'smarty' ); ?></p>
                <p><a href="<?php echo esc_url( home_url( '/' ) ); ?>"
                      class="stm-btn stm-btn_flat stm-btn_orange stm-btn_md stm-btn_icon-right"><?php esc_html_e( 'Homepage', 'smarty' ); ?></a>
                </p>
            </section><!-- /error-404 -->
        </main><!-- /main -->
    </div>
    <?php get_footer(); ?>
</div><!-- /content -->