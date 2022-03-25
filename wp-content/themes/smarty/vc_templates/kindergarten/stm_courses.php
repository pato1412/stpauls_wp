<?php
$courses_count = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

// Owl Carousel
if( 'carousel' === $view ) {
    wp_enqueue_style( 'owl-carousel' );
    wp_enqueue_script( 'owl-carousel' );
}

// View ID
$view_id = uniqid( 'stm-posts_' . $view . '-' );

// Classes - WP Query
$courses_query_args = array(
	'post_type' => 'stm_course',
	'posts_per_page' => -1,
);

if( $courses_count ) {
	$courses_query_args['posts_per_page'] = $courses_count;
}

if( $courses_category ) {
    $courses_query_args['stm_course_category'] = $courses_category;
}

$courses_query = new WP_Query( $courses_query_args );
?>
<?php if( $courses_query->have_posts() ) : ?>
    <?php if( 'grid' === $view ) : ?>
        <div class="row <?php echo esc_attr( $css_class ); ?>">
            <?php while( $courses_query->have_posts() ) : $courses_query->the_post(); ?>
                <div class="col-sm-4 col-xs-12">
                    <div class="courses_post__box <?php if( has_post_thumbnail() ) : ?>courses_post__has_thumbnail<?php endif; ?>">
                        <?php if( has_post_thumbnail() ) : ?>
                            <div class="courses_post__thumbnail">
                                <?php
                                // Thumbnail size
                                $thumb_size = '350x190';

                                $thumb = wpb_getImageBySize( array(
                                    'attach_id'  => get_post_thumbnail_id(),
                                    'thumb_size' => $thumb_size
                                ) );
                                ?>
                                <a href="<?php the_permalink() ?>"><?php echo wp_kses_post( $thumb['thumbnail'] ); ?></a>
                            </div>
                        <?php endif; ?>
                        <div class="courses_post__body_wrap">
                            <div class="courses_post__body">
                                <div class="courses_post__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
                                <?php if( get_the_excerpt() ) : ?>
                                    <div class="courses_post__short_description">
                                        <?php the_excerpt(); ?>
                                    </div>
                                <?php endif; ?>
                                <div class="courses_post__meta">
                                    <ul>
                                        <li>
                                            <div><?php esc_html_e( 'Age', 'smarty' ); ?></div>
                                            <?php echo (( $course_age = get_post_meta( get_the_ID(), 'course_age', true ) ) ? $course_age : 0 ); ?>
                                        </li>
                                        <li>
                                            <div><?php esc_html_e( 'Size', 'smarty' ); ?></div>
                                            <?php echo (( $course_size = get_post_meta( get_the_ID(), 'course_size', true ) ) ? $course_size : 0 ); ?>
                                        </li>
                                        <li>
                                            <div><?php esc_html_e( 'Price', 'smarty' ); ?></div>
                                            <?php echo (( $course_price = get_post_meta( get_the_ID(), 'course_price', true ) ) ? $course_price : 0 ); ?>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="courses_post__link_more"><span><?php esc_html_e( 'Learn more', 'smarty' ); ?></span></a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </div>
    <?php elseif( 'carousel' === $view ) : ?>
        <div class="stm-carousel stm-carousel_view_courses" id="<?php echo esc_attr( $view_id ); ?>">
            <?php while( $courses_query->have_posts() ) : $courses_query->the_post(); ?>
                <div class="courses_post__box <?php if( has_post_thumbnail() ) : ?>courses_post__has_thumbnail<?php endif; ?>">
                    <?php if( has_post_thumbnail() ) : ?>
                        <div class="courses_post__thumbnail">
                            <?php
                            // Thumbnail size
                            $thumb_size = '350x190';

                            $thumb = wpb_getImageBySize( array(
                                'attach_id'  => get_post_thumbnail_id(),
                                'thumb_size' => $thumb_size
                            ) );
                            ?>
                            <a href="<?php the_permalink() ?>"><?php echo wp_kses_post( $thumb['thumbnail'] ); ?></a>
                        </div>
                    <?php endif; ?>
                    <div class="courses_post__body_wrap">
                        <div class="courses_post__body">
                            <div class="courses_post__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
                            <?php if( get_the_excerpt() ) : ?>
                                <div class="courses_post__short_description">
                                    <?php the_excerpt(); ?>
                                </div>
                            <?php endif; ?>
                            <div class="courses_post__meta">
                                <ul>
                                    <li>
                                        <div><?php esc_html_e( 'Age', 'smarty' ); ?></div>
                                        <?php echo (( $course_age = get_post_meta( get_the_ID(), 'course_age', true ) ) ? $course_age : 0 ); ?>
                                    </li>
                                    <li>
                                        <div><?php esc_html_e( 'Size', 'smarty' ); ?></div>
                                        <?php echo (( $course_size = get_post_meta( get_the_ID(), 'course_size', true ) ) ? $course_size : 0 ); ?>
                                    </li>
                                    <li>
                                        <div><?php esc_html_e( 'Price', 'smarty' ); ?></div>
                                        <?php echo (( $course_price = get_post_meta( get_the_ID(), 'course_price', true ) ) ? $course_price : 0 ); ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <a href="<?php the_permalink(); ?>" class="courses_post__link_more"><span><?php esc_html_e( 'Learn more', 'smarty' ); ?></span></a>
                    </div>
                </div>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </div><!-- STM Carousel -->
    <?php endif; ?>
<?php endif; ?>

<?php if( 'carousel' === $view ) : ?>
    <script>
        (function($) {
            "use strict";

            $(document).ready(function() {
                var carouselId = '<?php echo esc_js( $view_id ); ?>';

                $('#'+carouselId).owlCarousel({
                    loop   : true,
                    margin : 30,
                    nav    : true,
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

            });

        })(jQuery);
    </script>
<?php endif; ?>