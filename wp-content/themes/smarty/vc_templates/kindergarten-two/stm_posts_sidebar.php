<?php
$title = '';
$view = '';
$posts_count = '';
$posts_category = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

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
    $q_args['category__in'] = $posts_category;
}

$posts_q = new WP_Query( $q_args );

// View ID
$view_id = uniqid( 'stm-posts_' . $view . '-' );

wp_enqueue_script( 'isotope' );
wp_enqueue_script( 'imagesloaded' );
?>

<?php if( $posts_q->have_posts() ) : ?>
    <div class="post_view_list-small stm-posts<?php echo esc_attr( $css_class ); ?> ">

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
                                    <span><?php echo get_the_date('j'); ?></span>
                                    <?php echo get_the_date('M'); ?>
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
<?php endif; ?>