<?php
    get_header();

    while ( have_posts() ) : the_post();

    smarty_get_layout_file('/parts', '/events/event-page-title');
    smarty_get_layout_file('/parts', '/page-breadcrumbs');

    $event_sidebar_pos = get_theme_mod( 'event_sidebar_pos', 'right' );
    $event_sidebar_id = get_theme_mod( 'event_sidebar', 'wp' );
    $content_layout = smarty_content_layout( $event_sidebar_pos );
    $event_sidebar = false;

    if( !empty( $event_sidebar_id ) && $event_sidebar_id != 'wp' ) {
        $event_sidebar_data = get_post( $event_sidebar_id );

        if( $event_sidebar_data ) {
            $event_sidebar = 'vc';
        }
    } elseif( $event_sidebar_id == 'wp' && is_active_sidebar( 'event-sidebar' ) ) {
        $event_sidebar = 'wp';
    }
    ?>
    <div class="content">
        <div class="container">
            <?php if( $event_sidebar ) echo wp_kses_post( $content_layout[ "main_before" ] ); ?>
            <main class="main">
                <?php
                smarty_get_layout_file('/parts', '/events/content-event');
                smarty_get_layout_file('/parts', '/events/event-join-form');
                ?>
            </main><!-- /Main -->
            <?php if( $event_sidebar ) echo wp_kses_post( $content_layout[ "main_after" ] ); ?>
            <?php if( $event_sidebar && $content_layout[ 'sidebar' ] ) : ?>
                <?php echo wp_kses_post( $content_layout[ "sidebar_before" ] ); ?>
                <?php if( $event_sidebar == 'wp' ) : ?>
                    <?php get_sidebar( 'event' ); ?>
                <?php elseif( $event_sidebar == 'vc' ) : ?>
                    <div class="stm-vc-sidebar">
                        <style type="text/css" scoped>
                            <?php echo get_post_meta( $event_sidebar_data->ID, '_wpb_shortcodes_custom_css', true ); ?>
                        </style>
                        <?php echo apply_filters( 'the_content', $event_sidebar_data->post_content ); ?>
                    </div>
                <?php endif; ?>
                <?php echo wp_kses_post( $content_layout[ "sidebar_after" ] ); ?>
            <?php endif; ?>
        </div><!-- /Container -->
    </div><!-- /Content -->
<?php
    endwhile;

    get_footer();
?>
