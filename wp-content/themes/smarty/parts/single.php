<?php get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
    <?php
    $single_post_sidebar_pos = get_theme_mod( 'posts_single_sidebar', 'right' );
    $single_post_sidebar_id = get_theme_mod( 'single_post_sidebar', 'wp' );
    $content_layout = smarty_content_layout( $single_post_sidebar_pos );
    $post_sidebar = false;

    if( !empty( $single_post_sidebar_id ) && $single_post_sidebar_id != 'wp' ) {
        $post_sidebar_data = get_post( $single_post_sidebar_id );

        if( $post_sidebar_data ) {
            $post_sidebar = 'vc';
        }
    } elseif( $single_post_sidebar_id == 'wp' && is_active_sidebar( 'blog-sidebar' ) ) {
        $post_sidebar = 'wp';
    }

    smarty_get_layout_file('/parts', '/page-title');
    smarty_get_layout_file('/parts', '/page-breadcrumbs');

    ?>
    <div class="content">
        <div class="container">
            <?php if( $post_sidebar ) echo wp_kses_post( $content_layout[ "main_before" ] ); ?>
            <main class="main">
                <?php smarty_get_layout_file('/parts', '/content'); ?>
                <?php if( comments_open() || get_comments_number() ) : ?>
                    <?php comments_template(); ?>
                <?php endif; ?>
            </main><!-- /Main -->
            <?php if( $post_sidebar ) echo wp_kses_post( $content_layout[ "main_after" ] ); ?>
            <?php if( $post_sidebar && $content_layout[ 'sidebar' ] ) : ?>
                <?php echo wp_kses_post( $content_layout[ "sidebar_before" ] ); ?>
                <?php if( $post_sidebar == 'wp' ) : ?>
                    <?php get_sidebar(); ?>
                <?php elseif( $post_sidebar == 'vc' ) : ?>
                    <div class="stm-vc-sidebar">
                        <style type="text/css" scoped>
                            <?php echo get_post_meta( $post_sidebar_data->ID, '_wpb_shortcodes_custom_css', true ); ?>
                        </style>
                        <?php echo apply_filters( 'the_content', $post_sidebar_data->post_content ); ?>
                    </div>
                <?php endif; ?>
                <?php echo wp_kses_post( $content_layout[ "sidebar_after" ] ); ?>
            <?php endif; ?>
        </div><!-- /Container -->
    </div><!-- /Content -->
<?php endwhile; ?>
<?php get_footer(); ?>