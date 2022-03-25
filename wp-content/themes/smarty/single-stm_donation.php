<?php
    get_header();

    while ( have_posts() ) : the_post();

    $donation_sidebar_pos = get_theme_mod( 'donation_sidebar_pos', 'right' );
    $donation_sidebar_id = get_theme_mod( 'donation_sidebar', 'wp' );
    $donation_sidebar = false;
    $content_layout = smarty_content_layout( $donation_sidebar_pos );

    if( !empty( $donation_sidebar_id ) && $donation_sidebar_id != 'wp' ) {
        $donation_sidebar_data = get_post( $donation_sidebar_id );

        if( $donation_sidebar_data ) {
            $donation_sidebar = 'vc';
        }
    } elseif( $donation_sidebar_id == 'wp' && is_active_sidebar( 'donation-sidebar' ) ) {
        $donation_sidebar = 'wp';
    }

    smarty_get_layout_file( '/parts', '/page-title' );

    smarty_get_layout_file( '/parts', '/page-breadcrumbs' );
?>


<div class="content">
    <div class="container">
        <?php if( $donation_sidebar ) echo wp_kses_post( $content_layout[ "main_before" ] ); ?>

        <main class="main">
            <?php
            smarty_get_layout_file('/parts', '/archives/donation/content-donation');

            if( comments_open() || get_comments_number() ) :
                comments_template();
            endif;
            ?>
        </main><!-- /Main -->

        <?php if( $donation_sidebar ) echo wp_kses_post( $content_layout[ "main_after" ] ); ?>

        <?php if( $donation_sidebar && $content_layout[ 'sidebar' ] ) : ?>
            <?php echo wp_kses_post( $content_layout[ "sidebar_before" ] ); ?>
            <?php if( $donation_sidebar == 'wp' ) : ?>
                <?php get_sidebar( 'donation' ); ?>
            <?php elseif( $donation_sidebar == 'vc' ) : ?>
                <div class="stm-vc-sidebar">
                    <style type="text/css" scoped>
                        <?php echo get_post_meta( $donation_sidebar_data->ID, '_wpb_shortcodes_custom_css', true ); ?>
                    </style>
                    <?php echo apply_filters( 'the_content', $donation_sidebar_data->post_content ); ?>
                </div>
            <?php endif; ?>
            <?php echo wp_kses_post( $content_layout[ "sidebar_after" ] ); ?>
        <?php endif; ?>
    </div><!-- /Container -->
</div><!-- /Content -->

<?php endwhile;

get_footer();

?>