<?php
    get_header();

    /* --- Page Title --- */
    smarty_get_layout_file('/parts', '/page-title');

    /* --- Sidebar --- */
    $posts_sidebar_pos = get_theme_mod( 'posts_sidebar', 'right' );
    $posts_sidebar_id = get_theme_mod( 'posts_sidebar_id', 'wp' );
    $posts_sidebar = false;
    $content_layout = smarty_content_layout( $posts_sidebar_pos );

    if( !empty( $posts_sidebar_id ) && $posts_sidebar_id != 'wp' ) {
        $posts_sidebar_data = get_post( $posts_sidebar_id );

        if( $posts_sidebar_data ) {
            $posts_sidebar = 'vc';
        }
    } elseif( $posts_sidebar_id == 'wp' && is_active_sidebar( 'blog-sidebar' ) ) {
        $posts_sidebar = 'wp';
    }
?>
<div class="content content_type_search">
    <div class="container">

        <?php if( $posts_sidebar && $content_layout[ 'sidebar' ] ) echo wp_kses_post( $content_layout[ 'main_before' ] ); ?>

        <main class="main">
            <div class="search-bar">
                <?php
                $wp_query = smarty_glob_wp_query();
                $search_q = get_search_query();
                if( !empty( $search_q ) ) {
                    $results_founded = $wp_query->found_posts;
                } else {
                    $results_founded = 0;
                }
                ?>
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="search-bar__founded"><?php printf( wp_kses( __( "<strong>%d results</strong> founded", 'smarty' ), array( 'strong' => array() ) ), $results_founded ); ?></div>
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <?php echo get_search_form(); ?>
                    </div>
                </div>
            </div>
            <div class="stm-posts stm-posts_list">
                <?php if( have_posts() && !empty( $search_q ) ) : ?>
                    <?php while ( have_posts() ) : the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class( 'post_view_list' ); ?>>
                            <div class="entry-body">
                                <?php if( has_post_thumbnail() ) : ?>
                                    <div class="entry-thumbnail-container">
                                        <div class="entry-thumbnail">
                                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'post-thumbnail' ); ?></a>
                                            <?php echo get_the_category_list(); ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="entry-details-container">
                                    <div class="entry-details">
                                        <?php if( get_the_title() ): ?>
                                            <?php
                                            $title = get_the_title();
                                            $keys = explode( ' ', get_search_query() );
                                            $title = preg_replace( '/(' . implode( '|', $keys ) . ')/iu', '<mark>\0</mark>', $title );
                                            ?>
                                            <h5 class="entry-title">
                                                <a href="<?php the_permalink(); ?>"><?php echo wp_kses( $title, array( 'mark' => array() ) ); ?></a>
                                            </h5>
                                        <?php endif; ?>
                                        <?php if( get_the_excerpt() ) : ?>
                                            <div class="entry-summary">
                                                <?php the_excerpt(); ?>
                                            </div>
                                        <?php endif; ?>
                                        <ul class="entry-meta">
                                            <li><i class="fa fa-clock-o"></i><a
                                                        href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?></a>
                                            </li>
                                            <li>
                                                <i class="fa fa-commenting-o"></i><?php comments_popup_link( '<span class="leave-reply">' . esc_html__( 'Leave a comment', 'smarty' ) . '</span>', esc_html__( '1 comment', 'smarty' ), esc_html__( '% comments', 'smarty' ) ); ?>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </article>
                    <?php endwhile; ?>
                <?php else : ?>
                    <?php smarty_get_layout_file('/parts', '/content-none'); ?>
                <?php endif; ?>
            </div>
            <?php
            if( !empty( $search_q ) ) {
                smarty_paging_nav( 'paging_view_posts-list' );
            }
            ?>
        </main><!-- /Main -->
        <?php if( $posts_sidebar && $content_layout[ 'sidebar' ] ) echo wp_kses_post( $content_layout[ 'main_after' ] ); ?>
        <?php if( $posts_sidebar && $content_layout[ 'sidebar' ] ) : ?>
            <?php echo wp_kses_post( $content_layout[ "sidebar_before" ] ); ?>
            <?php if( $posts_sidebar == 'wp' ) : ?>
                <?php get_sidebar(); ?>
            <?php elseif( $posts_sidebar == 'vc' ) : ?>
                <div class="stm-vc-sidebar">
                    <style type="text/css" scoped>
                        <?php echo get_post_meta( $posts_sidebar_data->ID, '_wpb_shortcodes_custom_css', true ); ?>
                    </style>
                    <?php echo apply_filters( 'the_content', $posts_sidebar_data->post_content ); ?>
                </div>
            <?php endif; ?>
            <?php echo wp_kses_post( $content_layout[ "sidebar_after" ] ); ?>
        <?php endif; ?>
    </div><!-- /Container -->
</div><!-- /Content -->
<?php get_footer(); ?>