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
                        <div class="search-bar__founded"><?php printf( wp_kses( __( "<strong>%d</strong> results founded", 'smarty' ), array( 'strong' => array() ) ), $results_founded ); ?></div>
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
                            <div class="entry-body <?php if( has_post_thumbnail() ) : ?>posts_has__thumb<?php endif; ?>">
                                <?php if( has_post_thumbnail() ) : ?>
                                    <div class="entry-thumbnail-container">
                                        <?php
                                        // Thumbnail size
                                        if( empty ( $thumb_size ) ) {
                                            $thumb_size = '350x220';
                                        }

                                        $thumb = wpb_getImageBySize( array(
                                            'attach_id' => get_post_thumbnail_id(),
                                            'thumb_size' => $thumb_size
                                        ) );
                                        ?>
                                        <div class="entry-thumbnail">
                                            <a href="<?php the_permalink() ?>"><?php echo wp_kses_post( $thumb[ 'thumbnail' ] ); ?></a>
                                            <div class="posts_post__date">
                                                <a href="<?php the_permalink(); ?>">
                                                    <span><?php echo get_the_date( 'j' ); ?></span>
                                                    <?php echo get_the_date( 'M' ); ?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="entry-details-container">
                                    <div class="entry-details">
                                        <?php if( get_the_title() ): ?>
                                            <h5 class="entry-title">
                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            </h5>
                                        <?php endif; ?>
                                        <?php if( get_the_excerpt() ) : ?>
                                            <div class="entry-summary">
                                                <?php the_excerpt(); ?>
                                            </div>
                                        <?php endif; ?>
                                        <div class="entry-meta">
                                            <div class="entry-meta-auhtor">
                                                <?php
                                                if( !is_multi_author() ) {
                                                    printf( '<span class="stm-icon stm-icon-pencil"></span> <a class="url fn n" href="%1$s">%2$s</a>',
                                                        esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                                                        get_the_author()
                                                    );
                                                }
                                                ?>
                                            </div>
                                            <?php if( get_the_category_list() ): ?>
                                                <div class="entry-meta-category">
                                                    <span class="stm-icon stm-icon-tag_flag"></span> <?php echo get_the_category_list( ', ' ); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
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