<?php
$title = '';
$view = '';
$thumb_size = '';
$posts_count = '';
$masonry_box = '';
$pagination_enable = '';
$posts_category = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

// Owl Carousel
if( 'carousel' === $view ) {
    wp_enqueue_style( 'owl-carousel' );
    wp_enqueue_script( 'owl-carousel' );
}

// WP Query
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$q_args = array(
    'posts_per_page' => -1,
    'paged' => $paged
);

if( !empty( $posts_count ) ) {
    $q_args['posts_per_page'] = $posts_count;
}

if( !empty( $posts_category ) ) {
    $q_args['category_name'] = $posts_category;
}

$posts_q = new WP_Query( $q_args );

// View ID
$view_id = uniqid( 'stm-posts_' . $view . '-' );

wp_enqueue_script( 'isotope' );
wp_enqueue_script( 'imagesloaded' );
?>

<?php if( $posts_q->have_posts() ) : ?>
    <div class="stm-posts<?php echo esc_attr( $css_class ); ?>">
        <?php if( 'carousel' === $view ) : ?>
            <div class="stm-carousel stm-carousel_view_posts" id="<?php echo esc_attr( $view_id ); ?>">
                <?php while( $posts_q->have_posts() ) : $posts_q->the_post(); ?>
                    <div class="stm-post stm-post_view_grid">
                        <?php if( has_post_thumbnail() ) : ?>
                            <?php
                            // Thumbnail size
                            if( empty ($thumb_size) ) {
                                $thumb_size = '350x240';
                            }

                            $thumb = wpb_getImageBySize( array(
                                'attach_id'  => get_post_thumbnail_id(),
                                'thumb_size' => $thumb_size
                            ) );
                            ?>
                            <div class="stm-post__thumbnail">
                                <a href="<?php the_permalink() ?>"><?php echo wp_kses_post( $thumb['thumbnail'] ); ?></a>
                            </div>
                        <?php else : ?>
                            <div class="stm-post__thumbnail">
                                <a href="<?php the_permalink() ?>"><img src="<?php echo esc_url( SMARTY_TEMPLATE_URI . '/assets/img/tmp/placeholder.jpg' ); ?>" alt="<?php echo esc_attr__('Placeholder', 'smarty'); ?>" /></a>
                            </div>
                        <?php endif; ?>

                        <div class="stm-post__caption-container">
                            <div class="stm-post__caption">
                                <h5 class="stm-post__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                                <time datetime="<?php echo get_the_date( 'Y-m-d\TH:i' ); ?>" class="stm-post__date"><i class="fa fa-clock-o"></i><a href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?></a></time>
                            </div>
                        </div>
                    </div><!-- STM Post - Grid -->
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            </div><!-- STM Carousel -->
        <?php elseif( 'list' === $view ) : ?>
            <?php while( $posts_q->have_posts() ) : $posts_q->the_post(); ?>
                <?php
                $post_classes = get_post_class();
                if( is_sticky() ) {
                    $post_classes[] = 'sticky';
                }
                $post_classes[] = 'post_view_' . $view;
                ?>
                <div id="post-<?php the_ID(); ?>" class="<?php echo join(' ', $post_classes); ?> <?php if( has_post_thumbnail() ) : ?>posts_has__thumb<?php endif; ?>">
                    <div class="entry-body">
                        <?php if( has_post_thumbnail() ) : ?>
                            <div class="entry-thumbnail-container">
                                <?php
                                // Thumbnail size
                                if( empty ($thumb_size) ) {
                                    $thumb_size = '350x220';
                                }

                                $thumb = wpb_getImageBySize( array(
                                    'attach_id'  => get_post_thumbnail_id(),
                                    'thumb_size' => $thumb_size
                                ) );
                                ?>
                                <div class="entry-thumbnail">
                                    <a href="<?php the_permalink() ?>"><?php echo wp_kses_post( $thumb['thumbnail'] ); ?></a>
                                    <div class="posts_post__date">
                                        <a href="<?php the_permalink(); ?>">
                                            <span><?php echo get_the_date('j'); ?></span>
                                            <?php echo get_the_date('M'); ?>
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
                                        if ( ! is_multi_author() ) {
                                            printf( '<span class="stm-icon stm-icon-pencil"></span> <a class="url fn n" href="%1$s">%2$s</a>',
                                                esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                                                get_the_author()
                                            );
                                        }
                                        ?>
                                    </div>
                                    <div class="entry-meta-category">
                                        <span class="stm-icon stm-icon-tag_flag"></span> <?php echo get_the_category_list(', '); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            <div class="<?php echo esc_attr( $pagination_position ) ?>">
                <?php
                if( $pagination_enable ) {
                    //Pagination
                    smarty_paging_nav( 'paging_view_posts-list', $posts_q );
                }
                ?>
            </div>
            <?php wp_reset_postdata(); ?>

        <?php elseif( 'list-small' === $view ) : ?>
            <h4 class="widget__title"><?php echo wp_kses_post( $title ); ?></h4>
            <?php while( $posts_q->have_posts() ) : $posts_q->the_post(); ?>
            <?php
            $post_classes = get_post_class();
            if( is_sticky() ) {
                $post_classes[] = 'sticky';
            }
            $post_classes[] = 'post_view_' . $view;
            ?>
            <div id="post-<?php the_ID(); ?>" class="<?php echo join(' ', $post_classes); ?> <?php if( has_post_thumbnail() ) : ?>posts_has__thumb<?php endif; ?>">
                <div class="entry-body">
                    <?php if( has_post_thumbnail() ) : ?>
                        <div class="entry-thumbnail-container">
                            <?php
                            // Thumbnail size
                            if( empty ($thumb_size) ) {
                                $thumb_size = '154x154';
                            }

                            $thumb = wpb_getImageBySize( array(
                                'attach_id'  => get_post_thumbnail_id(),
                                'thumb_size' => $thumb_size
                            ) );
                            ?>
                            <div class="entry-thumbnail">
                                <a href="<?php the_permalink() ?>"><?php echo wp_kses_post( $thumb['thumbnail'] ); ?></a>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="entry-details-container">
                        <div class="entry-details">
                            <div class="posts_post__date">
                                <a href="<?php the_permalink(); ?>">
                                    <?php echo get_the_date('F d, Y'); ?>
                                </a>
                            </div>
                            <?php if( get_the_title() ): ?>
                                <h5 class="entry-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h5>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>

        <?php elseif( 'grid' === $view ) : ?>
            <div class="row <?php if( $masonry_box ) : ?>stm-posts__items-row_view_masonry_box<?php endif; ?>">
                <?php while( $posts_q->have_posts() ) : $posts_q->the_post(); ?>
                    <?php
                    $post_classes = get_post_class();
                    if( is_sticky() ) {
                        $post_classes[] = 'sticky';
                    }
                    $post_classes[] = 'post_view_' . $view;
                    ?>
                    <div class="col-sm-4 col-xs-12 stm-posts__items-row_view_masonry">
                        <div id="post-<?php the_ID(); ?>" class="<?php echo join(' ', $post_classes); ?> <?php if( has_post_thumbnail() ) : ?>posts_has__thumb<?php endif; ?>">
                            <div class="entry-body">
                                <?php if( has_post_thumbnail() ) : ?>
                                    <div class="entry-thumbnail-container">
                                        <?php
                                        // Thumbnail size
                                        if( empty ($thumb_size) ) {
                                            $thumb_size = '350x190';
                                        }

                                        $thumb = wpb_getImageBySize( array(
                                            'attach_id'  => get_post_thumbnail_id(),
                                            'thumb_size' => $thumb_size
                                        ) );
                                        ?>
                                        <div class="entry-thumbnail">
                                            <a href="<?php the_permalink() ?>"><?php echo wp_kses_post( $thumb['thumbnail'] ); ?></a>
                                            <div class="posts_post__date">
                                                <a href="<?php the_permalink(); ?>">
                                                    <span><?php echo get_the_date('j'); ?></span>
                                                    <?php echo get_the_date('M'); ?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="entry-details-container">
                                    <div class="entry-details">
                                        <div class="posts_post__date">
                                            <a href="<?php the_permalink(); ?>">
                                                <span><?php echo get_the_date('j'); ?></span>
                                                <?php echo get_the_date('M'); ?>
                                            </a>
                                        </div>
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
                                                if ( ! is_multi_author() ) {
                                                    printf( '<span class="stm-icon stm-icon-pencil"></span> <a class="url fn n" href="%1$s">%2$s</a>',
                                                        esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                                                        get_the_author()
                                                    );
                                                }
                                                ?>
                                            </div>
                                            <div class="entry-meta-category">
                                                <span class="stm-icon stm-icon-tag_flag"></span> <?php echo get_the_category_list(', '); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <div class="<?php echo esc_attr( $pagination_position ) ?>">
                <?php
                if( $pagination_enable ) {
                    //Pagination
                    smarty_paging_nav( 'paging_view_posts-list', $posts_q );
                }
                ?>
            </div>
            <?php wp_reset_postdata(); ?>

            <script>
                (function($) {
                    "use strict";
                    var $container;

                    $(document).ready(function() {
                        // ImagesLoaded
                        if( $(".stm-posts__items-row_view_masonry_box").length ) {
                            $container = $('.stm-posts__items-row_view_masonry_box').imagesLoaded( function() {
                                $container.isotope({
                                    itemSelector: '.stm-posts__items-row_view_masonry',
                                    layoutMode: 'masonry',
                                    masonry: {
                                        columnWidth: '.stm-posts__items-row_view_masonry'
                                    }
                                });
                            });
                        }

                    });

                })(jQuery);
            </script>
        <?php endif; ?>
    </div><!-- STM Posts -->

    <?php if( 'carousel' === $view ) : ?>
        <script>
            (function($) {
                "use strict";

                $(document).ready(function() {
                    var carouselId = '<?php echo esc_js( $view_id ); ?>';
                    var $carousel = $('#'+carouselId);

                    $('#'+carouselId).owlCarousel({
                        loop   : false,
                        margin : 30,
                        nav    : false,
                        lazyLoad:true,
                        responsive:{
                            0 : {
                                items : 1
                            },
                            640 : {
                                items : 2
                            },
                            992 : {
                                items : 3
                            }
                        }
                    });

                    $('.vc_tta-tab').click(function(){
                        setTimeout(function(){
                            $carousel.trigger('destroy.owl.carousel');
                            $carousel.html($carousel.find('.owl-stage-outer').html()).removeClass('owl-loaded');

                            $('#'+carouselId).owlCarousel({
                                loop   : false,
                                margin : 30,
                                nav    : false,
                                lazyLoad:true,
                                responsive:{
                                    0 : {
                                        items : 1
                                    },
                                    640 : {
                                        items : 2
                                    },
                                    992 : {
                                        items : 3
                                    }
                                }
                            });
                        }, 300);
                    });

                });

            })(jQuery);
        </script>
    <?php endif; ?>

<?php endif; ?>